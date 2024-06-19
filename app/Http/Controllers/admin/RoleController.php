<?php

namespace App\Http\Controllers\admin;

use Exception;
use App\Models\admin\Role;
use App\Models\admin\Structure;
use App\Models\admin\Permission;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if (Auth::user()->can('roles.view')) {
            $roles = Role::where('slug', '!=', 'super_admin')->where('is_delete', false)->get();

            return view('backend.roles.index', compact('roles'));
       //}

       return redirect()->route('backend.home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // if (Auth::user()->can('roles.create')) {
            $permissions = Permission::where('is_delete', false)->orderBy('group_name')->get()->groupBy('group_name');
            return view('backend.roles.create', compact('permissions'));
        // }

        return redirect()->route('backend.home');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //if (Auth::user()->can('roles.create')) {
            $this->validate($request, [
                'nom_role' => 'required',
            ]);

            //verifier si le role existe
            $verif_role = Role::where('nom_role', $request->nom_role)->first();

            if($verif_role && $verif_role->is_delete == false){
                toastr()->error('Ce rôle existe déjà');
                return redirect()->route('roles.index');
            }

            if($verif_role && $verif_role->is_delete == true){
                $verif_role->id_user_deleted = 0;
                $verif_role->is_delete = false;
                $verif_role->save();

                $verif_role->permissions()->sync($request->permission);

                toastr()->success('Rôle enregistré avec succès');
                return redirect()->route('roles.index');
            }

            try{
                $role = Role::create([
                    'nom_role' => $request->nom_role,
                    'slug' => Str::slug($request->nom_role, '_'),
                    'id_user_created'=>Auth::user()->id,
                    'is_delete' => false
                ]);

                $role->permissions()->sync($request->permission);
            }
            catch(Exception $e){
                Log::error('Erreur lors de l\'enregistrement du rôle: '.$e->getMessage());
                toastr()->error('Erreur lors de l\'enregistrement du rôle');
                return redirect()->route('roles.index');
            }

            toastr()->success('Rôle enregistré avec succès');
            return redirect()->route('roles.index');
        //}

        return redirect()->route('backend.home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect()->route('roles.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->can('roles.update')) {

            $role = Role::find($id);

            if(!$role){
                toastr()->error('Rôle non trouvé');
                return redirect()->route('roles.index');
            }

            $permissions = Permission::where('is_delete', false)->orderBy('group_name')->get()->groupBy('group_name');

            return view('backend.roles.edit', compact('role', 'permissions'));
        }

        return redirect()->route('backend.home');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Auth::user()->can('roles.update')) {

            $this->validate($request, [
                'nom_role' => 'required|unique:roles,nom_role,'.$id,
            ]);

            $role = Role::find($id);

            if(!$role){
                toastr()->error('Rôle non trouvé');
                return redirect()->route('roles.index');
            }

            try{
                $role->nom_role = $request->nom_role;
                $role->slug = Str::slug($request->nom_role, '_');
                $role->id_user_updated = Auth::user()->id;
                $role->save();

                $role->permissions()->sync($request->permission);
            }
            catch(Exception $e){
                Log::error('Erreur lors de la modification du rôle: '.$e->getMessage());
                toastr()->error('Erreur lors de la modification du rôle');
                return redirect()->route('roles.index');
            }

            toastr()->success('Rôle modifié avec succès');
            return redirect()->route('roles.index');
        }

        return redirect()->route('backend.home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return redirect()->route('roles.index');
    }


    public function delete(Request $request, $id)
    {
        if (Auth::user()->can('roles.delete')){

            $role = Role::find($id);
            if(!$role){
                toastr()->error('Rôle non trouvé');
                return redirect()->route('roles.index');
            }

            $role->permissions()->detach();
            $role->users()->detach();

            $role->id_user_deleted = Auth::user()->id;
            $role->is_delete = true;
            $role->save();

            toastr()->success('Rôle supprimé avec succès');
            return redirect()->route('roles.index');
        }

        return redirect()->route('roles.index');
    }
}
