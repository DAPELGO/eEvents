<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('backend/assets/images/favicon.png') }}">
    <title>@yield('title') | Espace Administrateur | CORUS</title>
    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('backend/assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/assets/plugins/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend//assets/plugins/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet" />
    <!-- morris CSS -->
    <link href="{{ asset('backend/assets/plugins/morrisjs/morris.css') }}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('backend/assets/css/style.css') }}" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="{{ asset('backend/assets/css/colors/default.css') }}" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js') }}"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js') }}"></script>
<![endif]-->
</head>

<body class="fix-header card-no-border">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <!-- <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div> -->
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        @include('backend.layouts.header')
        @include('backend.layouts.nav')
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            @yield('content')
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer"> © {{Date('Y')}} CORUS - Centre des Opérations de Réponse aux Urgences Sanitaire. Tous droits réservés.</footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{ asset('backend/assets/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{ asset('backend/assets/plugins/bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ asset('backend/assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{ asset('backend/assets/js/jquery.slimscroll.js') }}"></script>
    <!--Wave Effects -->
    <script src="{{ asset('backend/assets/js/waves.js') }}"></script>
    <!--Menu sidebar -->
    <script src="{{ asset('backend/assets/js/sidebarmenu.js') }}"></script>
    <!--stickey kit -->
    <script src="{{ asset('backend/assets/plugins/sticky-kit-master/dist/sticky-kit.min.js') }}"></script>
    <!--Custom JavaScript -->
    <script src="{{ asset('backend/assets/js/custom.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/validation.js') }}"></script>
        <script type="text/javascript" src="{{ asset('backend//assets/plugins/multiselect/js/jquery.multi-select.js') }}"></script>
        <script src="{{ asset('backend/assets/plugins/select2/dist/js/select2.full.min.js') }}" type="text/javascript"></script>
    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->
    <!--sparkline JavaScript -->
    <script src="{{ asset('backend/assets/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
    <!--morris JavaScript -->
    <script src="{{ asset('backend/assets/plugins/raphael/raphael-min.js') }}"></script>
    <script src="{{ asset('backend/assets/plugins/morrisjs/morris.min.js') }}"></script>
    <!-- Chart JS -->
    <script src="{{ asset('backend/assets/js/dashboard1.js') }}"></script>
    <!-- start - This is for export functionality only -->
    <!-- This is data table -->
    <script src="{{ asset('backend/assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
    <!-- end - This is for export functionality only -->
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
            $(document).ready(function() {
                var table = $('#example').DataTable({
                    "columnDefs": [{
                        "visible": false,
                        "targets": 2
                    }],
                    "order": [
                        [2, 'asc']
                    ],
                    "displayLength": 25,
                    "drawCallback": function(settings) {
                        var api = this.api();
                        var rows = api.rows({
                            page: 'current'
                        }).nodes();
                        var last = null;
                        api.column(2, {
                            page: 'current'
                        }).data().each(function(group, i) {
                            if (last !== group) {
                                $(rows).eq(i).before('<tr class="group"><td colspan="5">' + group + '</td></tr>');
                                last = group;
                            }
                        });
                    }
                });
                // Order by the grouping
                $('#example tbody').on('click', 'tr.group', function() {
                    var currentOrder = table.order()[0];
                    if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
                        table.order([2, 'desc']).draw();
                    } else {
                        table.order([2, 'asc']).draw();
                    }
                });
            });

            $('#example23').DataTable({
                retrieve: true,
                "pagingType": "full_numbers",
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "Toutes"]
                ],
                "order": [],
                responsive: true,
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
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
                        "next":       "<i class='mdi mdi-chevron-double-right'></i>",
                        "previous":   "<i class='mdi mdi-chevron-double-left'></i>"
                    },
                    "aria": {
                        "sortAscending":  ": Cliquez pour activer le tri ascendant",
                        "sortDescending": ": Cliquez pour activer le tri descendant"
                    }
                }
            });

            $(".select2").select2();
        });


        function slugify(text) {
        return text
            .toString() // Cast to string
            .toLowerCase() // Convert the string to lowercase letters
            .normalize('NFD') // The normalize() method returns the Unicode Normalization Form of a given string.
            .trim() // Remove whitespace from both sides of a string
            .replace(/\s+/g, '-') // Replace spaces with -
            .replace(/[^\w\-]+/g, '') // Remove all non-word chars
            .replace(/\-\-+/g, '-'); // Replace multiple - with single -
        }

        function listingslug(text) {
            document.getElementById("slug").value = slugify(text);
        }
        </script>

    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="{{ asset('backend/assets/plugins/styleswitcher/jQuery.style.switcher.js') }}"></script>
</body>

</html>
