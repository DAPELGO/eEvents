@extends('frontend.layouts.layouts')
@section('evenement', 'actived')
@section('urgence', 'active')
@section('content')
<section class="doctors" style="padding-top: 120px; padding-bottom: 0;">
    <div class="container">
        <div class="row">
            <div class="col-lg-2" style="background: #f2f2f2;">
                <div class="sub-title">Autres menus</div>
                <div class="menu">
                    <ul>
                        <li><a href="#">Le CORUS</a></li>
                        <li><a href="#">Urgences de santé publique</a></li>
                        <li><a href="#">Prévention et préparation</a></li>
                        <li><a href="#">Ressources documentaires</a></li>
                        <li><a href="#">Contact et assistance</a></li>
                        <li><a href="#">Gestions des recrutements</a></li>
                        <li><a href="#">Outils de communications</a></li>
                        <li><a href="#">Exercices de simulations</a></li>
                    </ul>
                </div>
                <hr>
                <div class="contacts" style="font-size: 12px;">
                    <div class="title">CONTACT</div>
                    <p>
                        <b>Cours de Trypano</b><br>
                        Rue Hôpital Yalgado Ouédraogo, Ouagadougou-Burkina-Faso
                    </p>
                </div>
                <hr>
                <div class="contacts" style="font-size: 12px;">
                    <div class="title">SUIVEZ NOUS SUR</div>
                    <p>
                        <a href="#" class="twitter"><i class="bx bxl-twitter"></i> Twitter</a><br>
                        <a href="#" class="facebook"><i class="bx bxl-facebook"></i> Facebook</a><br>
                        <a href="#" class="facebook"><i class="bx bxl-youtube"></i> Youtube</a><br>
                        <a href="#" class="instagram"><i class="bx bxl-instagram"></i> Instagram</a><br>
                        <a href="#" class="google-plus"><i class="bx bxl-skype"></i> Google-plus</a><br>
                        <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i> Linked</a>
                    </p>
                </div>
            </div>
            <div class="col-lg-10 mission pb-2">
                <div class="row">
                    <div class="col-lg-4">
                        <img src="{{ asset('images/articles/cover/'.$article->url_img) }}" style="height: 50rem;" alt="ARTICLE IMG">
                    </div>
                    <div class="col-lg-10">
                        <h2 class="title" style="text-align: center;">{{ $article->titre }}</h2>
                    </div>
                </div>

                <hr>
                <h4><a href="#">{{ $article->titre }}</a></h4>
                <p>{!! $article->content !!}</p>
            </div>
        </div>
    </div>
</section>
@endsection
