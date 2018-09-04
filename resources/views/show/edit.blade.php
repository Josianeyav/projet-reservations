@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Éditer le show {{ $show->title }}</div>
                    <div class="card-body">
                        <a href="{{ url('/shows') }}" title="Retour">
                            <button class="btn btn-info btn-sm">
                                <i class="fa fa-arrow-left" aria-hidden="true"></i>
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

                        <form method="POST" action="{{ url('/shows/' . $show->id) }}" accept-charset="UTF-8"
                              class="form-horizontal" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}

                            @include ('show.form', ['formMode' => 'edit'])

                        </form>

                        <hr>
                        <strong> Collaborations </strong>
                        <ul>
                            @foreach($show->collaborations()->get() as $collaboration)
                                <li>{{ title_case($collaboration->artisteType()->first()->info()) }}</li>
                            @endforeach
                        </ul>

                        <a href="{{ route('collaboration.editForShow', $show->id) }}" class="btn btn-success">Éditer collaborations</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
