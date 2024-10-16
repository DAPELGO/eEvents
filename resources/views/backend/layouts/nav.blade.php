<!-- ============================================================== -->
<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="nav-devider"></li>
                <li> <a href="{{ route('frontend.welcome') }}" target="_blank"><span class="hide-menu"><i class="fa fa-level-up"></i>Accueil site web</span></a>
                <li> <a class="@yield('home')" href="{{ route('backend.home') }}"><span class="hide-menu"><i class="fa fa-home"></i>Tableau de bord</span></a>
                <li class="nav-devider"></li>
                <li class="nav-small-cap">APPLICATION</li>
                @can('events.view', Auth::user())
                    <li> <a href="{{ route('evenements.index') }}" class="@yield('event')"><i class="fa fa-exclamation-triangle mr-1"></i>Evènements</a></li>
                @endcan
                <li> <a href="{{ route('users.index') }}" class="@yield('user')"><i class="fa fa-users mr-1"></i>Internautes</a></li>
                <li> <a href="{{ route('offres.index') }}" class="@yield('offre')"><i class="fa fa-handshake-o mr-1"></i>Offres</a></li>
                <li> <a href="{{ route('formations.index') }}" class="@yield('formation')"><i class="fa fa-slideshare mr-1"></i>Formations</a></li>
                @can('structures.view', Auth::user())
                    <li> <a href="{{ route('structures.index') }}" class="@yield('structure')"><i class="fa fa-hospital-o mr-1"></i>Structures</a></li>
                @endcan
                <li class="nav-small-cap">SITE</li>
                @can('categories.view', Auth::user())
                    <li> <a href="{{ route('categories.index') }}" class="@yield('categorie')"><i class="fa fa-cubes mr-1"></i>Catégories</a></li>
                @endcan
                @can('articles.view', Auth::user())
                    <li> <a href="{{ route('articles.index') }}" class="@yield('article')"><i class="fa fa-file-text mr-1"></i>Articles</a></li>
                @endcan
                <li> <a href="{{ route('frontend.welcome') }}" class="@yield('media')"><i class="fa fa-picture-o mr-1"></i>Médiathèque</a></li>
                <li class="nav-small-cap">ADMINISTRATION</li>
                <li> <a href="{{ route('roles.index') }}" class="@yield('role')"><i class="fa fa-key mr-1"></i>Rôles</a></li>
                <li> <a href="{{ route('permissions.index') }}" class="@yield('permission')"><i class="fa fa-shield mr-1"></i>Permissions</a></li>
                <li> <a href="{{ route('admins.index') }}" class="@yield('admin')"><i class="fa fa-user mr-1"></i>Administrateurs</a></li>
                <li> <a href="{{ route('parametres.index') }}" class="@yield('parametre')"><i class="fa fa-cog mr-1"></i>Paramètres</a></li>
                <li> <a href="{{ route('valeurs.index') }}" class="@yield('valeur')"><i class="fa fa-cogs mr-1"></i>Valeurs</a></li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
<!-- ============================================================== -->
<!-- End Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
