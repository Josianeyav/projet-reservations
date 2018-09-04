@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="table-responsive">
                <table class="table">
                    <tbody>
                    <tr>
                        <th>Show</th>
                        <td>
                            <a href="{{ route('shows.show', $show) }}">{{ $show->title}}</a>
                        </td>
                    </tr>
                    <tr>
                        <th> Date</th>
                        <td> {{ $representation->beautifulSchedule() }} </td>
                    </tr>
                    </tbody>
                </table>
            </div>


            @if($show->bookable)
                @if (Auth::check() && !Auth::user()->isAdmin())

                    <form class="form" method="POST" action="{{ url('/reservation') }}">
                        {{ csrf_field() }}

                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <p class="error-message normal-size">{{ $error }}</p>
                            @endforeach
                        @endif

                        <div class="form-group">
                            <label for="places">Réserver des places</label>
                            <input type="number" value="1" class="form-control" name="places" id="places"
                                   placeholder="Nombre de Places">
                        </div>
                        <input type="hidden" name="representationID" value="{{ $representation->id }}">

                        <button type="submit" class="btn btn-success">Réserver</button>
                    </form>
                @endif
            @else
                <p>Non Réservable</p>
            @endif



            @if (Auth::check() && Auth::user()->isAdmin())
                <a href="{{ url('/representation/' . $representation->id . '/edit') }}"
                   title="Edit Representation">
                    <button class="btn btn-primary btn-sm">
                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Éditer
                    </button>
                </a>

                <form method="POST" action="{{ url('representation' . '/' . $representation->id) }}"
                      accept-charset="UTF-8" style="display:inline">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm('Êtes vous sûr?')">
                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                        Supprimer
                    </button>
                </form>
                <br/>
                <br/>
            @endif


        </div>
    </div>
    </div>
@endsection
