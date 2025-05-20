<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Workers;

class Departament extends Model
{
    protected $table = "departament_tbl";
    protected $fillable = array("name", "workerAmount");

    public function workers(): HasMany
    {
        return $this->hasMany(Workers::class);
    }
}
