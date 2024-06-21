<?php

namespace App\Models\admin;

use App\Models\admin\Admin;
use App\Models\admin\Valeur;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Structure extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_localite',
        'parent_id',
        'code_structure',
        'nom_structure',
        'id_niveau_structure',
        'id_type_structure',
        'is_public_structure',
        'slug',
        'is_delete',
        'id_user_created',
        'id_user_modified',
        'id_user_delete',
    ];

    public function parent()
    {
        return $this->belongsTo(Structure::class, 'parent_id', 'id');
    }

    public function children()
    {
        return $this->hasMany(Structure::class, 'parent_id', 'id');
    }

    public function getAllChildren()
    {
        $children = $this->children;
        $allChildren = collect();
        foreach ($children as $child) {
            $allChildren->push($child);
            $allChildren = $allChildren->merge($child->getAllChildren());
        }
        return $allChildren;
    }

    public function getAllParents()
    {
        $parents = collect();
        $parent = $this->parent;
        while ($parent) {
            $parents->push($parent);
            $parent = $parent->parent;
        }
        return $parents;
    }

    public function niveau_structure()
    {
        return $this->belongsTo(Valeur::class, 'id_niveau_structure', 'id');
    }

    public function type_structure()
    {
        return $this->belongsTo(Valeur::class, 'id_type_structure', 'id');
    }
}
