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
                <li class="nav-small-cap">APPLICATION</li>
                <li> <a href="{{ route('events.index') }}" class="@yield('event')"><i class="mdi mdi-gauge"></i>Evènements</a></li>
                <li> <a href="{{ route('users.index') }}" class="@yield('user')"><i class="mdi mdi-gauge"></i>Internautes</a></li>
                <li> <a href="{{ route('offres.index') }}" class="@yield('offre')"><i class="mdi mdi-gauge"></i>Offres</a></li>
                <li> <a href="{{ route('formations.index') }}" class="@yield('formation')"><i class="mdi mdi-gauge"></i>Formations</a></li>
                <li class="nav-small-cap">SITE</li>
                <li> <a href="{{ route('categories.index') }}" class="@yield('categorie')"><i class="mdi mdi-gauge"></i>Catégorie</a></li>
                <li> <a href="{{ route('articles.index') }}" class="@yield('article')"><i class="mdi mdi-gauge"></i>Articles</a></li>
                <li> <a href="{{ route('frontend.welcome') }}" class="@yield('media')"><i class="mdi mdi-gauge"></i>Médiathèque</a></li>
                <li class="nav-small-cap">ADMINISTRATION</li>
                <li> <a href="{{ route('roles.index') }}" class="@yield('role')"><i class="mdi mdi mdi-account-box-outline"></i>Rôles</a></li>
                <li> <a href="{{ route('permissions.index') }}" class="@yield('permission')"><i class="mdi mdi-security"></i>Permissions</a></li>
                <li> <a href="{{ route('admins.index') }}" class="@yield('admin')"><i class="mdi mdi-account-star"></i>Utilisateurs</a></li>
                <li> <a href="{{ route('parametres.index') }}" class="@yield('parametre')"><i class="mdi mdi-gauge"></i>Paramètres</a></li>
                <li> <a href="{{ route('valeurs.index') }}" class="@yield('valeur')"><i class="mdi mdi-gauge"></i>Valeurs</a></li>
                <li> <a href="{{ route('structures.index') }}" class="@yield('structure')"><i class="mdi mdi-gauge"></i>Structures</a></li>
                <li> <a href="{{ route('localites.index') }}" class="@yield('localite')"><i class="mdi mdi-gauge"></i>Localités</a></li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
<!-- ============================================================== -->
<!-- End Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
