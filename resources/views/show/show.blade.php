@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Show: {{ $show->title }}</div>
                    <div class="card-body">
                        @if (Auth::check() && Auth::user()->isAdmin())
                            <a href="{{ url('/shows/' . $show->id . '/edit') }}" title="Edit Show">
                                <button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o"
                                                                          aria-hidden="true"></i> Éditer
                                </button>
                            </a>

                            <form method="POST" action="{{ url('shows' . '/' . $show->id) }}"
                                  accept-charset="UTF-8" style="display:inline">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Êtes vous sûr?')">
                                    <i class="fa fa-trash-o" aria-hidden="true"></i> Supprimer
                                </button>
                            </form>
                            <br><br>
                        @endif
                        <div class="table-responsive ">
                            <table class="table table-striped">
                                <tbody>
                                <tr>
                                    <th>Auteurs</th>
                                    <td>

                                        @foreach($show->authors() as $author)
                                            <a href="{{ route('artist.show', $author) }}">
                                                {{ $author->firstname }}&nbsp;{{ $author->lastname }}
                                            </a>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>Location</th>
                                    <td>
                                        <a href="{{ route('location.show', $show->location) }}">
                                            {{ $show->location->designation }}
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Representations</th>
                                    <td>{{ $show->representations->count() }}</td>
                                </tr>
                                <tr>
                                    <th>Prix</th>
                                    <td>{{ number_format($show->price, 2, ',', '.') }}&nbsp;&euro;</td>
                                </tr>

                                </tbody>
                            </table>
                        </div>


                        @if ($show->poster_url)
                            <div style="text-align: center">
                                <strong>Affiche</strong><br>
                                <img src="{{ asset('storage/' . $show->poster_url) }}" alt="Poster">
                                <br><br>
                            </div>
                        @else
                            <strong>Pas d'affiche</strong>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <td>Date</td>
                                    <td>Réserver</td>
                                </tr>
                                </thead>
                                <tbody>
                                @if($show->representations->count() == 0)
                                    <tr>
                                        <td>Pas de représentations</td>
                                        <td></td>
                                    </tr>
                                @endif

                                @foreach($show->representations as $representation)
                                    <tr>
                                        <td>{{ $representation->beautifulSchedule() }}</td>
                                        <td>


                                            @if($show->bookable)
                                                @if(Auth::check())
                                                    <a class="btn btn-sm btn-success"
                                                       href="{{ route('representation.show', $representation) }}">
                                                        Réserver
                                                    </a>
                                                @else
                                                    <a href="{{ route('login') }}">Connectez-vous pour réserver</a>
                                                @endif
                                            @else
                                                Non réservable
                                            @endif

                                        </td>
                                    </tr>
                                @endforeach
                                <tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
