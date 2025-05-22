<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartamentController;
use App\Http\Controllers\WorkersController;

Route::controller(DepartamentController::class)->group(function() {
	Route::get("/departament/worker/{workerId}", "getWorkerDepartament");
	Route::patch("/departament/{id}", "patchDepartament");
	Route::delete("/departament/{id}", "deleteDepartament");
	Route::get("/departament/{id}", "getDepartament");
	Route::get("/departament", "getAllDepartaments");
	Route::post("/departament", "postDepartament");
});

Route::controller(WorkersController::class)->group(function() {
	Route::get("/worker/{id}", "getWorker");
	Route::patch("/worker/{id}", "patchWorker");
	Route::delete("/worker/{id}", "deleteWorker");
	Route::get("/worker", "getAllWorkers");
	Route::post("/worker", "postWorker");
});
