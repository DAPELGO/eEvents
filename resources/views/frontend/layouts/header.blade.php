<!-- ======= Top Bar ======= -->
<div id="topbar" class="d-flex align-items-center fixed-top">
    <div class="container-fluid d-flex justify-content-between">
      <div class="contact-info d-flex align-items-center">
        <i class="bi bi-envelope"></i> <span style="font-size: 0.8rem;" class="me-2"><a href="mailto:alerte.operation@corus-insp.gov.bf"> alerte.operation@corus-insp.gov.bf</span>
        <i class="bi bi-phone"></i> <span style="font-size: 0.8rem;"><a href="tel:+22601 90 58 58">(+226) 01 90 58 58</a></span>
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
        <div class="row">
            <div class="col-lg-2">
                <h1 class="logo me-auto"><a href="{{ route('frontend.welcome') }}"><img src="{{ asset('backend/assets/images/logocorus.png')}}" alt="LOGO CORUS"></a></h1>
            </div>
            <div class="col-lg-9">
                <nav id="navbar" class="navbar order-last order-lg-0">
                    <ul>
                      <li class="text-uppercase" style="padding-left: 30px;"><a class="nav-link scrollto @yield('accueil')" href="{{ route('frontend.welcome') }}">Accueil</a></li>
                      <li class="dropdown text-uppercase"><a href="#"  class="@yield('urgence')"><span>Urgences Sanitaires</span> <i class="bi bi-chevron-down"></i></a>
                        <ul>
                            <li><a href="{{ route('menu.urgence', 'evenement') }}" class="@yield('evenement')">Evènements en cours </a></li>
                            <li><a href="{{ route('menu.urgence', 'reponse-cours') }}" class="@yield('reponse-cours')">Réponse sanitaire en cours </a></li>
                            <li><a href="{{ route('menu.urgence', 'reponse-realisee') }}" class="@yield('reponse-realisee')">Réponse sanitaire réalisée </a></li>
                        </ul>
                      </li>
                      <li class="dropdown text-uppercase" style="display: none;"><a href="#"  class="@yield('risque')"><span>Risques sanitaires </span> <i class="bi bi-chevron-down"></i></a>
                        <ul>
                          <li><a href="{{ route('menu.risque', 'information') }}" class="@yield('information')">Informations publiques</a></li>
                          <li><a href="{{ route('menu.risque', 'evaluation') }}" class="@yield('evaluation')">Evaluation des risques </a></li>
                          <li><a href="{{ route('menu.risque', 'capacite') }}" class="@yield('capacite')">Capacités opérationnelles (ressources pour la préparation et la réponse) </a></li>
                        </ul>
                      </li>
                      <li class="dropdown text-uppercase"><a href="#"  class="@yield('formation')"><span>Formations</span> <i class="bi bi-chevron-down"></i></a>
                        <ul>
                          <li><a href="{{ route('menu.formation', 'formation-disponible') }}" class="@yield('formation-disponible')">Formations disponibles</a></li>
                          <li><a href="{{ route('menu.formation', 'formation-planifiee') }}" class="@yield('formation-planifiee')">Catalogue de formation</a></li>
                          <li><a href="{{ route('menu.formation', 'formation-realisee') }}" class="@yield('formation-realisee')">Programme de formations</a></li>
                        </ul>
                      </li>
                      <li class="dropdown text-uppercase"><a href="#"  class="@yield('simulation')"><span>Simulations</span> <i class="bi bi-chevron-down"></i></a>
                        <ul>
                          <li><a href="{{ route('menu.simulation', 'exercice-planifie') }}" class="@yield('exercice-planifie')">Exercice de simulations planifiées</a></li>
                          <li><a href="{{ route('menu.simulation', 'exercice-realise') }}" class="@yield('exercice-realise')">Exercices de simulations réalisés</a></li>
                        </ul>
                      </li>
                      <li class="dropdown text-uppercase"><a href="#" class="@yield('ressource')"><span>Ressources</span> <i class="bi bi-chevron-down"></i></a>
                        <ul>
                          <li><a href="{{ route('menu.ressource', 'evaluation') }}" class="@yield('evaluation')">Evaluations et recherches opérationnelles</a></li>
                          <li style="display: none"><a href="{{ route('menu.ressource', 'texte') }}" class="@yield('texte')">Textes réglementaires</a></li>
                          <li><a href="{{ route('menu.ressource', 'plan') }}" class="@yield('plan')">Plans, procédures, directives</a></li>
                          <li><a href="{{ route('menu.ressource', 'statistique') }}" class="@yield('statistique')">Statistiques</a></li>
                          <li style="display: none"><a href="{{ route('menu.ressource', 'mediatheque') }}" class="@yield('mediatheque')">Médiathèques</a></li>
                        </ul>
                      </li>
                      <li class="dropdown text-uppercase"><a href="#" class="@yield('corus')"><span>Le CORUS</span> <i class="bi bi-chevron-down"></i></a>
                        <ul>
                          <li><a href="{{ route('menu.corus', 'mission') }}" class="@yield('mission')">Mission</a></li>
                          <li><a href="{{ route('menu.corus', 'vision') }}" class="@yield('vision')">Vision</a></li>
                          <li><a href="{{ route('menu.corus', 'team') }}" class="@yield('team')">Equipe et expertises</a></li>
                        </ul>
                      </li>
                      <li style="display: none" class="text-uppercase"><a class="nav-link scrollto @yield('actualite')" href="#contact">Actualités</a></li>
                    </ul>
                    <i class="bi bi-list mobile-nav-toggle"></i>
                  </nav><!-- .navbar -->
            </div>
        </div>
    </div>
  </header><!-- End Header -->
