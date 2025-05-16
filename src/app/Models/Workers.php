<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Departament;

class Workers extends Model
{
    protected $table = "worker_tbl";
    protected $fillable = array("name", "salary", "departament_id", "contract_start", "contract_end");

    public function departament()
    {
        return $this->hasOne("departament_id", Departament::class);
    }
}
