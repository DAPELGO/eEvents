<?php

namespace App\Http\Controllers\admin;

use App\Models\admin\Structure;
use App\Models\admin\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class PermissionController extends Controller
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
        if (Auth::user()->can('permissions.view')) {
            $permissions = Permission::where('is_delete', false)->orderBy('group_slug')->orderBy('slug')->get();
            return view('backend.permissions.index', compact('permissions'));
        }
        return redirect()->route('backend.home');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->can('permissions.update')) {
            $permission = Permission::where('id', $id)->first();
            return view('backend.permissions.edit', compact('permission'));
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
        if (Auth::user()->can('permissions.update')) {
            $this->validate($request, [
                'nom_permission'=>'required',
            ]);

            try{
                $permission = Permission::find($id);
                $permission->nom_permission = $request->nom_permission;
                $permission->save();
            }
            catch(Exception $e){
                Log::error('Erreur lors de la modification de la permission: '.$e->getMessage());
                toastr()->error('Une erreur est survenue lors de la modification de la permission');
                return redirect()->back();
            }

            toastr()->success('Permission modifié avec succès.');
            return redirect()->route('permissions.index');
        }

        return redirect()->route('backend.home');
    }
}
