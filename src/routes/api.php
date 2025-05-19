<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DepartamentController;

# region Departaments

Route::get("/departament", array(DepartamentController::class, "getAllDepartaments"));
Route::get("/departament/{id}", array(DepartamentController::class, "getDepartament"));
Route::post("/departament", array(DepartamentController::class, "postDepartament"));

# endregion Departaments

# region Workers

Route::get("/worker", array(WorkerController::class, "getWorkers"));
Route::get("/worker/{id}", array(WorkerController::class, "getWorker"));

# endregion Workers
