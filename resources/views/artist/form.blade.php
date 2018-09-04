<div class="form-group {{ $errors->has('firstname') ? 'has-error' : ''}}">
    <label for="firstname" class="control-label">{{ 'Prénom' }}</label>
    <input class="form-control" name="firstname" type="text" id="firstname" required value="{{ $artist->firstname or ''}}" >
    {!! $errors->first('firstname', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('lastname') ? 'has-error' : ''}}">
    <label for="lastname" class="control-label">{{ 'Nom' }}</label>
    <input class="form-control" name="lastname" type="text" id="lastname" required value="{{ $artist->lastname or ''}}" >
    {!! $errors->first('lastname', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Mettre à jour' : 'Créér' }}">
</div>
