@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Créér une nouvelle représentation</div>
                    <div class="card-body">
                        <a href="{{ url('/representation') }}" title="Retour">
                            <button class="btn btn-info btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i>
                                Retour
                            </button>
                        </a>
                        <br/>
                        <br/>

                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <p class="error-message">{{ $error }}</p>
                            @endforeach
                        @endif

                        <form method="POST" action="{{ url('/representation') }}" accept-charset="UTF-8"
                              class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            @include ('representation.form', ['formMode' => 'create'])

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
