<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Departament;
use App\Models\Workers;

class DepartamentController extends Controller
{
    public function __construct() {}

    public function getAllDepartaments(): JsonResponse
	{
        return new JsonResponse( status: 200, data: [ Departament::all() ] );
    }

	public function getDepartament(int $id): JsonResponse
	{
		$departament = null;

		try
		{
			$departament = Departament::findOrFail($id);
		} catch(ModelNotFoundException $e)
		{
			return new JsonResponse( status: 500, data: [ $e->getMessage() ] );
		}

		return new JsonResponse( status: 200, data: [ $departament ] );
	}

	public function getWorkerDepartament(Request $req, int $workerId): JsonResponse
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

        return new JsonResponse( status: 200, data: [ $query ] );
	}

	public function postDepartament(Request $req): JsonResponse
	{
		# TODO: add error handling
		$departament = new Departament();

		$departament->name = $req->input("departamentName", null);
		$departament->workerAmount = $req->input("departamentWorkers", 1);
		$departament->save();

		return new JsonResponse( status: 200, data: [ $departament ] );
	}

	public function patchDepartament(Request $req, int $id): JsonResponse
	{
		$departament = null;

		$newName = $req->input("newDepartamentName", null);
		$newWorkerAmount = $req->input("newAmpuntWorkers", 1);

		try
		{
			$departament = Departament::findOrFail($id);
		} catch(ModelNotFoundException $e)
		{
			return new JsonResponse( status: 500, data: [ $e->getMessage() ] );
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

		return new JsonResponse( status: 200, data: [ $departament ] );
	}
}
