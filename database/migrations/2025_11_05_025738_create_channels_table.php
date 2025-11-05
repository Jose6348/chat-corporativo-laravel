<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
 public function up(): void
{
    Schema::create('channels', function (Blueprint $table) {
        $table->id();

        $table->string('name');
        $table->text('description')->nullable(); 

        // (1=Admin, 2=Diretor, 3=Gerente, 4=Colaborador)
        $table->integer('required_level')->default(4); 

        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('channels');
    }
};
