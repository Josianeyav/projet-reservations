@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Mon profil</div>
                    <div class="card-body">
                        {{--@if ($errors->any())--}}
                            {{--<ul class="alert alert-danger">--}}
                                {{--@foreach ($errors->all() as $error)--}}
                                    {{--<li>{{ $error }}</li>--}}
                                {{--@endforeach--}}
                            {{--</ul>--}}
                        {{--@endif--}}

                        <form method="POST" action="{{ route('user.update', $user) }}"
                              class="form-horizontal">
                            {{ csrf_field() }}

                            @include ('user.form')
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
