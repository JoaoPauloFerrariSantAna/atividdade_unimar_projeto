<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

use App\Models\Departament;

class DepartamentController extends Controller
{
    public function __construct() {}

    public function getAllDepartaments()
    {
        return Departament::all();
    }
}
