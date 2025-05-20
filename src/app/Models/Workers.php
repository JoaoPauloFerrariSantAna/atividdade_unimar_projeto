<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Departament;

class Workers extends Model
{
    protected $table = "worker_tbl";
    protected $fillable = array("name", "salary", "contractStart", "contractEnd", "departamentId");

    public function departament()
    {
        return $this->hasOne("departamentId", Departament::class);
    }
}
