@extends('layouts.app')

@section('content')

    <style>
        form.form-horizontal .form-group.mon-input {
            margin-left: 0px;
            margin-right: 0px
        }
    </style>

    <div class="container">


        <div class="row">
            <div style="margin-top:50px;" class="col-md-6 offset-md-3 col-sm-8 offset-sm-2">
                <div class="card card-default">
                    <div class="card-header bg-info text-white">
                        <div class="card-title">
                            <h4>Connexion</h4>
                        </div>
                        <div style="float:right; font-size: 80%; position: relative; top:-10px">
                            <a style="color: white; " href="{{ route('password.request') }}">
                                Récupérer votre mot de passe?
                            </a>
                        </div>
                    </div>


                    <div class="card-body" style="padding-top:30px">
                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                            {{ csrf_field() }}


                            <div class=" form-group{{ $errors->has('username') ? ' has-error' : '' }} mon-input">
                                <div style="margin-bottom: 25px" class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input id="login-username" type="text" class="form-control"
                                           name="username" value="{{ old('username') }}" placeholder="login ou email">
                                </div>

                                @if ($errors->has('login'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>


                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} mon-input ">
                                <div style="margin-bottom: 25px" class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                    <input id="login-password" type="password" class="form-control"
                                           name="password" placeholder="mot de passe">
                                </div>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="input-group">
                                <div class="checkbox">
                                    <label>
                                        <input id="login-remember" type="checkbox" name="remember" value="1">
                                        Retenir mon login
                                    </label>
                                </div>
                            </div>


                            <div style="margin-top:10px" class="form-group">
                                <!-- Button -->

                                <div class="col-sm-12 controls">
                                    <button href="{{ route('login') }}" type="submit" class="btn btn-success">
                                        Se connecter
                                    </button>

                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-12 control">
                                    <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%">
                                        Vous n'avez pas de compte?
                                        <a href="{{ route('register') }}">
                                            Inscrivez-vous ici
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
