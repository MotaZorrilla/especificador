<div class="modal fade" id="borrarBase" tabindex="-1" aria-labelledby="borrarBaseLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-gradient-danger ">
                <h1 class="modal-title fs-5 text-white" id="ModalLabel">
                    Confirmar Borrado de Base de Datos</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-left">
                <p>¿Estás seguro de que deseas borrar todos los
                    registros <br>de la Base de datos?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal" data-bs-toggle="form"
                    data-bs-target="#borrarForm" id="confirmarBorrar"
                    onclick="event.preventDefault(); document.getElementById('borrarForm').submit();">
                    Borrar BD
                </button>
                <form id="borrarForm" action="{{ route('filedata.Reset') }}" method="POST">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>
