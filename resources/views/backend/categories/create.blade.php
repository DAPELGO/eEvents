@extends('backend.layouts.layouts')
@section('categorie', 'active')
@section('content')
<!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor">Catégories</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Accueil</a></li>
                        <li class="breadcrumb-item">Catégories</li>
                        <li class="breadcrumb-item active">Liste</li>
                    </ol>
                </div>
                <div>
                    <button class="right-side-toggle waves-effect waves-light btn-inverse btn btn-circle btn-sm pull-right m-l-10"><i class="ti-settings text-white"></i></button>
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
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Créer une nouvelle catégorie</h4>
                                <hr>
                                <form class="form-horizontal p-t-20" action="{{ route('categories.store') }}" method="POST">
                                    {{ csrf_field() }}
                                    <div class="form-group row">
                                        <label for="titre" class="col-sm-3 control-label">Parente <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <select class="select2 form-control custom-select" style="width: 100%; height:36px;" id="id_parent" name="id_parent">
                                                <option value="">Selectionner une catégorie parente</option>
                                                @foreach($categories as $categorie)
                                                    <option value="{{ $categorie->id }}">{{ $categorie->nom_categorie }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="titre" class="col-sm-3 control-label">Titre <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="titre" id="titre" placeholder="Nom catégorie" oninput="listingslug(this.value)" required data-validation-required-message="This field is required">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="slug" class="col-sm-3 control-label">Slug</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="slug" id="slug" placeholder="Slug">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="slug" class="col-sm-3 control-label">Description</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <textarea name="description" id="description" class="form-control" cols="30" rows="6" placeholder="Description de la catégorie"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row m-b-0">
                                        <div class="offset-sm-3 col-sm-9">
                                            <button type="submit" class="btn btn-primary waves-effect waves-light">Créer</button>
                                            <a href="{{ route('categories.index') }}" class="btn btn-secondary waves-effect waves-light">Annuler</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
@endsection
