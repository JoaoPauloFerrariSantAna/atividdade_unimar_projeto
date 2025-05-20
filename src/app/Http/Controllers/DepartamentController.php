<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Departament;
use App\Models\Workers;

class DepartamentController extends Controller
{
    public function __construct() {}

	# region Get
    public function getAllDepartaments()
	{
        return response()->json(
			[
				"operationStatus" => 200,
				"savedData" => Departament::all()
			]
		);
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
					"operationStatus" => 500,
					"errorType" => $e->getMessage(),
				]
			);
		}

		return response()->json(
			[
				"operationStatus" => 200,
				"savedData" => $departament
			]
		);
	}

	public function getWorkerDepartament(Request $req, int $workerId)
	{
		# sorry  but i can't work with the laravel functions, in this case
		$query = DB::select(
			"SELECT 
				worker_tbl.name WORKER_NAME, 
				worker_tbl.salary WORKER_SALARY, 
				departament_tbl.name DEPT_NAME 
			FROM 
				worker_tbl
			INNER JOIN
				departament_tbl
			ON
				departament_tbl.id = worker_tbl.departamentId
			WHERE
				departament_tbl.id = $workerId;
			");

        return response()->json(
			[
				"operationStatus" => 200,
				"savedData" => $query
			]
		);
	}
	# endregion Get
	# region Post
	public function postDepartament(Request $req)
	{
		# TODO: add error handling
		$departament = new Departament();

		$departament->name = $req->input("departamentName", null);
		$departament->workerAmount = $req->input("departamentWorkers", 1);
		$departament->save();

		return response()->json(
			[
				"operationStatus" => 200,
				"savedData" => $departament
			]
		);
	}
	# endregion Post
	# region Patch
	public function patchDepartament(Request $req, int $id)
	{
		$departament = null;

		$newName = $req->input("newDepartamentName", null);
		$newWorkerAmount = $req->input("newAmpuntWorkers", 1);

		try
		{
			$departament = Departament::findOrFail($id);
		} catch(ModelNotFoundException $e)
		{
			return response()->json(
				[
					"operationStatus" => 500,
					"errorType" => $e->getMessage(),
				]
			);
		}

		if(!is_null($newName))
		{
			$departament->name = $newName;
		}

		if(!is_null($newWorkerAmount))
		{
			$departament->workerAmount = $newWorkerAmount;
		}

		$departament->save();

		return response()->json(
			[
				"operationStatus" => 200,
				"savedData" => $departament
			]
		);
	}
	# endregion Patch
}