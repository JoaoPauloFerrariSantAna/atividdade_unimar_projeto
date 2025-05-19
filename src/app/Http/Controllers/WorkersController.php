<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\Workers;

class WorkersController extends Controller
{
    public function __construct() {}

    public function getAllWorkers()
    {
        return Workers::all();
    }

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
}
