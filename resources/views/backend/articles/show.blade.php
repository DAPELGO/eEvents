@extends('backend.layouts.layouts')
@section('article', 'active')
@section('title', 'Voir un article')
@section('content')
<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Articles</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Accueil</a></li>
            <li class="breadcrumb-item">Articles</li>
            <li class="breadcrumb-item active">Voir</li>
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
    <!-- <div class="card-group"> -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body collapse show">
                    <!-- article title -->
                    <div class="row">
                        <div class="col-12">
                            <h3 class="text-bold text-uppercase">{{ $article->titre }}</h3>
                        </div>
                    </div>
                    <hr>
                    <!-- article image -->
                    <div class="row">
                        <div class="col-12">
                            <img src="{{ asset('images/articles/cover/'.$article->url_img) }}" class="img-fluid" style="max-height: 300px; object-fit: cover; width: 100%;" alt="{{ $article->titre }}">
                        </div>
                    </div>
                    <hr>
                    <!-- article meta -->
                    <div class="row">
                        <div class="col-12">
                            <ul class="list-inline">
                                <li class="list-inline-item"><i class="fa fa-calendar"></i> {{ \Carbon\Carbon::parse($article->created_at)->format('d/m/Y') }}</li>
                                <li class="list-inline-item"><i class="fa fa-user"></i> {{ $article->user_created->name }}</li>
                                <li class="list-inline-item"><i class="fa fa-folder"></i> {{ $article->categorie->nom_categorie }}</li>
                            </ul>
                        </div>
                    </div>
                    <hr>
                    <!-- article content -->
                    <div class="row">
                        <div class="col-12">
                            {!! $article->content !!}
                        </div>
                    </div>
                    <hr>
                    <!-- article actions -->
                    <div class="row">
                        <div class="col-12">
                            <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-primary"><i class="fa fa-pencil"></i> Modifier</a>
                            @if($article->is_published == 1)
                                <a href="{{ route('articles.unpublish', $article->id) }}" class="btn btn-danger"><i class="fa fa-ban"></i> Dépublier</a>
                            @else
                                <a href="{{ route('articles.publish', $article->id) }}" class="btn btn-success"><i class="fa fa-check"></i> Publier</a>
                            @endif
                            <a href="{{ route('articles.index') }}" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Retour</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Page Content -->
    <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->
@endsection
