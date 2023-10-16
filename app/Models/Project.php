<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        "title",
        "description",
        "image",
        "slug",
        "type_id",
    ];

    public function type() { //in SINGOLARE
        return $this->belongsTo(Type::class); //un projects appartiene a una tipologia
    }
    
}
