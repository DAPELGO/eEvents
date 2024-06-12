<!-- ======= Top Bar ======= -->
<div id="topbar" class="d-flex align-items-center fixed-top">
    <div class="container-fluid d-flex justify-content-between">
      <div class="contact-info d-flex align-items-center">
        <i class="bi bi-envelope"></i> <span style="font-size: 0.8rem;">contact@example.com</span>
        <i class="bi bi-phone"></i> <span style="font-size: 0.8rem;">+1 5589 55488 55</span>
        <a href="#" style="margin-left: 1rem; margin-right:0.5rem;">Prévention</a> |
        <a href="#" style="margin-left: 0.5rem;">Préparation et riposte aux urgences de santé publique</a>
      </div>
      <div class="contact-info d-flex align-items-center">
        <input type="search" placeholder="Rechercher" size="15" style="padding-left: 0.5rem; font-size:12px;"><i class="bi bi-search" style="margin-left: -25px; color: #444444; font-size:12px;"></i>
        <span style="padding: 0.2rem 0.5rem;color: #c65b16; margin-left:1rem; font-weight: bold;"><i class="bi bi-phone-vibrate-fill"></i> 3535</span>
        @if (Auth::user())
        <nav class="navbar order-last order-lg-0">
            <ul>
              <li class="dropdown"><a href="#"><span><img src="@if(Auth::user()->url_profil == '')
                {{ asset('/frontend/assets/img/avatar.png') }}
                    @else
                    {{ asset(Storage::disk('local')->url(Auth::user()->url_profil)) }}
                @endif" class="img-profil mr-2" alt="{{ Auth::user()->name }}" style="height: 1rem;"></span> <i class="bi bi-chevron-down"></i></a>
                <ul style="left: -100px;">
                    <li><a href="{{ route('profile.password') }}">Changer mot de passe</a></li>
                    <li><a href="{{ route('profile.edit') }}">Mettre à jour profil </a></li>
                    <li><a href="{{ route('frontend.mescandidatures') }}">Mes Candidatures </a></li>
                    <li><a href="{{ route('frontend.messtages') }}">Mes demandes de stages </a></li>
                    <li>
                        <a href="{{ route('user.logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <span data-i18n="drpdwn.page-logout">Se déconnecter</span>
                            </a>

                            <form id="logout-form" action="{{ route('user.logout') }}" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                    </li>
                </ul>
              </li>
            </ul>
        </nav>
        @else
        <a href="{{ route('user.login') }}" class="btn" style="background-color: #c75c19; color: #FFF;">Connexion</a>
        <a href="{{ route('inscription.create') }}" class="btn" style="background-color: #c75c19; color: #FFF; margin-left: 0.5rem;">Inscription</a>
        @endif
      </div>
    </div>
  </div>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <h1 class="logo me-auto"><a href="{{ route('frontend.welcome') }}"><img src="{{ asset('backend/assets/images/logocorus.png')}}" alt="LOGO CORUS"></a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo me-auto"><img src="{{ asset('frontend/assets/images/logbackend/assets/images/logocorus.png') }}" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="nav-link scrollto active" href="{{ route('frontend.welcome') }}">Accueil</a></li>
          <li class="dropdown"><a href="#"><span>Urgences de santé publique</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
                <li><a href="#">Evènements en cours </a></li>
                <li><a href="#">Réponse sanitaire en cours </a></li>
                <li><a href="#">Réponse sanitaire réalisée </a></li>
            </ul>
          </li>
          <li class="dropdown"><a href="#"><span>Risques sanitaires </span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="#">Informations publiques</a></li>
              <li><a href="#">Evaluation des risques </a></li>
              <li><a href="#">Capacités opérationnelles (ressources pour la préparation et la réponse) </a></li>
            </ul>
          </li>
          <li class="dropdown"><a href="#"><span>Formations</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="#">Formations disponibles</a></li>
              <li><a href="#">Formations planifiées</a></li>
              <li><a href="#">Formations réalisées</a></li>
            </ul>
          </li>
          <li class="dropdown"><a href="#"><span>Exercices de simulations</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="#">Exercice de simulations planifiées</a></li>
              <li><a href="#">Exercices de simulations réalisés</a></li>
            </ul>
          </li>
          <li class="dropdown"><a href="#"><span>Ressources</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="#">Evaluations et recherches opérationnelles</a></li>
              <li><a href="#">Textes réglementaires</a></li>
              <li><a href="#">Plans, procédures, directives</a></li>
              <li><a href="#">Statistiques</a></li>
              <li><a href="#">Médiathèques</a></li>
            </ul>
          </li>
          <li class="dropdown"><a href="#"><span>Le CORUS</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="#">Mission</a></li>
              <li><a href="#">Vision</a></li>
              <li><a href="#">Equipe et expertises</a></li>
            </ul>
          </li>
          <li><a class="nav-link scrollto" href="#contact">Actualités</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->
