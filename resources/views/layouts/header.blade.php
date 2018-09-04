<div class="navbar navbar-expand-lg align-items-center navbar-light border-bottom box-shadow" >

    <h5 class="my-0 mr-md-auto font-weight-normal">Projet Réservations</h5>
    {{--<h5 class="navbar-brand">Projet Réservations</h5>--}}



    <div class="collapse navbar-collapse">
        <ul class="navbar-nav ml-auto">
            <form class="form-inline mt-2 mt-md-0" style="margin-bottom: 0px" method="GET" action="{{ route('shows.index') }}" style="margin-right: 30px;">
                <input class="form-control mr-sm-2" type="text" name="search" placeholder="Rechercher" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">🔍</button>
            </form>

            <li class="nav-item">
                <a class="nav-link" href="{{ url('artist') }}">Artistes</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ url('shows') }}">Spectacles</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('representation') }}">Représentations</a>
            </li>

            @if (Auth::check())
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('reservation.index') }}">Réservations</a>
                </li>

                @if(Auth::user()->isAdmin())
                    <li class="nav-item">
                        <a class="nav-link" href=" {{ route('localities.index') }}">Localités</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href=" {{ route('locations.index') }}">Localisations</a>
                    </li>
                @endif

                <li class="nav-item">
                    <a class="nav-link" href=" {{ route('user.edit') }}">Mon Profil</a>
                </li>


                <li class="nav-item">
                    <a class="btn btn-outline-success" style="margin-top: 5px;" href="{{ route('logout') }}"
                       style="margin-left: 10px;"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Déconnecter
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            @else

                <li class="nav-item">
                    <a class="btn btn-outline-success" style="margin-right: 10px;" href="{{ route('login') }}">
                        Se connecter</a>
                <li>
                <li class="nav-item">
                    <a class="btn btn-outline-primary" href="{{ route('register') }}">S'inscrire</a>
                </li>

            @endif


        </ul>
    </div>

</div>
<br>

