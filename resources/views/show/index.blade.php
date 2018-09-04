@extends('layouts.app')

@section('stylesheets')
    {{--<link rel="stylesheet" type="text/css"--}}
    {{--href="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.18/datatables.min.css"/>--}}
    {{--<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4-4.1.1/jq-3.3.1/dt-1.10.18/datatables.min.css"/>--}}
    <link rel="stylesheet" type="text/css"
          href="{{ asset('css/datatables.min.css') }}"/>

    <style>
        .wrapper {
            margin: 1em auto;
            max-width: 800px;
            width: 95%;
            font: 14px/1.5 sans-serif;
        }
    </style>
@endsection


@section('javascript')


    <script type="text/javascript" src="{{ asset('js/datatables.min.js') }}"></script>

    <script>
        $(document).ready(function () {
            $('#table_shows').DataTable({
                responsive: true,
                "search": { "search": "{{ $search }}"
                }
            });
        });
    </script>
@endsection


@section('content')

    {{--        @include('layouts.menu')--}}

    <div id="page-content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">


                    <h1 style="display: inline-block">{{ $titre }}</h1>
                    <a rel="alternate" type="application/atom+xml" title="RSS" href="{{ url('feeds/shows')  }}">
                        <img style="margin-bottom: 1.0rem" src="{{ asset('images/feed-icon-28x28.png') }}"
                             alt="Subscribe to RSS">
                    </a>
                    @if(Auth::check() && Auth::user()->isAdmin())
                        <br>

                        <strong>Export</strong>
                        <br>
                        <a style="margin-bottom: 1.0rem" class="btn btn-sm btn-success"
                           href="{{ route('shows.exportCSV') }}">
                            Export CSV
                        </a>
                        <br>
                        <strong style="display: inline-block;">Import</strong>
                        <form action="{{ route('shows.importCSV') }}" method="POST" class="form-inline"
                              enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="file" name="dataFile" id="dataFile">
                            <button class="btn btn-sm btn-success">Import CSV</button>
                        </form>

                        <br><br><strong>Spectacles</strong>

                        <a href="{{ route('shows.create') }}" class="btn btn-sm btn-success">Créér un nouveau spectacle</a>
                    @endif



                    <br><br>
                    <table id="table_shows" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Titre</th>
                            <th>Auteur(s)</th>
                            <th>Lieu</th>
                            <th>Représentations</th>
                            <th>Prix</th>
                            <th>Réservable</th>
                            @if(Auth::check() && Auth::user()->isAdmin())
                                <th>Actions</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($shows as $show)
                            <tr>
                                <td>
                                    <a href="{{ route('shows.show', $show) }}">
                                        {{ title_case($show->title) }}
                                    </a>
                                </td>
                                <td>
                                    @foreach($show->authors() as $author)
                                        <a href="{{ route('artist.show', $author) }}">
                                            {{ $author->firstname }}&nbsp;{{ $author->lastname }}
                                        </a>

                                    @endforeach
                                </td>
                                <td>
                                    <a href="{{ route('location.show', $show->location) }}">
                                        {{ $show->location->designation }}
                                    </a>
                                </td>
                                <td>{{ $show->representations->count() }}</td>
                                <td>{{ number_format($show->price, 2, ',', '.') }}&nbsp;&euro;</td>
                                @if($show->bookable)
                                    <td>Oui</td>
                                @else
                                    <td>Non</td>
                                @endif
                                @if(Auth::check() && Auth::user()->isAdmin())
                                    <td>
                                        <a href="{{ url('/shows/' . $show->id . '/edit') }}" title="Éditer spectacle">
                                            <button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o"
                                                                                      aria-hidden="true"></i> Éditer
                                            </button>
                                        </a>

                                        <form method="POST" action="{{ url('/shows' . '/' . $show->id) }}"
                                              accept-charset="UTF-8" style="display:inline">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                    title="Supprimer spectacle"
                                                    onclick="return confirm('Êtes vous sûr?')">
                                                <i class="fa fa-trash-o" aria-hidden="true"></i> Supprimer
                                            </button>
                                        </form>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <p>Total: {{ $shows->count() }} spectacles.</p>
                </div>
            </div>
        </div>

    </div>

@endsection
