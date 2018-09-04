@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Artiste: {{ $artist->firstname }} {{ $artist->lastname }}</div>
                    <div class="card-body">

                        @if(Auth::check() && Auth::user()->isAdmin())
                        <a href="{{ url('/artist') }}" title="Retour">
                            <button class="btn btn-info btn-sm">
                                <i class="fa fa-arrow-left" aria-hidden="true"></i>
                                Retour
                            </button>
                        </a>
                        <a href="{{ url('/artist/' . $artist->id . '/edit') }}" title="Edit Artist">
                            <button class="btn btn-primary btn-sm">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Éditer
                            </button>
                        </a>

                        <form method="POST" action="{{ url('artist' . '/' . $artist->id) }}" accept-charset="UTF-8"
                              style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Artist"
                                    onclick="return confirm('Confirm delete?')">
                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                                Supprimer
                            </button>
                        </form>
                        <br/>
                        <br/>
                        @endif

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <th>ID</th>
                                    <td>{{ $artist->id }}</td>
                                </tr>
                                <tr>
                                    <th> Prénom</th>
                                    <td> {{ $artist->firstname }} </td>
                                </tr>
                                <tr>
                                    <th> Nom</th>
                                    <td> {{ $artist->lastname }} </td>
                                </tr>
                                <tr>
                                    <th> Type</th>
                                    <td>
                                        @foreach($artist->artisteTypes()->get() as $artistType)
                                            {{ title_case($artistType->type()->first()->type) }}
                                        @endforeach
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                        @if(Auth::check() && Auth::user()->isAdmin())
                            <a href="{{ route('artistType.editForArtist', $artist->id) }}" class="btn btn-success">
                                Éditer types
                            </a>

                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
