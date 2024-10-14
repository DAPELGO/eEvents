@extends('frontend.layouts.layouts')
@section('risque', 'active')
@section('evaluation', 'actived')
@section('content')
<section id="mission" style="padding-top: 120px; padding-bottom: 0;">
    <div class="container">
        <div class="row">
            <div class="col-lg-2">
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
            <div class="col-lg-7 mission" style="background: #f2f2f2; padding: 1rem;">
                <h2 class="title">LES EQUIPES ET EXPERTISE DU CENTRE</h2>
                <p>Le centre est organisé en plusieurs équipes pluridisciplinaires</p>
                <hr>
                <h2 class="title">L'organisation du CORUS </h2>
                <p>Le CORUS est composé de six (06) sections qui sont :
                    <ul>
                        <li><b>Surveillance des évènements sanitaires</b> : Assure la veille sanitaire à travers l’organisation de la collecte, l’analyse et l’interprétation des données intra et intersectorielle en temps réél ; </li>
                        <li><b>Opérations</b> : Coordonne et mets en œuvre la préparation, l’investigation et la réponse aux incidents ainsi que les exercices de simulation ;</li>
                        <li><b>Planning</b> : Assure l’élaboration et la mise en œuvre des stratégies, des plans d’action et de ripostes, des directives ainsi que leur suivi et évaluation ; </li>
                        <li><b>Logistique</b> : Coordonne la mobilisation et le déploiement du soutien logistique lors des interventions et de gestion d’incidents ainsi que les formalités de déploiement ; </li>
                        <li><b>Administration, finance et comptabilité</b> : Assure la gestion des ressource humaines, matérielles et financières ; </li>
                        <li><b>Système d’information et communication</b> : Coordonne l’élaboration et la mise en œuvre du schéma directeur du système d’information et pilote le système d'information ainsi que la communication sur les risques et la surveillance des médias. </li>
                    </ul>
                </p>
                <hr>
                <img src="{{ asset('frontend/assets/img/orgacorus.png')}}" alt="ORGANIGRAMME CORUS">
            </div>
            <div class="col-lg-3" style="padding-top: 0.5rem;">
                <div class="title">La vision</div>
                <p style="font-size: 13px; line-height: 18px; color: #333; margin-bottom: 10px;"> Assurer le leadership dans la préparation collective, la coordination et la gestion des opérations liées aux risques et urgences sanitaires au Burkina Faso à l’horizon 2023</p>
            </div>
        </div>
    </div>
</section>
@endsection
