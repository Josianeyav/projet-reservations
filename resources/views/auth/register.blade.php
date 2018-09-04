@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3 col-sm-8 offset-sm-2">
                <div class="card card-info">
                    <div class="card-header bg-info text-white">
                        <div class="card-title">
                            <h4>Inscription</h4>
                        </div>
                        <div style="float:right; font-size: 85%; position: relative; top:-10px">
                            <a id="signinlink" style="color: white" href="{{ route('login') }}">
                                Se connecter
                            </a>
                        </div>
                    </div>

                    <div class="card-body">
                        <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="control-label">Email</label>

                                <div >
                                    <input type="email" class="form-control" name="email"
                                           value="{{ old('email') }}" required autofocus
                                           placeholder="Email">

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
</>

                            <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
                                <label for="firstname" class="control-label">Prénom</label>

                                <div>
                                    <input type="text" class="form-control" name="firstname"
                                           value="{{ old('firstname') }}" required
                                           placeholder="Prénom">

                                    @if ($errors->has('firstname'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('firstname') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
                                <label for="lastname" class="control-label">Nom</label>

                                <div >
                                    <input type="text" class="form-control" name="lastname"
                                           value="{{ old('lastname') }}" required
                                           placeholder="Nom">

                                    @if ($errors->has('lastname'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('lastname') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('login') ? ' has-error' : '' }}">
                                <label for="login" class="control-label">Login</label>

                                <div>
                                    <input type="text" class="form-control" name="login"
                                           value="{{ old('login') }}" required
                                           placeholder="Login">

                                    @if ($errors->has('login'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('login') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="control-label">Mot de passe</label>

                                <div>
                                    <input type="password" class="form-control" name="password"
                                           required
                                           placeholder="Mot de passe">

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('passwordConfirm') ? ' has-error' : '' }}">
                                <label for="passwordConfirm" class="control-label">Confirmer</label>

                                <div>
                                    <input type="password" class="form-control" name="passwordConfirm"
                                           required
                                           placeholder="Confirmer le mot de passe">

                                    @if ($errors->has('passwordConfirm'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('passwordConfirm') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="icode" class="control-label">Langue</label>
                                <div>
                                    <select class="form-control" name="langue">
                                        <option value="fr">Français</option>
                                        <option value="nl">Néerlandais</option>
                                        <option value="en">Anglais</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <!-- Button -->
                                <div>
                                    <button id="btn-signup" type="submit" class="btn btn-info">
                                        <i class="icon-hand-right"></i>S'inscrire
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
