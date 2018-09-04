

<div class="form-group {{ $errors->has('designation') ? 'has-error' : ''}}">
    <label for="designation" class="control-label">{{ 'Désignation' }}</label>
    <input class="form-control" name="designation" type="text" required id="designation" value="{{ $location->designation or ''}}" >
    {!! $errors->first('designation', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('address') ? 'has-error' : ''}}">
    <label for="address" class="control-label">{{ 'Adresse' }}</label>
    <input class="form-control" name="address" type="text" id="address" value="{{ $location->address or ''}}" >
    {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('website') ? 'has-error' : ''}}">
    <label for="website" class="control-label">{{ 'Website' }}</label>
    <input class="form-control" name="website" type="text" id="website" value="{{ $location->website or ''}}" >
    {!! $errors->first('website', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('phone') ? 'has-error' : ''}}">
    <label for="phone" class="control-label">{{ 'Tel.' }}</label>
    <input class="form-control" name="phone" type="text" id="phone" value="{{ $location->phone or ''}}" >
    {!! $errors->first('phone', '<p class="help-block">:message</p>') !!}
</div>

@if ($formMode === 'edit')
<div class="form-group {{ $errors->has('slug') ? 'has-error' : ''}}">
    <label for="slug" class="control-label">{{ 'Slug' }}</label>
    <input class="form-control" name="slug" type="text" id="slug" value="{{ $location->slug or ''}}" >
    {!! $errors->first('slug', '<p class="help-block">:message</p>') !!}
</div>
@endif

<div class="form-group">
    <label for="places" class="control-label">{{ 'Localisation' }}</label>
    <select required class="form-control" name="locality_id" >
        @foreach($localities as $locality)
            <option value="{{ $locality->id }}"
                    @if (isset($localityID) && ($locality->id == $localityID))
                    selected="selected"
                    @endif
            >{{ $locality->locality }}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Mettre à jour' : 'Créér' }}">
</div>
