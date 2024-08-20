<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Centre des Opérations de Réponse aux Urgences Sanitaire | CORUS</title>
    <meta name="description" content="Explorez le Centre des Opérations de Réponse aux Urgences Sanitaire (CORUS) du Ministère de la Santé et de l'Hygiène Publique du Burkina Faso, votre allié pour la gestion rapide et efficace des situations d'urgence sanitaire. Nos experts sont disponibles 24/7 pour assurer une réponse immédiate et coordonnée face aux crises de santé publique.">
    <meta name="keywords" content="CORUS, Centre des Opérations de Réponse aux Urgences Sanitaire, Ministère de la Santé et de l'Hygiène Publique, MSHP, Burkina Faso, gestion des urgences sanitaires, crises de santé publique, réponse rapide, santé publique, coordination des urgences, intervention d'urgence, services d'urgence sanitaire, gestion des crises sanitaires">

    <!-- Favicons -->
    <link href="{{ asset('frontend/assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('frontend/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i|Quicksand:300,300i,400,400i,500,500i,600,600i,700,700i&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('frontend/assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
  <link href="{{ asset('frontend/assets/vendor/animate.css/animate.min.css') }}" rel="stylesheet">
  <link href="{{ asset('frontend/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('frontend/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('frontend/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('frontend/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('frontend/assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
  <link href="{{ asset('frontend/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('frontend/assets/css/style.css') }}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Medilab
  * Template URL: https://bootstrapmade.com/medilab-free-medical-bootstrap-theme/
  * Updated: Mar 17 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  @include('frontend.layouts.header')

  @yield('content')

  @include('frontend.layouts.foot')

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ asset('frontend/assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
  <script src="{{ asset('frontend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('frontend/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('frontend/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('frontend/assets/vendor/php-email-form/validate_.js') }}"></script>
  <script src="{{ asset('backend/assets/js/jquery.min.js') }}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('frontend/assets/js/main.js') }}"></script>
  <script>
    $(function(){

        // thisForm.querySelector('.error-message').innerHTML = error;
        // thisForm.querySelector('.error-message').classList.add('d-block');
        $("#auth-form").click(function(event){
            document.getElementById('error-message').style.display = 'block';
            document.getElementById('loading').style.display = 'block';
            document.g
            event.preventDefault();
            var email = $("#email").val();
            var password = $("#password").val();
            $.ajax({
                url: "{{ route('user.login') }}",
                type: 'post',
                data: {"_token": "{{ csrf_token() }}", email:email, password:password },
                error:function(data){
                    document.getElementById('loading').style.display = 'none';
                    document.getElementById('error-message').innerHTML = JSON.parse(data.responseText).errors[0][0].original;
                    document.getElementById('error-message').style.display = 'block';
                },
                success: function(data) {
                    document.location.href = "{{ route('frontend.welcome') }}";
                        }
            });
        });

        // FORM EVENT
        $("#btn-event").click(function(){
            document.getElementById('error-message').style.display = 'block';
            document.getElementById('loading').style.display = 'block';
            document.g
            event.preventDefault();
            var name = $("#name").val();
            var email = $("#email").val();
            var phone = $("#phone").val();
            var date_event = $("#date_event").val();
            var id_categorie = $("#id_categorie").val();
            var id_localite = $("#id_localite").val();
            var message = $("#message").val();
            $.ajax({
                url: "{{ route('alert.declare') }}",
                type: 'post',
                data: {"_token": "{{ csrf_token() }}",
                name:name, email:email, phone:phone, date_event:date_event, id_categorie:id_categorie, id_localite:id_localite, message:message
            },
                error:function(data){
                    alert("ERROR");
                    document.getElementById('error-message').style.display = 'none';
                    document.getElementById('loading').style.display = 'none';
                },
                success: function(data) {
                    document.location.href = "{{ route('frontend.welcome') }}";
                        }
            });
        });
    });
  </script>

</body>

</html>
