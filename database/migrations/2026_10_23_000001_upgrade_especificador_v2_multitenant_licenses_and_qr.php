<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('rut')->nullable()->unique();
            $table->string('status')->default('active');
            $table->timestamps();
        });

        Schema::create('licenses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->nullable()->constrained('tenants')->nullOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('license_key')->unique();
            $table->timestamp('starts_at')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->unsignedInteger('max_transfers_per_year')->default(2);
            $table->unsignedInteger('transfers_used_count')->default(0);
            $table->decimal('annual_price_clp', 12, 2)->default(1500000);
            $table->decimal('royalty_percent', 5, 2)->default(20.00);
            $table->string('status')->default('active');
            $table->timestamps();
        });

        Schema::create('license_audit_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('license_id')->nullable()->constrained('licenses')->nullOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('event_type'); // INITIAL_ACTIVATION, DEVICE_REASSIGNMENT, KICKING_EVENT, BLOCKED_ATTEMPT
            $table->string('old_device_fingerprint')->nullable();
            $table->string('new_device_fingerprint')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->text('notes')->nullable();
            $table->timestamp('created_at')->useCurrent();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('tenant_id')->nullable()->after('id')->constrained('tenants')->nullOnDelete();
            $table->string('registered_device_fingerprint')->nullable()->after('profile_count');
            $table->unsignedInteger('max_device_transfers')->default(2)->after('registered_device_fingerprint');
            $table->unsignedInteger('device_transfers_used')->default(0)->after('max_device_transfers');
        });

        Schema::table('user_devices', function (Blueprint $table) {
            $table->string('device_fingerprint')->nullable()->index()->after('device_token');
            $table->boolean('is_trusted_hardware')->default(true)->after('is_active');
        });

        Schema::table('projects', function (Blueprint $table) {
            $table->foreignId('tenant_id')->nullable()->after('user_id')->constrained('tenants')->nullOnDelete();
            $table->boolean('is_private')->default(false)->after('observations');
            $table->uuid('verification_uuid')->nullable()->unique()->after('is_private');
            $table->string('integrity_hash', 64)->nullable()->after('verification_uuid');
        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropConstrainedForeignId('tenant_id');
            $table->dropColumn(['is_private', 'verification_uuid', 'integrity_hash']);
        });

        Schema::table('user_devices', function (Blueprint $table) {
            $table->dropColumn(['device_fingerprint', 'is_trusted_hardware']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropConstrainedForeignId('tenant_id');
            $table->dropColumn(['registered_device_fingerprint', 'max_device_transfers', 'device_transfers_used']);
        });

        Schema::dropIfExists('license_audit_logs');
        Schema::dropIfExists('licenses');
        Schema::dropIfExists('tenants');
    }
};
