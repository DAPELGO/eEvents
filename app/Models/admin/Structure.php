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
    protected $guarded = [];

    public function parent()
    {
        return $this->belongsTo(Structure::class, 'parent_id', 'id');
    }

    public function getAllParents()
    {
        $structures = new Collection();
        $structure = $this;
        while ($structure->parent) {
            $structure = $structure->parent;
            $structures->push($structure);
        }

        return $structures;
    }

    public function children()
    {
        return $this->hasMany(Structure::class, 'parent_id', 'id');
    }

    public function descendants()
    {
        return $this->children()->with('descendants');
    }

    public function getAllChildren()
    {
        $structures = new Collection();
        foreach ($this->children as $structure) {
            $structures->push($structure);
            $structures = $structures->merge($structure->getAllChildren());
        }

        return $structures;
    }


    public function niveau_structure()
    {
        return $this->belongsTo(Valeur::class, 'id_niveau_structure', 'id');
    }

    public function type_structure()
    {
        return $this->belongsTo(Valeur::class, 'id_type_structure', 'id');
    }

    public function feuille_soins()
    {
        return $this->hasMany(FeuilleSoin::class, 'id_structure', 'id');
    }

    public function gerants()
    {
        return $this->hasMany(Gerant::class, 'id_structure', 'id');
    }

    public function prescripteurs()
    {
        return $this->hasMany(Prescripteur::class, 'id_structure', 'id');
    }

    public function villages()
    {
        return $this->hasMany(Village::class, 'id_structure', 'id');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'id_structure', 'id');
    }
}
