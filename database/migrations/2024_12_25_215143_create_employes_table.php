<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('email')->unique();
            $table->string('telephone')->unique();
            $table->string('adresse');
            $table->string('fonction');
            $table->string('departement');
            $table->string('card_id')->unique()->nullable();
            $table->enum('role', ['admin', 'utilisateur']);
            $table->string('password');
            $table->boolean('is_active')->default(true); // Par défaut actif
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('employees');
    }
}

