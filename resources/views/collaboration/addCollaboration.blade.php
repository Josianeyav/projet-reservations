@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Ajouter une collaboration au show {{ $show->title }}</div>
                    <div class="card-body">
                        <a href="{{ url('/shows') }}" title="Retour">
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

                        <form method="POST" action="{{ route('collaboration.store') }}" accept-charset="UTF-8"
                              class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="types" class="control-label">{{ 'Type' }}</label>
                                <select class="form-control" id="type" name="artistTypeID">
                                    @foreach($artistTypes as $artistType)
e
                                        <option value="{{ $artistType->id }}">{{ $artistType->info() }}</option>
                                    @endforeach
                                </select>
                            </div>


                            <input type="hidden" name="showID" value="{{ $show->id }}">

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
