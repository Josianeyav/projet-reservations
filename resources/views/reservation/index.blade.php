@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-12">
                <div class="card">
                    <div class="card-header">Réservations</div>
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Places</th>
                                    <th>Spectacle</th>
                                    <th>Date</th>
                                    <th>Prix</th>
                                    @if (Auth::check() && Auth::user()->isAdmin())
                                    <th>Utilisateur</th>
                                    @endif
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($reservations as $item)
                                    <?php
                                    $representation = $item->representation()->firstOrFail();
                                    $show = $representation->show()->firstOrFail();
                                    $user = $item->user()->firstOrFail();
                                    ?>

                                    <tr>
                                        <td>{{ $item->places }}</td>
                                        <td>
                                            <a href="{{ route('shows.show', $show) }}">{{ $show->title}}</a>
                                        </td>
                                        <td>{{ $representation->beautifulSchedule() }}</td>
                                        <td>{{ $item->places * $show->price }}€</td>
                                        <td>
                                            {{ $user->fullname() }}
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
