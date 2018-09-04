@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Localité {{ $locality->locality }}</div>
                    <div class="card-body">

                        <a href="{{ url('/localities') }}">
                            <button class="btn btn-info btn-sm">
                                <i class="fa fa-arrow-left" aria-hidden="true"></i>
                                Retour
                            </button>
                        </a>
                        @if(Auth::check() && Auth::user()->isAdmin())
                        <a href="{{ url('/localities/' . $locality->id . '/edit') }}">
                            <button class="btn btn-primary btn-sm">
                                <i class="fa fa-pencil-square-o"
                                   aria-hidden="true"></i> Éditer
                            </button>
                        </a>

                        <form method="POST" action="{{ url('localities' . '/' . $locality->id) }}"
                              accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Locality"
                                    onclick="return confirm('Êtes vous sûr?')">
                                <i class="fa fa-trash-o"
                                                                                             aria-hidden="true"></i>
                                Supprimer
                            </button>
                        </form>
                        @endif
                            <br/>
                        <br/>


                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <th>ID</th>
                                    <td>{{ $locality->id }}</td>
                                </tr>
                                <tr>
                                    <th> Postal Code</th>
                                    <td> {{ $locality->postal_code }} </td>
                                </tr>
                                <tr>
                                    <th> Locality</th>
                                    <td> {{ $locality->locality }} </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
