@extends('backend.layouts.layouts')
@section('structure', 'active')
@section('title', 'Structures')
@section('content')
<!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">Structures</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Accueil</a></li>
                <li class="breadcrumb-item">Structures</li>
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
                                    <h4 class="card-title">Les structures</h4>
                                    <h6 class="card-subtitle">Liste des structures</h6>
                                </div>
                                <div class="col-6 d-flex align-items-center justify-content-end">
                                    @can('structures.create', Auth::user())
                                        <a href="{{ route('structures.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Ajouter une structure</a>
                                    @endcan
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive m-t-0">
                            <table id="dt" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nom</th>
                                        <th>Niveau</th>
                                        <th>Type</th>
                                        <th>Nature</th>
                                        <th>Parent</th>
                                        <th>Code structure</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
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
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
@endsection
@section('script')
  <script>
    $(document).ready(function() {
        $('[id^="dt"]').DataTable({
            retrieve: true,
            serverSide: true,
            searching: false,
            ajax: {
                "url": "{{ route('structures.list') }}",
                "type": "POST",
                "data": {
                    "_token": "{{ csrf_token() }}"
                },
                "error": function (xhr, error, code) {
                    if(xhr.status === 403 || xhr.status === 401){
                        window.location.href = "{{ route('login') }}";
                    }
                    else{
                        console.log('Erreur datatable: code ' + xhr.status + ' ' + xhr.responseText);
                        msg = "Une erreur s'est produite lors du traitement du tableau. Veuillez verifier votre connexion et recharger la page";

                        swal({
                            title: 'Erreur !',
                            text: msg,
                            icon: 'warning',
                            confirmButtonText: 'Fermer'
                        });
                    }
                }
            },
            searchBuilder: {
                columns: [1,2,3,4,5,6],
                depthLimit: 1,
                conditions:{
                    string: {
                        '!null': null,
                        'not': null,
                        '>=': null,
                        '>': null,
                        '<=': null,
                        '<': null,
                        'null': null,
                        'between': null,
                        '!between': null,
                        'starts': null,
                        '!starts': null,
                        'contains': null,
                        '!contains': null,
                        'ends': null,
                        '!ends': null
                    },
                    num: {
                        '!null': null,
                        'not': null,
                        '>=': null,
                        '>': null,
                        '<=': null,
                        '<': null,
                        'null': null,
                        'between': null,
                        '!between': null,
                        'starts': null,
                        '!starts': null,
                        'contains': null,
                        '!contains': null,
                        'ends': null,
                        '!ends': null
                    },
                    html: {
                        '!null': null,
                        'not': null,
                        '>=': null,
                        '>': null,
                        '<=': null,
                        '<': null,
                        'null': null,
                        'between': null,
                        '!between': null,
                        'starts': null,
                        '!starts': null,
                        'contains': null,
                        '!contains': null,
                        'ends': null,
                        '!ends': null
                    },
                }
            },
            dom: 'Qlfrtip',
            "pagingType": "full_numbers",
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "Toutes"]
            ],
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                { data: 'nom_structure', name: 'nom_structure', orderable: true, searchable: true },
                { data: 'niveau', name: 'niveau', orderable: true, searchable: true },
                { data: 'type', name: 'type', orderable: true, searchable: true },
                { data: 'nature', name: 'nature', orderable: true, searchable: true },
                { data: 'parent', name: 'parent', orderable: true, searchable: true },
                { data: 'code_structure', name: 'code_structure', orderable: true, searchable: true },
                { data: 'actions', name: 'actions', orderable: false, searchable: false}
            ],
            deferRender: true,
            responsive: true,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Rechercher...",
                searchBuilder: {
                    title: 'Filtre avancé',
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

    $('[id^="dt"] tbody').on('click', '.btn-delete', function(e) {
        e.preventDefault();
        swal({
            title: 'Attention !',
            text: "Voulez vous supprimer cette structure ?",
            icon: 'warning',
            buttons: {
                cancel: "Annuler",
                confirm:"confirmer"
            },
        })
        .then((willDelete) =>{
            if (willDelete) {
                window.location = $(this).attr('href');
            }
        });
    });
  </script>
@endsection
