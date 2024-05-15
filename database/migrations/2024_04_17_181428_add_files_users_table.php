<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('apellido')->nullable();
            $table->string('celular')->nullable();
            $table->string('tipodoc')->nullable();
            $table->string('numdoc')->nullable();
            $table->date('fechanacimiento')->nullable();

            $table->string('genero')->nullable();
            $table->string('educacion')->nullable();
            $table->string('estrato')->nullable();
            $table->string('ingresosfamiliares')->nullable();
            $table->string('estadocivil')->nullable();
            $table->string('domicilio')->nullable();

            $table->string('numeroprograma')->nullable();
            $table->string('periodogrado')->nullable();
            $table->date('fechagrado')->nullable();
            $table->string('actagrado')->nullable();

            $table->string('empleado')->nullable();
            $table->string('empresa')->nullable();
            $table->string('paisempresa')->nullable();
            $table->string('departamentoempresa')->nullable();
            $table->string('ciudadempresa')->nullable();
            $table->string('direccionempresa')->nullable();
            $table->string('celularempresa')->nullable();
            $table->string('cargo')->nullable();
            $table->string('salario')->nullable();
            $table->string('modalidad')->nullable();
            $table->string('tipocontrato')->nullable();    
            $table->string('tipojornada')->nullable();
            $table->string('reconocimientos')->nullable();
            $table->string('habilidades')->nullable();

            $table->string('role_name')->nullable();

            $table->unsignedBigInteger('role_id')->nullable();
            $table->foreign('role_id')->references('id')->on('roles');

            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
            $table->dropForeign(['created_by']);
            $table->dropColumn(['apellido', 'celular', 'tipodoc', 'numdoc', 'fechanacimiento', 'genero', 'educacion', 'estrato', 'ingresosfamiliares', 'estadocivil', 'domicilio', 'numeroprograma', 'periodogrado', 'fechagrado', 'actagrado', 'empleado', 'empresa', 'paisempresa', 'departamentoempresa', 'ciudadempresa', 'direccionempresa', 'celularempresa', 'cargo', 'salario', 'modalidad', 'tipocontrato', 'tipojornada', 'reconocimientos', 'habilidades', 'role_id', 'created_by', 'role_name']);
        });
    }
};

