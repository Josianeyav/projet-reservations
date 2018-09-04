<div class="form-group {{ $errors->has('postal_code') ? 'has-error' : ''}}">
    <label for="postal_code" class="control-label">{{ 'Code Postal' }}</label>
    <input class="form-control" required name="postal_code" type="text" id="postal_code" value="{{ $locality->postal_code or ''}}" >
    {!! $errors->first('postal_code', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('locality') ? 'has-error' : ''}}">
    <label for="locality" class="control-label">{{ 'Localité' }}</label>
    <input class="form-control" required name="locality" type="text" id="locality" value="{{ $locality->locality or ''}}" >
    {!! $errors->first('locality', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Mettre à jour' : 'Créer' }}">
</div>
