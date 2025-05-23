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
            $table->string("name", NAME_LENGTH_WORKER)->nullable(false);
            $table->double("salary")->nullable(false)->default(DEFAULT_SALARY);

			# NOTE: from what i could think of:
			# it would be better to put workerId (this table's id) with departamentId
			# on another table in this case, it would simplify all of the logic a little
			# but i don't have enough time to be doin' that
			# i've wasted enough in ASM and some shortcomings in this code are because of that.

			# https://laravel.com/docs/7.x/migrations#foreign-key-constraints

			# TODO: the thing is: if we delete with cascade, we'll lose every worker
			# how to fix that...?
            $table->foreignId("departamentId")->constrained()
				->references("id")->on("departament_tbl")->onDelete("cascade");
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
