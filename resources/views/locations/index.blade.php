@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-12">
                <div class="card">
                    <div class="card-header">Localisations</div>
                    <div class="card-body">
                        @if(Auth::check() && Auth::user()->isAdmin())
                        <a href="{{ url('/locations/create') }}" class="btn btn-success btn-sm" >
                            <i class="fa fa-plus" aria-hidden="true">

                            </i> Ajouter une nouvelle localisation
                        </a>


                        <br/>
                        <br/>
                        @endif
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Désignation</th>
                                        <th>Adresse</th>
                                        <th>Tel</th>
                                        <th>Website</th>
                                        <th>Localisation</th>
                                        @if(Auth::check() && Auth::user()->isAdmin())
                                        <th>Actions</th>
                                            @endif
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($locations as $item)
                                    <tr>
                                        <td>{{ $loop->iteration or $item->id }}</td>
                                        <td>{{ $item->designation }}</td>
                                        <td>{{ $item->address }}</td>
                                        <td>{{ $item->phone }}</td>
                                        <td>{{ $item->website }}</td>
                                        <td>{{ $item->locality()->firstOrFail()->locality }}</td>
                                        @if(Auth::check() && Auth::user()->isAdmin())
                                        <td>
                                            <a href="{{ url('/locations/' . $item->id) }}" title="View Location"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/locations/' . $item->id . '/edit') }}" title="Edit Location"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            <form method="POST" action="{{ url('/locations' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete Location" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
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
