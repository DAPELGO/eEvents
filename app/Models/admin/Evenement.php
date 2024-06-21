<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evenement extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_categorie',
        'id_localite',
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
}
