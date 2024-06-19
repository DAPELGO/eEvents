<?php

namespace App\Models\admin;

use App\Models\admin\Structure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Valeur extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function structures()
    {
        return $this->hasMany(Structure::class);
    }
}
