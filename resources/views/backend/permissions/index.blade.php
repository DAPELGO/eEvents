@extends('layouts.template')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/sweetalert2.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/DataTables/datatables.css')}}">
@endsection
@section('permission', 'active')
@section('content')
<div class="mb-4 mt-1">
    <h4 style="padding: 0.4rem 0 0.4rem 1rem; background-color: #004ebc; color: white !important; font-size: 0.8rem;">LES PERMISSIONS</h4>
</div>
  <div id="categories">
    <div class="row align-items-center justify-content-between g-3 mb-4">
      <div class="col col-auto">
      </div>
      <div class="col-auto">
      </div>
    </div>
    <table class="table w-100" style="font-size: .72rem;" id="dataTableFis-examens">
        <thead>
            <tr>
                <th style="color: #004ebc;">PERMISSION</th>
                <th style="color: #004ebc; ">SLUG</th>
                <th style="color: #004ebc; ">GROUPE</th>
                <th style="color: #004ebc;">ACTION</th>
            </tr>
        </thead>
        <tbody>
            @foreach($permissions as $permission)
            <tr class="position-static">
                <td  class="align-middle fw-bold">{{ $permission->nom_permission }}</td>
                <td  class="align-middle">{{ $permission->slug }}</td>
                <td  class="align-middle">{{ $permission->group_name }}</td>
                <td  class="align-middle">
                    <a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-sm btn-info" title="Modifier la permission"><span class="text-900 fs-3" data-feather="edit"></span></a>
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
                    "next":       "<i class='icofont icofont-double-right'></i>",
                    "previous":   "<i class='icofont icofont-double-left'></i>"
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
@endsection
