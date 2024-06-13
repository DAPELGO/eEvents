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
                <li> <a href="{{ route('users.index') }}"><i class="mdi mdi-gauge"></i>Internautes</a></li>
                <li> <a href="{{ route('offres.index') }}"><i class="mdi mdi-gauge"></i>Offres</a></li>
                <li> <a href="{{ route('formations.index') }}"><i class="mdi mdi-gauge"></i>Formations</a></li>
                <li class="nav-small-cap">SITE</li>
                <li> <a href="{{ route('categories.index') }}"><i class="mdi mdi-gauge"></i>Catégorie</a></li>
                <li> <a href="{{ route('articles.index') }}"><i class="mdi mdi-gauge"></i>Articles</a></li>
                <li> <a href="{{ route('frontend.welcome') }}"><i class="mdi mdi-gauge"></i>Médiathèque</a></li>
                <li class="nav-small-cap">ADMINISTRATION</li>
                <li> <a href="{{ route('roles.index') }}"><i class="mdi mdi-gauge"></i>Rôles</a></li>
                <li> <a href="{{ route('permissions.index') }}"><i class="mdi mdi-gauge"></i>Permissions</a></li>
                <li> <a href="{{ route('admins.index') }}"><i class="mdi mdi-gauge"></i>Utilisateurs</a></li>
                <li> <a href="{{ route('parametres.index') }}"><i class="mdi mdi-gauge"></i>Paramètres</a></li>
                <li> <a href="{{ route('valeurs.index') }}"><i class="mdi mdi-gauge"></i>Valeurs</a></li>
                <li> <a href="{{ route('structures.index') }}"><i class="mdi mdi-gauge"></i>Structures</a></li>
                <li> <a href="{{ route('localites.index') }}"><i class="mdi mdi-gauge"></i>Localités</a></li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
<!-- ============================================================== -->
<!-- End Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
