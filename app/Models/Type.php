<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    public function projects() { //in PLURALE
        return $this->hasMany(Project::class); //un tipo appartiene a molti Projects
    }

}
