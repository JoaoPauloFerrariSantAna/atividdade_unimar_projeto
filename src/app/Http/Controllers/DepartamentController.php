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
				-- filter what has been gathered up there
				departament_tbl.id = $workerId;
			");

        return new JsonResponse( status: 200, data: [ $query ] );
	}

	public function postDepartament(Request $req): JsonResponse
	{
		# TODO: add error handling
		$departament = new Departament();

		$departament->name = $req->input("deptName", null);
		$departament->workerAmount = $req->input("deptWorkers", 1);
		$departament->save();

		return new JsonResponse( status: 200, data: [ $departament ] );
	}

	public function patchDepartament(Request $req, int $id): JsonResponse
	{
		$departament = null;

		$newName = $req->input("deptName", null);
		$newWorkerAmount = $req->input("eeAmount", 1);

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

	public function deleteDepartament(Request $req, int $id)
	{
		# in this case, we can ignore the try catch 'cause then
		# if we are looking to delete a dept, we can assume 
		# that it already exists
		# so we do not need to find or throw an error
		# we may... just find it
		# this is assuming, of course, if we had an front-end
		# and we could limit what the user sees, but since we are
		# not in this scenario yet, i'll leave the try catch be
		$departament = null;

		try
		{
			$departament = Departament::findOrFail($id);
		} catch(ModelNotFoundException $e)
		{
			return new JsonResponse( status: 500, data: [ $e->getMessage() ] );
		}

		# TODO: the thing is: if we delete with cascade, we'll lose every worker
		# how to fix that...?
		$departament->delete();

		return new JsonResponse( status: 200, data: [ $departament ] );
	}
}
