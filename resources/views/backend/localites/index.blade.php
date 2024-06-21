@extends('backend.layouts.layouts')
@section('localite', 'active')
@section('title', 'Localités')
@section('content')
<!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor">Localités</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Accueil</a></li>
                        <li class="breadcrumb-item">Localités</li>
                        <li class="breadcrumb-item active">Liste</li>
                    </ol>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-header">
                                    <div class="row m-b-10">
                                        <div class="col-6">
                                            <h4 class="card-title">Les localités</h4>
                                            <h6 class="card-subtitle">Liste des localités de l'espace administrateur</h6>
                                        </div>
                                        <div class="col-6 d-flex align-items-center justify-content-end">
                                            <a href="{{ route('localites.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Ajouter une localité</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive m-t-0">
                                    <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Nom</th>
                                                <th>Parent</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($localites as $localite)
                                            <tr>
                                                <td>{{ $localite->nom }}</td>
                                                <td>{{ $localite->parent }}</td>
                                                <td>
                                                    <a href="{{ route('localites.edit', $localite->id) }}" class="btn btn-sm btn-info" title="Modifier la localité">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('localites.destroy', $localite->id) }}" method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
@endsection
