<div class="form-group {{ $errors->has('login') ? 'has-error' : ''}}">
    <label for="login" class="control-label">{{ 'Login' }}</label>
    <input class="form-control" name="login" type="text" id="login"
           value="{{ $user->login or ''}}">
    {!! $errors->first('login', '<p class="error-message">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('firstname') ? 'has-error' : ''}}">
    <label for="firstname" class="control-label">{{ 'Prénom' }}</label>
    <input class="form-control" name="firstname" type="text" id="firstname"
           value="{{ $user->firstname or ''}}">
    {!! $errors->first('firstname', '<p class="error-message">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('lastname') ? 'has-error' : ''}}">
    <label for="lastname" class="control-label">{{ 'Nom' }}</label>
    <input class="form-control" name="lastname" type="text" id="lastname"
           value="{{ $user->lastname or ''}}">
    {!! $errors->first('lastname', '<p class="error-message">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
    <label for="email" class="control-label">{{ 'Email' }}</label>
    <input class="form-control" name="email" type="text" id="email"
           value="{{ $user->email or ''}}">
    {!! $errors->first('email', '<p class="error-message">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
    <label for="password" class="control-label">{{ 'Mot de passe' }}</label>
    <input class="form-control" name="password" type="password" id="password"
           value="">
    {!! $errors->first('password', '<p class="error-message">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('confirmPassword') ? 'has-error' : ''}}">
    <label for="confirmPassword" class="control-label">{{ 'Confirmer le mot de passe' }}</label>
    <input class="form-control" name="confirmPassword" type="password" id="confirmPassword"
           value="">
    {!! $errors->first('confirmPassword', '<p class="error-message">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="Mettre à jour">
</div>
