<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Workers;

class WorkersController extends Controller
{
    public function __construct()
    {

    }

    public function getAllWorkers()
    {
        return Workers::all();
    }
}
