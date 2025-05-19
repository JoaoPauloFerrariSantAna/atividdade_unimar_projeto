<?php

require_once __DIR__ . "/../../constants/constants.php";

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
        Schema::create('departament_tbl', function (Blueprint $table) {
            $table->id();
            $table->string("name", DEFAULT_NAME_SIZE)->nullable(false);
            $table->integer("workerAmount")->nullable(false);
            $table->foreignId("workerId")->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departament_tbl');
    }
};
