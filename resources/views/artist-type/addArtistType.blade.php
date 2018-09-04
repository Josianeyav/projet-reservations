@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Ajouter un type à l'artiste {{ $artist->fullname() }}</div>
                    <div class="card-body">
                        <a href="{{ url('/artist-type') }}" title="Retour">
                            <button class="btn btn-info btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i>
                                Retour
                            </button>
                        </a>
                        <br/>
                        <br/>

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ route('artist-type.store') }}" accept-charset="UTF-8"
                              class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="form-group {{ $errors->has('bidon') ? 'has-error' : ''}}">
                                <label for="types" class="control-label">{{ 'Type' }}</label>
                                <select class="form-control" id="type" name="typeID">
                                    @foreach($types as $type)

                                        <option value="{{ $type->id }}">{{ $type->type }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <input type="hidden" name="artistID" value="{{ $artist->id }}">

                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" value="Ajouter">
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
