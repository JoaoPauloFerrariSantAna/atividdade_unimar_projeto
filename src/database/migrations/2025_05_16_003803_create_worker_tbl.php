<?php

require_once __DIR__ . "/../../constants/constants.php";

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('worker_tbl');
        Schema::create('worker_tbl', function (Blueprint $table) {
            $table->id();
            $table->string("name", DEFAULT_NAME_SIZE)->nullable(false);
            $table->double("salary")->nullable(false)->default(DEFAULT_SALARY);
            $table->foreignId("departamentId")->constrained()->references("id")->on("departament_tbl");
            $table->dateTime("contractStart")->nullable(false);
            $table->dateTime("contractEnd")->nullable(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('worker_tbl');
    }
};
