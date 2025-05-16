<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartamentController;

Route::get("/departaments", array(DepartamentController::class, "getAllDepartaments"));