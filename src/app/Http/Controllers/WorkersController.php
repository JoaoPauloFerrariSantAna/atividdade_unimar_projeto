<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\Workers;

class WorkersController extends Controller {
    public function __construct() {}

    public function getWorkers(): JsonResponse {
		return new JsonResponse(status: 200, data: [Worker::all()]);
		
	}

	public function getWorker(int $id): JsonResponse {
		$worker = null;

		try {
			$worker = Workers::findOrFail($id);
		} catch(ModelNotFoundException $e) {
			return new JsonResponse(status: 500, data: [ "UNKNOWN WORKER" ]);
		}

		return new JsonResponse(status: 200, data: [$worker]);
	}

	public function getWorkerDepartament(int $deptId) {
		# instead of using worker_tbl as the middle table
		# we'll be using departament_tbl
		# as the middle table
		# and then we will filter using the deptId from worker_tbl
		# this is essentially the inverse from Departament::getWorkerDepartament
		$query = DB::select("SELECT departament_tbl.name AS DEPT_NAME
			FROM departament_tbl
			INNER JOIN worker_tbl
			ON worker_tbl.departamentId = departament_tbl.id
			WHERE worker_tbl.departamentId = $deptId;");

		return new JsonResponse( status: 200, data: [ $query ] );
	}

	public function postWorker(Request $req): JsonResponse {
		# TODO: add error handling
		$worker = new Workers();

		$worker->name = $req->input("wkrName", null);
		$worker->salary = $req->input("wkrSalary");
		$worker->contractStart = $req->input("wkrStart", null);
		$worker->contractEnd = $req->input("wkrEnd");
        $worker->departamentId = $req->input("deptId", null);
		$worker->save();

		return new JsonResponse(status: 200, data: [$worker]);
	}

	public function patchWorker(Request $req, int $id): JsonResponse {
		$worker = null;

		# i think that the start of the contract does not need to change
		# just the end date in case of termination
		# and that, i think, it should be a separated method
		# 'cause it is way to specific to be here
		# like it should be, the route, be "/worker/{id}/setTerminationDate
		# maybe i'll add this another time, yes?
		$newName = $req->input("newName", null);
		$newSalary = $req->input("newSalary");

		try {
			$worker = Workers::findOrFail($id);
		} catch(ModelNotFoundException $e) {
			return new JsonResponse(status: 500, data: [ "UNKNOWN WORKER" ]);
		}

		if(!is_null($newName)) {
			$worker->name = $newName;
		}

		if(!is_null($newSalary)) {
			$worker->salary = $newSalary;
		}

		$worker->save();

		return new JsonResponse(status: 200, data: [$worker]);
	}

	public function deleteWorker(int $id) {
		# in this case, we can ignore the try catch 'cause then
		# if we are looking to delete a dept, we can assume 
		# that it already exists
		# so we do not need to find or throw an error
		# we may... just find it
		# this is assuming, of course, if we had an front-end
		# and we could limit what the user sees, but since we are
		# not in this scenario yet, i'll leave the try catch be

		$worker = null;

		try {
			$worker = Workers::findOrFail($id);
		} catch(ModelNotFoundException $e) {
			return new JsonResponse(status: 500, data: [$e->getMessage()]);
		}

		# TODO: the thing is: if we delete with cascade, we'll lose every worker
		# how to fix that...?
		$worker->delete();

		return new JsonResponse(status: 200, data: [$worker]);
	}
}
