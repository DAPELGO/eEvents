<?php

namespace App\Models\admin;

use App\Models\admin\Evenement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Localite extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_parent',
        'libelle',
        'is_delete',
        'id_user_created',
        'id_user_modified',
        'id_user_delete',
    ];

    public function parent()
    {
        return $this->belongsTo(Localite::class, 'id_parent', 'id');
    }

    public function children()
    {
        return $this->hasMany(Localite::class, 'id_parent', 'id');
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

    public function evenements()
    {
        return $this->hasMany(Evenement::class, 'id_localite');
    }
}
