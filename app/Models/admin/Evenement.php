<?php

namespace App\Models\admin;

use App\Models\admin\Categorie;
use App\Models\admin\Structure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Evenement extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_categorie',
        'code_alert',
        'id_structure',
        'libelle',
        'url_img',
        'date_event',
        'slug',
        'description',
        'is_delete',
        'id_user_created',
        'id_user_modified',
        'id_user_delete',
    ];


    public function categorie()
    {
        return $this->belongsTo(Categorie::class, 'id_categorie');
    }

    public function structure()
    {
        return $this->belongsTo(Structure::class, 'id_structure');
    }
}
