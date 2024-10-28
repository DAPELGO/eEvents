@extends('layouts.template')
@section('role', 'active')
@section('content')
<div class="mb-4 mt-1">
    <h4 style="padding: 0.4rem 0 0.4rem 1rem; background-color: #004ebc; color: white !important; font-size: 0.8rem;">LES VALEURS DES PARAMETRES</h4>
</div>
<div class="mt-4 shadow-lg p-4 ps-6 mb-4">
    <p class="text-700 fw-bold">Modification d'un rôle</p>
    <hr>
    <div class="row g-4">
        <div class="col-12 col-xl-10 order-1 order-xl-0">
            <form class="g-3" action="{{ route('roles.update', $role->id) }}" method="POST" novalidate="">
                @csrf
                {{ method_field('PUT') }}
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label col-form-label-sm" for="nom_role">Libellé <span class="fas fa-asterisk fs--3 me-1 mb-1 text-danger"></span></label>
                    <div class="col-sm-10">
                        <input class="form-control @error('nom_role') is-invalid @enderror" id="nom_role" name="nom_role" type="text" placeholder="Nom du role..." value="{{ old('nom_role') ? old('nom_role') : $role->nom_role }}" />
                        @error('nom_role')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label col-form-label-sm" for="nom_role">Permission</label>
                    <div class="col-sm-10">
                        @foreach($permissions as $groupName => $groupPermissions)
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-lg-12 p-1">
                                        <h6>{{ $groupName }}</h6>
                                    </div>
                                    <hr>
                                    @foreach($groupPermissions as $permission)
                                        <div class="col-lg-4">
                                            <div class="form-check">
                                                <input class="form-check-input" id="{{ $permission->id }}" name="permission[]" type="checkbox" value="{{ $permission->id }}"
                                                @if (is_array(old('permission')) && in_array($permission->id, old('permission')))
                                                    checked
                                                @elseif(in_array($permission->id, $role->permissions->pluck('id')->toArray()))
                                                    checked
                                                @endif />
                                                <label class="form-check-label" for="{{ $permission->id }}">{{ $permission->nom_permission }}</label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <button class="btn btn-primary btn-sm" type="submit">Enregistrer</button>
                <a class="btn btn-outline-primary btn-sm" href="{{ route('roles.index') }}">Fermer</a>
            </form>
        </div>
    </div>
</div>
@endsection
