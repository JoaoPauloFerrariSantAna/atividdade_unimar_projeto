<?php

require_once __DIR__ . "/../../constants/constants.php";

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('departament_tbl', function (Blueprint $table) {
            $table->id();
            $table->string("name", NAME_LENGTH_DEPT)->nullable(false);
            $table->integer("workerAmount")->nullable(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('departament_tbl');
    }
};
