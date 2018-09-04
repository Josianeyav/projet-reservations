@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Reservation</div>
                    <div class="card-body">
                        {{--<a href="{{ url('/reservation/create') }}" class="btn btn-success btn-sm"--}}
                           {{--title="Add New Reservation">--}}
                            {{--<i class="fa fa-plus" aria-hidden="true"></i> Add New--}}
                        {{--</a>--}}

                        {{--<form method="GET" action="{{ url('/reservation') }}" accept-charset="UTF-8"--}}
                              {{--class="form-inline my-2 my-lg-0 float-right" role="search">--}}
                            {{--<div class="input-group">--}}
                                {{--<input type="text" class="form-control" name="search" placeholder="Search..."--}}
                                       {{--value="{{ request('search') }}">--}}
                                {{--<span class="input-group-append">--}}
                                    {{--<button class="btn btn-secondary" type="submit">--}}
                                        {{--<i class="fa fa-search"></i>--}}
                                    {{--</button>--}}
                                {{--</span>--}}
                            {{--</div>--}}
                        {{--</form>--}}

                        {{--<br/>--}}
                        {{--<br/>--}}
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Places</th>
                                    <th>Title</th>
                                    <th>Schedule</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($reservations as $item)
                                    <?php
                                    $representation = $item->representation()->firstOrFail();
                                    $show = $representation->show()->first();
                                    $show = $representation->show()->first();
                                    ?>

                                    <tr>
                                        <td>{{ $item->places }}</td>
                                        <td>
                                            <a href="{{ route('shows.show', $show) }}">{{ $show->title}}</a>
                                        </td>
                                        <td>{{ $representation->beautifulSchedule() }}</td>
                                        <td>
                                            {{--<a href="{{ url('/reservation/' . $item->id) }}" title="View Reservation">--}}
                                                {{--<button class="btn btn-info btn-sm"><i class="fa fa-eye"--}}
                                                                                       {{--aria-hidden="true"></i> View--}}
                                                {{--</button>--}}
                                            {{--</a>--}}

                                            {{--<a href="{{ url('/reservation/' . $item->id . '/edit') }}"--}}
                                               {{--title="Edit Reservation">--}}
                                                {{--<button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o"--}}
                                                                                          {{--aria-hidden="true"></i> Edit--}}
                                                {{--</button>--}}
                                            {{--</a>--}}

                                            {{--<form method="POST" action="{{ url('/reservation' . '/' . $item->id) }}"--}}
                                                  {{--accept-charset="UTF-8" style="display:inline">--}}
                                                {{--{{ method_field('DELETE') }}--}}
                                                {{--{{ csrf_field() }}--}}
                                                {{--<button type="submit" class="btn btn-danger btn-sm"--}}
                                                        {{--title="Delete Reservation"--}}
                                                        {{--onclick="return confirm(&quot;Confirm delete?&quot;)"><i--}}
                                                            {{--class="fa fa-trash-o" aria-hidden="true"></i> Delete--}}
                                                {{--</button>--}}
                                            {{--</form>--}}
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
