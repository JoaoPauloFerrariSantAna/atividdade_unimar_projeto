<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
		$workerId = Workers::find($workerId);
		$departament = new Departament();

        return response()->json(
			[
				"operationStatus" => 200,
				"savedData" => $departament->workers()->associate($workerId)
			]
		);
	}

	# endregion Get

	# region Post

	public function postDepartament(Request $req)
	{
		// TODO: add error handling
		$departament = new Departament();

		$departament->name = $req->input("departamentName", null);
		$departament->workerAmount = $req->input("departamentWorkers", 1);
		$departament->workerId = $req->input("workerId", null);
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
