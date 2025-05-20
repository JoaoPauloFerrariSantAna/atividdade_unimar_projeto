<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DepartamentController;
use App\Http\Controllers\WorkersController;

# TODO: group it

# region Departaments

Route::get("/departament", array(DepartamentController::class, "getAllDepartaments"));
Route::get("/departament/{id}", array(DepartamentController::class, "getDepartament"));
# Route::get("/departament/worker/{workerId}", array(DepartamentController::class, "getWorkerDepartament"));
Route::post("/departament", array(DepartamentController::class, "postDepartament"));
Route::patch("/departament/{id}", array(DepartamentController::class, "patchDepartament"));

# endregion Departaments

# region Workers

Route::get("/worker", array(WorkersController::class, "getAllWorkers"));
Route::get("/worker/{id}", array(WorkersController::class, "getWorker"));
Route::post("/worker", array(WorkersController::class, "postWorker"));
Route::patch("/worker/{id}", array(WorkersController::class, "patchWorker"));

# endregion Workers
