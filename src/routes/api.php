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

# TODO: group it

Route::get("/worker/{id}", array(WorkersController::class, "getWorker"));
Route::patch("/worker/{id}", array(WorkersController::class, "patchWorker"));
Route::get("/worker", array(WorkersController::class, "getAllWorkers"));
Route::post("/worker", array(WorkersController::class, "postWorker"));
