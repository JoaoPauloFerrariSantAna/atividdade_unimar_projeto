<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Workers;

class Departament extends Model
{
    protected $table = "departament_tbl";
    protected $fillable = array("name", "workerAmount", "worker_id");

    public function workers()
    {
        return $this->hasMany("worker_id", Workers::class);
    }
}
