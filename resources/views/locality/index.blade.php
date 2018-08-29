@extends('layouts.app')
@section('title', 'Liste des localities')
@section('content')
    <h1>Liste des {{ $resource }}</h1>
    <table>
        <thead>
        <tr>
            <th>Postal Postal</th>
            <th>Locality</th>
        </tr>
        </thead>
        <tbody>
        @foreach($localities as $locality)
            <tr>
                <td>{{ $locality->postal_code }}</td>
                <td>{{ $locality->locality }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection