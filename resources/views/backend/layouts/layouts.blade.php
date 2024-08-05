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
    <!-- Custom CSS -->
    <link href="{{ asset('backend/assets/css/style.css') }}" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="{{ asset('backend/assets/css/colors/default.css') }}" id="theme" rel="stylesheet">
    <!-- SweetAlert -->
    <link href="{{ asset('backend/assets/plugins/sweetalert/sweetalert2.css') }}" rel="stylesheet" type="text/css">
    <link href="https://cdn.datatables.net/searchbuilder/1.7.1/css/searchBuilder.dataTables.min.css" rel="stylesheet">
    @yield('css')
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
     <!-- This is data table -->
     <script src="{{ asset('backend/assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
     <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
     <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
     <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
     <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
     <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
     <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
     <script src="https://cdn.datatables.net/searchbuilder/1.7.1/js/dataTables.searchBuilder.min.js"></script>
    <!-- end - This is for export functionality only -->
    <!-- Sweet-Alert  -->
    <script src="{{ asset('backend/assets/plugins/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('backend/assets/plugins/sweetalert/jquery.sweet-alert.custom.js') }}"></script>
    <script src="{{ asset('backend/assets/plugins/sweetalert/app.js') }}"></script>
    <!-- ============================================================== -->
    @yield('script')
    <script>
        $(document).ready(function() {
            $(".select2").select2();
        });

        function changeValue(parent, child, table_item)
        {
            var idparent_val = $("#"+parent).val();
            var table = table_item;

            var url = "{{ route('data.selection') }}";

            $.ajax({
                url: url,
                type: 'GET',
                data: {idparent_val: idparent_val, table:table},
                dataType: 'json',
                error:function(data){
                    Swal({
                        title: 'Erreur',
                        text: 'Une erreur s\'est produite lors de la récupération des données',
                        icon: 'error',
                        confirmButtonText: 'Fermer'
                    });
                },
                success: function (data) {
                    var data = data.data;
                    if(data == null){
                        var options = '<option value="" selected disabled>--- Choisir une valeur ---</option>';
                        if(table == 'type_structure'){
                            $('#type_structure_display').css('display', 'none');
                        }
                    }
                    else{
                        var options = '<option value="" selected disabled>--- Choisir une valeur ---</option>';
                        for (var x = 0; x < data.length; x++) {
                            if(data[x]['id'] !='') {
                                options += '<option value="' + data[x]['id'] + '">' + data[x]['name'] + '</option>';
                            }
                        }
                        if(table == 'type_structure'){
                            $('#type_structure_display').css('display', 'flex');
                        }
                    }
                    $('#'+child).html(options);
                }
            });
        }
    </script>

    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="{{ asset('backend/assets/plugins/styleswitcher/jQuery.style.switcher.js') }}"></scr>
</body>

</html>
