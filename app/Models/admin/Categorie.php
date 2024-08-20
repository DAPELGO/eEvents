<?php

namespace App\Models\admin;

use App\Models\admin\Evenement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Categorie extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_categorie',
        'slug',
        'type_categories',
        'description',
        'is_delete',
        'id_user_created',
        'id_user_modified',
        'id_user_delete',
    ];

    public function evenements()
    {
        return $this->hasMany(Evenement::class, 'id_categorie')
                    ->where('type_categories', 'events');
    }

    public function articles()
    {
        return $this->hasMany(Evenement::class, 'id_categorie')
                    ->where('type_categories', 'articles');
    }
}
