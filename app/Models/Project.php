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
        "slug"
    ];

    public function types() {
        return $this->belongsTo(Type::class); //un projects appartiene a una tipologia
    }
}
