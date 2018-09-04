<div class="form-group {{ $errors->has('schedule') ? 'has-error' : ''}}">
    <label for="schedule" class="control-label">{{ 'Date' }}</label>
    <input class="form-control" name="schedule" type="datetime-local" id="schedule" required value="{{ $schedule or ''}}" >
    {!! $errors->first('schedule', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('ref') ? 'has-error' : ''}}">
    <label for="ref" class="control-label">{{ 'Réference' }}</label>
    <input class="form-control" name="ref" type="text" id="ref" required value="{{ $representation->ref or ''}}" >
    {!! $errors->first('ref', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group">
    <label for="places" class="control-label">{{ 'Spectacle' }}</label>
    <select class="form-control" name="show_id" >
        @foreach($shows as $currentShow)
            <option value="{{ $currentShow->id }}"
                    @if (isset($show) && $currentShow->id == $show->id)
                    selected="selected"
                    @endif
            >{{ $currentShow->title }}</option>
        @endforeach
    </select>
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Mettre à jour' : 'Créér' }}">
</div>
