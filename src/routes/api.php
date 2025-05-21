<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DepartamentController;
use App\Http\Controllers\WorkersController;

# TODO: group it

Route::get("/departament/worker/{workerId}", array(DepartamentController::class, "getWorkerDepartament"));
Route::patch("/departament/{id}", array(DepartamentController::class, "patchDepartament"));
Route::delete("/departament/{id}", array(DepartamentController::class, "deleteDepartament"));
Route::get("/departament/{id}", array(DepartamentController::class, "getDepartament"));
Route::get("/departament", array(DepartamentController::class, "getAllDepartaments"));
Route::post("/departament", array(DepartamentController::class, "postDepartament"));

Route::get("/worker/{id}", array(WorkersController::class, "getWorker"));
Route::patch("/worker/{id}", array(WorkersController::class, "patchWorker"));
Route::get("/worker", array(WorkersController::class, "getAllWorkers"));
Route::post("/worker", array(WorkersController::class, "postWorker"));
