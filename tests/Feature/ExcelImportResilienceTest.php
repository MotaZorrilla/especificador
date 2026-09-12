<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;
use App\Models\User;
use App\Models\Filedata;
use Spatie\Permission\Models\Permission;

class ExcelImportResilienceTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        // Crear permiso 'filedata' requerido por FiledataController::__construct
        Permission::create([
            'name' => 'filedata',
            'description' => 'Administración de base de datos de pinturas',
            'guard_name' => 'web',
        ]);

        $this->user = User::factory()->create();
        $this->user->givePermissionTo('filedata');
    }

    public function test_non_spreadsheet_file_is_rejected_by_form_request()
    {
        $file = UploadedFile::fake()->create('documento.pdf', 100, 'application/pdf');

        $response = $this->actingAs($this->user)
            ->post('/filedataImport', [
                'filedata' => $file,
            ]);

        $response->assertSessionHasErrors('filedata');
        $this->assertEquals(0, Filedata::count());
    }

    public function test_valid_csv_is_imported_cleanly()
    {
        // Generar un CSV de prueba con cabecera y 2 filas válidas
        $csvContent = "Pintura,Modelo,Certificado,Numero,Masividad,M15,M30,M60,M90,M120,P4C,V4C,V3C,Abierta,Rectangular,Circular\n";
        $csvContent .= "Sika Unitherm,Steel-100,DICTUC-001,1,120.5,250,300,450,600,800,X,X,,X,,\n";
        $csvContent .= "Sherwin Williams,Firetex-M90,IDIEM-002,2,140.0,280,350,500,700,900,X,X,X,,,X\n";

        $file = UploadedFile::fake()->createWithContent('especificacion_pinturas.csv', $csvContent);

        $response = $this->actingAs($this->user)
            ->post('/filedataImport', [
                'filedata' => $file,
            ]);

        $response->assertRedirect('/filedata');
        $response->assertSessionHas('success');

        // Se deben haber importado 2 registros (omitiendo la fila de cabecera)
        $this->assertEquals(2, Filedata::count());
        $this->assertDatabaseHas('filedatas', [
            'pintura' => 'Sika Unitherm',
            'modelo' => 'Steel-100',
        ]);
        $this->assertDatabaseHas('filedatas', [
            'pintura' => 'Sherwin Williams',
            'modelo' => 'Firetex-M90',
        ]);
    }

    public function test_corrupted_or_blank_rows_do_not_throw_500_and_import_valid_rows()
    {
        // 1 fila válida, 1 fila con pintura vacía (inválida), 1 fila válida
        $csvContent = "Pintura,Modelo,Certificado,Numero,Masividad\n";
        $csvContent .= "Chilcorrofin,Intum-A,DICTUC-010,1,95.0\n";
        $csvContent .= ",Modelo-Sin-Pintura,DICTUC-011,2,110.0\n"; // Fila corrupta/vacía en 'pintura'
        $csvContent .= "Sherwin Williams,Flame-Guard,IDIEM-012,3,130.0\n";

        $file = UploadedFile::fake()->createWithContent('pinturas_mixtas.csv', $csvContent);

        $response = $this->actingAs($this->user)
            ->post('/filedataImport', [
                'filedata' => $file,
            ]);

        $response->assertRedirect('/filedata');
        $response->assertSessionHas('success');
        $response->assertSessionHas('import_warning');

        // Solo las 2 filas válidas deben persistirse
        $this->assertEquals(2, Filedata::count());
        $this->assertDatabaseHas('filedatas', ['pintura' => 'Chilcorrofin']);
        $this->assertDatabaseHas('filedatas', ['pintura' => 'Sherwin Williams']);
    }
}
