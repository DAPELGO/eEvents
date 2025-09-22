<?php

namespace App\Models\admin;

use App\Models\admin\Admin;
use App\Models\admin\Categorie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'slug',
        'id_categorie',
        'url_img',
        'date_article',
        'content',
        'is_published',
        'is_delete',
        'id_user_created',
        'id_user_modified',
        'id_user_delete',
    ];

    public function categorie()
    {
        return $this->belongsTo(Categorie::class, 'id_categorie');
    }

    public function user_created()
    {
        return $this->belongsTo(Admin::class, 'id_user_created');
    }

}
