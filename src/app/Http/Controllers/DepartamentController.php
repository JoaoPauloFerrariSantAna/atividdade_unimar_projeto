<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\Departament;

class DepartamentController extends Controller
{
    public function __construct() {}

    public function getAllDepartaments()
	{
        return Departament::all();
    }

	public function getDepartament(int $id)
	{
		$departament = null;

		try
		{
			$departament = Departament::findOrFail($id);
		} catch(ModelNotFoundException $e)
		{
			return response()->json(
				[
					"operation_status" => "500",
					"msg" => "Could not find departament with id of '$id'"
				]
			);
		}
	}

	public function postDepartament(Request $req)
	{
		// TODO: add error handling
		$departament = new Departament();

		$departament->name = $req->input("dname", "NULL");
		$departament->workerAmount = $req->input("workers", 1);
		$departament->workerId = $req->input("workerId", null);
		$departament->save();

		return response()->json(
			[
				"operation_status" => "200",
				"savedData" => $departament
			]
		);
	}
}
