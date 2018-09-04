<div class="form-group {{ $errors->has('places') ? 'has-error' : ''}}">
    <label for="places" class="control-label">{{ 'Places' }}</label>
    <input class="form-control" name="places" type="number" id="places" value="{{ $reservation->places or ''}}" >
    {!! $errors->first('places', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
