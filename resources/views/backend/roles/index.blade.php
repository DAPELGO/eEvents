@extends('backend.layouts.layouts')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/sweetalert2.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/DataTables/datatables.css')}}">
@endsection
@section('role', 'active')
@section('content')
<div class="mb-4 mt-1">
    <h4 style="padding: 0.4rem 0 0.4rem 1rem; background-color: #004ebc; color: white !important; font-size: 0.8rem;">RÔLES</h4>
</div>
  <div id="categories">
    <div class="row align-items-center justify-content-between g-3 mb-4">
      <div class="col col-auto">
      </div>
      <div class="col-auto">
        @can('roles.create', Auth::user())
            <div class="d-flex align-items-center">
                <a href="{{ route('roles.create') }}" class="btn btn-outline-primary btn-sm me-2" style="font-weight: 600;"><span class="fas fa-plus me-2"></span>Ajouter un rôle</a>
            </div>
        @endcan
      </div>
    </div>
    <table class="table w-100" style="font-size: .72rem;" id="dataTableFis-roles">
        <thead>
            <tr>
                <th style="color: #004ebc; ">RÔLES</th>
                <th style="color: #004ebc;">UTILISATEURS</th>
                <th style="color: #004ebc;">PERMISSIONS</th>
                <th style="color: #004ebc;">ACTIONS</th>
            </tr>
        </thead>
        <tbody>
            @foreach($roles as $role)
            <tr class="position-static">
                <td class="align-middle fw-bold">{{ $role->nom_role }}</td>
                <td class="align-middle fw-bold">{{ count($role->users) }}</td>
                <td class="align-middle fw-bold">{{ count($role->permissions) }}</td>
                <td class="last_active align-middle text-700">
                    <div class="btn-group">
                        @can('roles.update', Auth::user())
                            <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-sm btn-info" title="Modifier le role"><span class="text-900 fs-3" data-feather="edit"></span></a>
                        @endcan
                        @can('roles.delete', Auth::user())
                            <a href="{{ route('roles.delete', $role->id) }}" class="btn btn-sm btn-delete btn-danger" title="Supprimer le rôle"><span class="text-900 fs-3" data-feather="trash-2"></span></a>
                        @endcan
                    </div>
                </td>
            </tr>
            @endforeach
          </tbody>
    </table>
  </div>
@endsection
@section('script')
    <script src="{{ asset('assets/js/sweet-alert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/js/sweet-alert/app.js') }}"></script>
    <script src="{{asset('assets/DataTables/datatables.js')}}"></script>
  <script>
    $(document).ready(function() {
        $('[id^="dataTableFis-"]').DataTable({
            retrieve: true,
            "pagingType": "full_numbers",
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "Toutes"]
            ],
            "order": [],
            responsive: true,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Rechercher...",
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
  <script src="{{asset('assets/DataTables/plugins/filtering/type-based/accent-neutralise.js')}}"></script>
  <script>
    $('[id^="dataTableFis-"] tbody').on('click', '.btn-delete', function(e) {
        e.preventDefault();
        swal({
            title: 'Attention !',
            text: "Voulez vous supprimer ce rôle ?",
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
