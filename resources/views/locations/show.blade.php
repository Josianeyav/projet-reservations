@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Localisation {{ $location->designation }}</div>
                    <div class="card-body">

                        @if(Auth::check() && Auth::user()->isAdmin())
                        <a href="{{ url('/locations') }}" title="Back">
                            <button class="btn btn-info btn-sm">
                                <i class="fa fa-arrow-left" aria-hidden="true"></i>
                                Retour
                            </button>
                        </a>
                        <a href="{{ url('/locations/' . $location->id . '/edit') }}" title="Edit Location">
                            <button class="btn btn-primary btn-sm">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Éditer
                            </button>
                        </a>

                        <form method="POST" action="{{ url('locations' . '/' . $location->id) }}" accept-charset="UTF-8"
                              style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Location"
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
                                    <td>{{ $location->id }}</td>
                                </tr>
                                <tr>
                                    <th> Slug</th>
                                    <td> {{ $location->slug }} </td>
                                </tr>
                                <tr>
                                    <th> Designation</th>
                                    <td> {{ $location->designation }} </td>
                                </tr>
                                <tr>
                                    <th> Address</th>
                                    <td> {{ $location->address }} </td>
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
