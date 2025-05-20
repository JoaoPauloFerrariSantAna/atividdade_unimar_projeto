<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\Workers;

class WorkersController extends Controller
{
    public function __construct() {}

    public function getAllWorkers() { return Workers::all(); }

	public function getWorker(int $id)
	{
		$worker = null;

		try
		{
			$worker = Workers::findOrFail($id);
		} catch(ModelNotFoundException $e)
		{
			return response()->json(
				[
					"operation_status" => "500",
					"errorType" => $e->getMessage(),
				]
			);
		}

		return response()->json(
			[
				"operation_status" => "200",
				"savedData" => $worker
			]
		);
	}

	public function postWorker(Request $req)
	{
		// TODO: add error handling
		$worker = new Workers();

		$worker->name = $req->input("workerName", null);
		$worker->salary = $req->input("workerSalary", 0.00);
		$worker->contractStart = $req->input("workerStart", null);
		$worker->contractEnd = $req->input("workerEnd", null);
		$worker->save();

		return response()->json(
			[
				"operation_status" => "200",
				"savedData" => $worker
			]
		);
	}

	public function patchWorker(Request $req, int $id)
	{
		$worker = null;

		# i think that the start of the contract does not need to change
		# just the end date in case of termination
		# and that, i think, it should be a separated method
		# 'cause it is way to specific to be here
		# like it should be, the route, be "/worker/{id}/setTerminationDate
		# maybe i'll add this another time, yes?
		$new_name = $req->input("newName", null);
		$new_salary = $req->input("newSalary", null);

		try
		{
			$worker = Workers::findOrFail($id);
		} catch(ModelNotFoundException $e)
		{
			return response()->json(
				[
					"operation_status" => "500",
					"errorType" => $e->getMessage(),
				]
			);
		}

		if(!is_null($new_name))
		{
			$worker->name = $new_name;
		}

		if(!is_null($new_salary))
		{
			$worker->salary = $new_salary;
		}

		$worker->save();

		return response()->json(
			[
				"operation_status" => "200",
				"savedData" => $worker
			]
		);

	}
}
