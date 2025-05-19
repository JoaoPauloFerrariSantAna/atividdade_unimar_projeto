<?php

require_once __DIR__ . "/../../constants/constants.php";

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('worker_tbl', function (Blueprint $table) {
            $table->id();
            $table->string("name", DEFAULT_NAME_SIZE)->nullable(false);
            $table->double("salary")->nullable(false)->default(150.75);
            $table->dateTime("contract_start")->nullable(false)->default(date("Y-m-d H:i:s"));
            $table->dateTime("contract_end");
            $table->foreignId("departament_id");
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('worker_tbl');
    }
};
