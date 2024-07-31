@extends('backend.layouts.layouts')
@section('event', 'active')
@section('title', 'Evènements')
@section('content')
<!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">Evènements</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Accueil</a></li>
                <li class="breadcrumb-item">Evènements</li>
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
                                    <h4 class="card-title">Les évènements</h4>
                                    <h6 class="card-subtitle">Surveillance épidémiologique, Urgence, Alerte, ...</h6>
                                </div>
                                <div class="col-6 d-flex align-items-center justify-content-end">
                                    <a href="{{ route('evenements.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Ajouter un evênement</a>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive m-t-0">
                            <table id="dt" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Evênement</th>
                                        <th>Catégorie</th>
                                        <th>Structure</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($evenements as $evenement)
                                    <tr>
                                        <td>{{ $evenement->libelle }}</td>
                                        <td>{{ $evenement->categorie->nom_categorie }}</td>
                                        <td>{{ $evenement->structure->nom_structure }}</td>
                                        <td>{{ \Carbon\Carbon::parse($evenement->date_event)->format('d/m/Y')}}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a class="btn btn-sm btn-info" href="#" onclick="viewEvent({{$evenement->id}})" title="Voir l'évênement">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <a href="{{ route('evenements.edit', $evenement->id) }}" class="btn btn-sm btn-warning" title="Modifier l'évènement">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a href="{{ route('evenements.delete', $evenement->id) }}" class="btn btn-sm btn-delete btn-danger sweet-conf" data="Voulez vous supprimer cet évènement ?" title="Supprimer l'évènement">
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
    <!-- Modal de détail d'évênement -->
    <div class="modal fade" id="viewEventModal" tabindex="-1" role="dialog" aria-labelledby="viewEventModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewEventModalLabel">Détails de l'événement</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>Date</th>
                                <td id="eventDate"></td>
                            </tr>
                            <tr>
                                <th>Libellé</th>
                                <td id="eventLibelle"></td>
                            </tr>
                            <tr>
                                <th>Catégorie</th>
                                <td id="eventCategorie"></td>
                            </tr>
                            <tr>
                                <th>Structure</th>
                                <td id="eventStructure"></td>
                            </tr>
                            <tr>
                                <th>Description</th>
                                <td id="eventDescription"></td>
                            </tr>
                            <tr>
                                <th>Image</th>
                                <td id="eventImage"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
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

    function viewEvent(id) {
        $.ajax({
            url: "{{ route('evenements.show', ':id') }}".replace(':id', id),
            type: 'GET',
            success: function(response) {
                console.log(response);
                if(response.success === false) {
                    swal({
                        title: 'Attention !',
                        text: response.message,
                        icon: 'error',
                        button: 'Fermer'
                    });
                    return;
                }
                $('#eventDate').text(new Date(response.data.date_event).toLocaleDateString('fr-FR'));
                $('#eventLibelle').text(response.data.libelle);
                $('#eventCategorie').text(response.data.categorie.nom_categorie);
                $('#eventStructure').text(response.data.structure.nom_structure);
                $('#eventDescription').text(response.data.description);
                if(response.data.url_img === null) {
                    $('#eventImage').html(`<img src="{{ asset('images/events/default_event.png') }}" class="img-fluid" style="max-width: 300px; border: 1px solid #ddd; padding: 5px;" alt="Pas d\'image" />`);
                }
                else{
                    $('#eventImage').html(`<img src="{{ asset('images/events/${response.data.url_img}')}}" class="img-fluid" style="max-width: 300px; border: 1px solid #ddd; padding: 5px;" alt="${response.data.libelle}" />`);
                }
                $('#viewEventModal').modal('show');
            },
            error: function() {
                swal({
                    title: 'Attention !',
                    text: 'Une erreur est survenue lors de la récupération des données',
                    icon: 'error',
                    button: 'Fermer'
                });
            }
        });
    }
</script>
@endsection
