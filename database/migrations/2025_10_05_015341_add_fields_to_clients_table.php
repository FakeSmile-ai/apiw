<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            // Si la tabla tiene filas y te da error por NOT NULL,
            // cambia temporalmente a ->nullable() y luego ajustas.
            $table->string('name', 120)->after('id');
            $table->string('email', 150)->unique()->after('name');
            $table->string('phone', 30)->nullable()->after('email');
            $table->string('address', 255)->nullable()->after('phone');
            $table->softDeletes()->after('updated_at');
        });
    }

    public function down(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->dropColumn(['name', 'email', 'phone', 'address', 'deleted_at']);
        });
    }
};
