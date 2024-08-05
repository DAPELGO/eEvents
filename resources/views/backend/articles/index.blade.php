@extends('backend.layouts.layouts')
@section('article', 'active')
@section('title', 'Articles')
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
                                    <h4 class="card-title">Les articles</h4>
                                    <h6 class="card-subtitle">Liste des articles</h6>
                                </div>
                                <div class="col-6 d-flex align-items-center justify-content-end">
                                    <a href="{{ route('articles.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Ajouter un article</a>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive m-t-0">
                            <table id="dt" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    </tr>
                                        <th>Titre</th>
                                        <th>Catégorie</th>
                                        <th>Date de publication</th>
                                        <th>Auteur</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($articles as $article)
                                    <tr>
                                        <td>{{ $article->titre }}</td>
                                        <td>{{ $article->categorie->nom_categorie }}</td>
                                        <td>{{ \Carbon\Carbon::parse($article->date_article)->format('d/m/Y') }}</td>
                                        <td>{{ $article->user_created->name }}</td>
                                        <td>
                                            @if($article->is_published == true)
                                                <span class="badge bg-success">Publié</span>
                                            @else
                                                <span class="badge bg-warning">Brouillon</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <a class="btn btn-sm btn-info" href="{{ route('articles.show', $article->id) }}" title="Voir l'article">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                @if($article->is_published == false)
                                                    <a href="{{ route('articles.publish', $article->id) }}" class="btn btn-sm btn-success" title="Publier l'article">
                                                        <i class="fa fa-check"></i>
                                                    </a>
                                                @else
                                                    <a href="{{ route('articles.unpublish', $article->id) }}" class="btn btn-sm btn-secondary" title="Dépublier l'article">
                                                        <i class="fa fa-times"></i>
                                                    </a>
                                                @endif
                                                <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-sm btn-warning" title="Modifier l'article">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a href="{{ route('articles.delete', $article->id) }}" class="btn btn-sm btn-delete btn-danger sweet-conf" data="Voulez vous supprimer cet article ?" title="Supprimer l'article">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </div>
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
    </div>
@endsection
@section('script')
<script>
    $(document).ready(function() {
        $('#dt').DataTable({
            retrieve: true,
            dom: 'Qlfrtip',
            "pagingType": "full_numbers",
            "lengthMenu": [
                [10, 25, 50],
                [10, 25, 50]
            ],
            "order": [],
            responsive: true,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Rechercher...",
                searchBuilder: {
                    title: 'Recherche & Filtre avancé',
                    add: 'Nouveau filtre',
                    button: 'Filtrer',
                    clearAll: 'Tout effacer',
                    value: 'Valeur',
                    condition: 'Condition',
                    data: 'Critère',
                    conditions :{
                        string: {
                            contains: 'Contient',
                            empty: 'Vide',
                            endsWith: 'Se termine par',
                            equals: 'Egal à',
                            not: 'Différent de',
                            notContains: 'Ne contient pas',
                            notEmpty: 'Non vide',
                            notEndsWith: 'Ne se termine pas par',
                            notStartsWith: 'Ne commence pas par',
                            startsWith: 'Commence par'
                        }
                    }
                },
                "decimal":        "",
                "emptyTable":     "Aucune donnée disponible dans ce tableau",
                "info":           "Affichage de _START_ à _END_ sur _TOTAL_ entrées",
                "infoEmpty":      "Affichage de 0 à 0 sur 0 entrées",
                "infoFiltered":   "(filtré sur un total de _MAX_ entrées)",
                "infoPostFix":    "",
                "thousands":      ",",
                "lengthMenu":     "Affichage de _MENU_ entrées",
                "loadingRecords": "Chargement...",
                "processing":     "Traitement...",
                "zeroRecords":    "Aucune correspondance trouvée",
                "paginate": {
                    "first":      "Début",
                    "last":       "Fin",
                    "next":       "<i class='fa fa-angle-right'></i>",
                    "previous":   "<i class='fa fa-angle-left'></i>"
                },
                "aria": {
                    "sortAscending":  ": Cliquez pour activer le tri ascendant",
                    "sortDescending": ": Cliquez pour activer le tri descendant"
                }
            }
        });
    });
</script>
@endsection
