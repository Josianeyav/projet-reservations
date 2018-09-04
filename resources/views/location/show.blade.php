@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Localisation: {{ $location->designation}}</div>
                    <div class="card-body">
                        {{--<a href="{{ url('/location/' . $location->id . '/edit') }}" title="Edit Artist">--}}
                            {{--<button class="btn btn-primary btn-sm">--}}
                                {{--<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Éditer--}}
                            {{--</button>--}}
                        {{--</a>--}}

                        {{--<form method="POST" action="{{ url('location' . '/' . $location->id) }}" accept-charset="UTF-8"--}}
                              {{--style="display:inline">--}}
                            {{--{{ method_field('DELETE') }}--}}
                            {{--{{ csrf_field() }}--}}
                            {{--<button type="submit" class="btn btn-danger btn-sm" title="Delete Artist"--}}
                                    {{--onclick="return confirm('Confirm delete?')">--}}
                                {{--<i class="fa fa-trash-o" aria-hidden="true"></i>--}}
                                {{--Supprimer--}}
                            {{--</button>--}}
                        {{--</form>--}}
                        {{--<br/>--}}
                        {{--<br/>--}}

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                <?php $locality = $location->locality()->firstOrFail(); ?>
                                <tr>
                                    <th>ID</th>
                                    <td>{{ $location->id }}</td>
                                </tr>

                                <tr>
                                    <th> Désignation</th>
                                    <td> {{ $location->designation }} </td>
                                </tr>
                                <tr>
                                    <th> Adresse</th>
                                    <td> {{ $location->address }} </td>
                                </tr>
                                <tr>
                                    <th> Localité </th>
                                    <td> {{ $locality->locality }} </td>
                                </tr>
                                <tr>
                                    <th> Code postal </th>
                                    <td> {{ $locality->postal_code }} </td>
                                </tr>
                                <tr>
                                    <th> Website</th>
                                    <td> {{ $location->website }} </td>
                                </tr>
                                <tr>
                                    <th> Tel.</th>
                                    <td> {{ $location->phone }} </td>
                                </tr>
                                <tr>
                                    <th> Slug</th>
                                    <td> {{ $location->slug }} </td>
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
