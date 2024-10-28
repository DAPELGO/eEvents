@extends('frontend.layouts.layouts')
@section('evenement', 'actived')
@section('urgence', 'active')
@section('content')
<section id="events" class="doctors" style="padding-top: 120px; padding-bottom: 0;">
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
                <h2 class="title" style="text-align: center;">LES EVENEMENTS EN COURS</h2>
                <hr>
                <div class="row">
                    <div class="col-lg-4"><img src="{{ asset('frontend/assets/img/marigot.jpg') }}" class="img-fluid" alt=""></div>
                    <div class="col-lg-8">
                        <h4><a href="#">Marigot Houet : Plus de 200 poissons sacrés  meurent dans les eaux</a></h4>
                        <p>Plus de 200 poissons notamment les silures sacrés  sont morts dans les eaux du marigot  Houet  à la hauteur du pont à coté du musée communal.
                            Les poissons morts ont été découverts entre le 24 et le 25 février 2023 dans des eaux noirâtres, laissant supposer une pollution.
                            Cette pollution du marigot Houet, cause de la mort des silures, serait due,  selon une source communale, aux eaux sales ...</p>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-lg-4"><img src="{{ asset('frontend/assets/img/marigot.jpg') }}" class="img-fluid" alt=""></div>
                    <div class="col-lg-8">
                        <h4><a href="#">Marigot Houet : Plus de 200 poissons sacrés  meurent dans les eaux</a></h4>
                        <p>Plus de 200 poissons notamment les silures sacrés  sont morts dans les eaux du marigot  Houet  à la hauteur du pont à coté du musée communal.
                            Les poissons morts ont été découverts entre le 24 et le 25 février 2023 dans des eaux noirâtres, laissant supposer une pollution.
                            Cette pollution du marigot Houet, cause de la mort des silures, serait due,  selon une source communale, aux eaux sales ...</p>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-lg-4"><img src="{{ asset('frontend/assets/img/marigot.jpg') }}" class="img-fluid" alt=""></div>
                    <div class="col-lg-8">
                        <h4><a href="#">Marigot Houet : Plus de 200 poissons sacrés  meurent dans les eaux</a></h4>
                        <p>Plus de 200 poissons notamment les silures sacrés  sont morts dans les eaux du marigot  Houet  à la hauteur du pont à coté du musée communal.
                            Les poissons morts ont été découverts entre le 24 et le 25 février 2023 dans des eaux noirâtres, laissant supposer une pollution.
                            Cette pollution du marigot Houet, cause de la mort des silures, serait due,  selon une source communale, aux eaux sales ...</p>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-lg-4"><img src="{{ asset('frontend/assets/img/criquet.jpg') }}" class="img-fluid" alt=""></div>
                    <div class="col-lg-8">
                        <h4><a href="#">Marigot Houet : Plus de 200 poissons sacrés  meurent dans les eaux</a></h4>
                        <p>Plus de 200 poissons notamment les silures sacrés  sont morts dans les eaux du marigot  Houet  à la hauteur du pont à coté du musée communal.
                            Les poissons morts ont été découverts entre le 24 et le 25 février 2023 dans des eaux noirâtres, laissant supposer une pollution.
                            Cette pollution du marigot Houet, cause de la mort des silures, serait due,  selon une source communale, aux eaux sales ...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
