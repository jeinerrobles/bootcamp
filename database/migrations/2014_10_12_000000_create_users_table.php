<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration //Clase anonima que no tiene nombre y se extiende a la migracion base de laravel
{
    /**
     * Run the migrations.
     */
    //////toda migracion tiene 2 metodos
    //el metodo up que se utiliza para crear o modificar tablas
    //el metodo down se hace lo contrario. Si en el up se crea una tabla en el down la eliminamos y asi.
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
