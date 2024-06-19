@extends('layouts.template')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/sweetalert2.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/DataTables/datatables.css')}}">
@endsection
@section('structure', 'active')
@section('content')
<div class="mb-4 mt-1">
    <h4 style="padding: 0.4rem 0 0.4rem 1rem; background-color: #004ebc; color: white !important; font-size: 0.8rem;">STRUCTURES</h4>
</div>
  <div id="categories">
    <div class="row align-items-center justify-content-between g-3 mb-4">
      <div class="col col-auto">
      </div>
      <div class="col-auto">
        @can('data.create', Auth::user())
            <div class="d-flex align-items-center">
                <a href="{{ route('structures.create') }}" class="btn btn-outline-primary btn-sm me-2" style="font-weight: 600;"><span class="fas fa-plus me-2"></span>Ajouter une structure</a>
                {{-- <a href="#" class="btn btn-outline-primary btn-sm me-2" style="font-weight: 600;"><span class="fas fa-file-excel me-2"></span>import Excel</a> --}}
                {{-- <a href="#" class="btn btn-outline-primary btn-sm" style="font-weight: 600;"><span class="fas fa-sync me-2"></span>Synchro. MFL</a> --}}
            </div>
        @endcan
      </div>
    </div>
    <table class="table w-100" style="font-size: .72rem;" id="dataTableFis-structures">
        <thead>
            <tr>
                <th style="min-width:10px; color: #004ebc;">ID</th>
                <th style="color: #004ebc;">NOM</th>
                <th style="color: #004ebc;">NIVEAU</th>
                <th style="color: #004ebc;">TYPE</th>
                <th style="color: #004ebc;">NATURE</th>
                <th style="color: #004ebc;">PARENT</th>
                <th style="color: #004ebc;">CODE STRUCTURE</th>
                <th style="color: #004ebc;">ACTIONS</th>
            </tr>
        </thead>
        <tbody class="align-middle fw-bold text-td">
        </tbody>
    </table>
  </div>
@endsection
@section('script')
    <script src="{{ asset('assets/js/sweet-alert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/js/sweet-alert/app.js') }}"></script>
    <script src="{{asset('assets/DataTables/datatables.js')}}"></script>
    <script src="{{ asset('assets/DataTables/plugins/filtering/type-based/diacritics-neutralise.js') }}"></script>
  <script>
    $(document).ready(function() {
        $('[id^="dataTableFis-"]').DataTable({
            retrieve: true,
            serverSide: true,
            ajax: {
                "url": "{{ route('structures.list') }}",
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
                columns: [1,3,4,5,6],
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
                    "next":       "<i class='fas fa-angles-right'></i>",
                    "previous":   "<i class='fas fa-angles-left'></i>"
                },
                "aria": {
                    "sortAscending":  ": Cliquez pour activer le tri ascendant",
                    "sortDescending": ": Cliquez pour activer le tri descendant"
                }
            }
        });
    });
  </script>
  <script>
    $('[id^="dataTableFis-"] tbody').on('click', '.btn-delete', function(e) {
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
