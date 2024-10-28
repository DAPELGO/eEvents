@extends('layouts.template')
@section('page_title', 'ECOM | Add Category')
@section('permission', 'active')
@section('content')
<div class="mb-4 mt-1">
    <h4 style="padding: 0.4rem 0 0.4rem 1rem; background-color: #004ebc; color: white !important; font-size: 0.8rem;">PERMISSIONS</h4>
</div>
<div class="mt-4 shadow-lg p-4 ps-6 mb-4">
    <p class="text-700 fw-bold">Modification d'une permission</p>
    <hr>
    <div class="row g-4">
        <div class="col-12 col-xl-8 order-1 order-xl-0">
            <form class="g-3" action="{{ route('permissions.update', $permission->id) }}" method="POST" novalidate="">
                @csrf
                {{ method_field('PUT') }}
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label col-form-label-sm" for="nom_permission">Nom</label>
                    <div class="col-sm-10">
                        <input class="form-control @error('nom_permission') is-invalid @enderror" id="nom_permission" name="nom_permission" type="text" placeholder="Nom de la permission..." value="{{ old('nom_permission') ? old('nom_permission') : $permission->nom_permission }}" />
                        @error('nom_permission')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <hr>
                <button class="btn btn-primary btn-sm" type="submit">Enregistrer</button>
                <a class="btn btn-outline-primary btn-sm" href="{{ route('permissions.index') }}">Fermer</a>
          </form>
        </div>
      </div>
</div>
@endsection
