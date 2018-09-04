@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Représentation</div>
                    <div class="card-body">
                        @if(Auth::check() && Auth::user()->isAdmin())
                            <a href="{{ url('/representation/create') }}" class="btn btn-success btn-sm"
                               title="Add New Representation">
                                <i class="fa fa-plus" aria-hidden="true"></i>Créer une nouvelle représentation
                            </a>
                        @endif


                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Référence</th>
                                    <th>Spectacle</th>
                                    @if(Auth::check() && Auth::user()->isAdmin())
                                        <th>Actions</th>
                                    @endif
                                    <th>
                                        Réserver
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($representation as $item)
                                    <tr>
                                        <?php $show = $item->show()->firstOrFail()?>
                                        <td>{{ $loop->iteration or $item->id }}</td>
                                        <td>{{ $item->beautifulSchedule() }}</td>
                                        <td>{{ $item->ref }}</td>
                                        <td>
                                            <a href="{{ route('shows.show', $show) }}">
                                                {{ title_case($show->title) }}
                                            </a>
                                        </td>
                                        @if(Auth::check() && Auth::user()->isAdmin())
                                            <td>
                                                <a href="{{ url('/representation/' . $item->id . '/edit') }}"
                                                   title="Edit Representation">
                                                    <button class="btn btn-primary btn-sm"><i
                                                                class="fa fa-pencil-square-o"
                                                                aria-hidden="true"></i> Éditer
                                                    </button>
                                                </a>

                                                <form method="POST"
                                                      action="{{ url('/representation' . '/' . $item->id) }}"
                                                      accept-charset="UTF-8" style="display:inline">
                                                    {{ method_field('DELETE') }}
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                            title="Delete Representation"
                                                            onclick="return confirm('Êtes vous sûr?')"><i
                                                                class="fa fa-trash-o" aria-hidden="true"></i> Supprimer
                                                    </button>
                                                </form>
                                            </td>
                                        @endif
                                        <td>
                                            @if(Auth::check() && !Auth::user()->isAdmin())

                                                <a href="{{ route('representation.show', $item) }}"
                                                   class="btn btn-sm btn-success">Réserver</a>
                                            @elseif(Auth::check())
                                                Vous êtes l'administrateur
                                            @else
                                                <a href="{{ route('login') }}">Connectez-vous</a>

                                            @endif
                                        </td>
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
