@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Localities</div>
                    <div class="card-body">
                        @if(Auth::check() && Auth::user()->isAdmin())
                        <a href="{{ url('/localities/create') }}" class="btn btn-success btn-sm" title="Add New Locality">
                            <i class="fa fa-plus" aria-hidden="true"></i> Créér une nouvelle localité
                        </a>
                        <br/>
                        <br/>
                        @endif

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Code Postal</th>
                                        <th>Localité</th>
                                        @if(Auth::check() && Auth::user()->isAdmin())
                                        <th>Actions</th>
                                            @endif
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($localities as $item)
                                    <tr>
                                        <td>{{ $loop->iteration or $item->id }}</td>
                                        <td>{{ $item->postal_code }}</td><td>{{ $item->locality }}</td>
                                        @if(Auth::check() && Auth::user()->isAdmin())
                                        <td>
                                            <a href="{{ url('/localities/' . $item->id) }}" title="View Locality">
                                                <button class="btn btn-info btn-sm">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                    Voir
                                                </button>
                                            </a>
                                            <a href="{{ url('/localities/' . $item->id . '/edit') }}">
                                                <button class="btn btn-primary btn-sm">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                    Éditer
                                                </button>
                                            </a>

                                            <form method="POST" action="{{ url('/localities' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete Locality" onclick="return confirm('Êtes vous sûr?')">
                                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                    Supprimer
                                                </button>
                                            </form>
                                        </td>
                                            @endif
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
