@extends('frontend.layouts.layouts')
@section('team', 'actived')
@section('corus', 'active')
@section('content')
<section id="team" class="doctors" style="padding-top: 120px; padding-bottom: 0;">
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
                        <a href="#" class="twitter"><i class="bx bxl-twitter"></i> Détails</a><br>
                        <a href="#" class="facebook"><i class="bx bxl-facebook"></i> Facebook</a><br>
                        <a href="#" class="facebook"><i class="bx bxl-youtube"></i> Youtube</a><br>
                        <a href="#" class="instagram"><i class="bx bxl-instagram"></i> Instagram</a><br>
                        <a href="#" class="google-plus"><i class="bx bxl-skype"></i> Google-plus</a><br>
                        <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i> Linked</a>
                    </p>
                </div>
            </div>
            <div class="col-lg-10 mission">
                <h2 class="title" style="text-align: center;">ALERT D'EVENEMENT</h2>
                <hr>
                  <div class="row">

                    <div class="col-lg-6">
                      <div class="member d-flex align-items-start">
                        <div class="pic"><img src="{{ asset('frontend/assets/img/contact.png') }}" class="img-fluid" alt="" style="height: 8rem;"></div>
                        <div class="member-info">
                          <h4>Bonjour M./Mme {{ $evenement->name }}</h4>
                          <span>{{ $evenement->email }}/{{ $evenement->name }}</span>
                          <p>Merci d'avoir contacter l'équipe du CORUS</p>
                        </div>
                      </div>
                    </div>

                    <div class="col-lg-6 mt-4 mt-lg-0">
                      <div class="member d-flex align-items-start">
                        <div class="member-info">
                          <h4>Objet</h4>
                          <span>{{ $evenement->objet }}</span>
                          <p>Aut maiores voluptates amet et quis praesentium qui senda para</p>
                        </div>
                      </div>
                    </div>

                    <div class="col-lg-6 mt-4">
                      <div class="member d-flex align-items-start">
                        <div class="pic"><img src="{{ asset('frontend/assets/img/doctors/doctors-3.jpg') }}" class="img-fluid" alt=""></div>
                        <div class="member-info">
                          <h4>Ahmed Bereouhoudougou</h4>
                          <span>Ingérieur réseaux informatiques</span>
                          <p>Quisquam facilis cum velit laborum corrupti fuga rerum quia</p>
                        </div>
                      </div>
                    </div>

                    <div class="col-lg-6 mt-4">
                      <div class="member d-flex align-items-start">
                        <div class="pic"><img src="{{ asset('frontend/assets/img/doctors/doctors-4.jpg') }}" class="img-fluid" alt=""></div>
                        <div class="member-info">
                          <h4>Dr Jepson Kaboré</h4>
                          <span>Expert urgence</span>
                          <p>Dolorum tempora officiis odit laborum officiis et et accusamus</p>
                        </div>
                      </div>
                    </div>

                  </div>
            </div>
        </div>
    </div>
</section>
@endsection
