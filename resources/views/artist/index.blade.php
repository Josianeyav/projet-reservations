@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Artistes</div>
                    <div class="card-body">
                        @if(Auth::check() && Auth::user()->isAdmin())
                        <a href="{{ url('/artist/create') }}" class="btn btn-success btn-sm" title="Add New Artist">
                            <i class="fa fa-plus" aria-hidden="true"></i> Créér un nouvel artiste
                        </a>
                        @endif


                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Prénom</th>
                                    <th>Nom</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($artist as $item)
                                    <tr>
                                        <td>{{ $loop->iteration or $item->id }}</td>
                                        <td>{{ $item->firstname }}</td>
                                        <td>{{ $item->lastname }}</td>
                                        @if(Auth::check() && Auth::user()->isAdmin())
                                            <td>
                                                <a href="{{ url('/artist/' . $item->id) }}" title="View Artist">
                                                    <button class="btn btn-info btn-sm"><i class="fa fa-eye"
                                                                                           aria-hidden="true"></i> Voir
                                                    </button>
                                                </a>
                                                <a href="{{ url('/artist/' . $item->id . '/edit') }}"
                                                   title="Edit Artist">
                                                    <button class="btn btn-primary btn-sm"><i
                                                                class="fa fa-pencil-square-o"
                                                                aria-hidden="true"></i> Éditer
                                                    </button>
                                                </a>

                                                <form method="POST" action="{{ url('/artist' . '/' . $item->id) }}"
                                                      accept-charset="UTF-8" style="display:inline">
                                                    {{ method_field('DELETE') }}
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                            title="Delete Artist"
                                                            onclick="return confirm('Êtes vous sûr?')"><i
                                                                class="fa fa-trash-o" aria-hidden="true"></i> Supprimer
                                                    </button>
                                                </form>
                                            </td>
                                        @else
                                            <td>
                                                <a href="{{ url('/artist/' . $item->id) }}" title="View Artist">
                                                    <button class="btn btn-info btn-sm"><i class="fa fa-eye"
                                                                                           aria-hidden="true"></i> Voir
                                                    </button>
                                                </a>
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
