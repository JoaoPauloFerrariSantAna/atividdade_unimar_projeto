<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\Workers;

class WorkersController extends Controller
{
    public function __construct() {}

    public function getAllWorkers(): JsonResponse
	{
		return new JsonResponse( status: 200, data: [ Worker::all() ] );
		
	}

	public function getWorker(int $id): JsonResponse
	{
		$worker = null;

		try
		{
			$worker = Workers::findOrFail($id);
		} catch(ModelNotFoundException $e)
		{
			return new JsonResponse( status: 500, data: [ $e->getMessage() ] );
		}

		return new JsonResponse( status: 200, data: [ $worker ] );
	}

	public function postWorker(Request $req): JsonResponse
	{
		# TODO: add error handling
		$worker = new Workers();

		$worker->name = $req->input("workerName", null);
		$worker->salary = $req->input("workerSalary", 0.00);
		$worker->contractStart = $req->input("workerStart", null);
		$worker->contractEnd = $req->input("workerEnd", null);
        $worker->departamentId = $req->input("departamentId", null);
		$worker->save();

		return new JsonResponse( status: 200, data: [ $worker ] );
	}

	public function patchWorker(Request $req, int $id): JsonResponse
	{
		$worker = null;

		# i think that the start of the contract does not need to change
		# just the end date in case of termination
		# and that, i think, it should be a separated method
		# 'cause it is way to specific to be here
		# like it should be, the route, be "/worker/{id}/setTerminationDate
		# maybe i'll add this another time, yes?
		$newName = $req->input("newName", null);
		$newSalary = $req->input("newSalary", null);

		try
		{
			$worker = Workers::findOrFail($id);
		} catch(ModelNotFoundException $e)
		{
			return new JsonResponse( status: 500, data: [ $e->getMessage() ] );
		}

		if(!is_null($newName))
		{
			$worker->name = $newName;
		}

		if(!is_null($newSalary))
		{
			$worker->salary = $newSalary;
		}

		$worker->save();

		return new JsonResponse( status: 200, data: [ $worker ] );
	}
}
