<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    <label for="places" class="control-label">{{ 'Title' }}</label>
    <input class="form-control" name="title" type="text" required  value="{{ $show->title or ''}}" >
    {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('slug') ? 'has-error' : ''}}">
    <label class="control-label">{{ 'Slug' }}</label>
    <input class="form-control" name="slug" type="text" required value="{{ $show->slug or ''}}" >
    {!! $errors->first('slug', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('price') ? 'has-error' : ''}}">
    <label class="control-label">{{ 'Prix' }}</label>
    <input class="form-control" name="price" type="number" step="0.01" min="0.01" required value="{{ $show->price or ''}}" >
    {!! $errors->first('price', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('poster') ? 'has-error' : ''}}">
    <label class="control-label">{{ 'Poster' }}</label>
    <input class="form-control" name="poster" type="file">
    {!! $errors->first('poster', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('bookable') ? 'has-error' : ''}}">
    <label for="places" class="control-label">{{ 'Réservable' }}</label>
    <select required class="form-control" name="bookable" >
        <option value="1"
                @if (isset($show) && $show->bookable)
                selected="selected"
                @endif
        >Réservable</option>
        <option value="0"
                @if (isset($show) && $show && $show->bookable == 0)
                selected="selected"
                @endif

        >Non Réservable</option>
    </select>
</div>
<div class="form-group">
    <label for="places" class="control-label">{{ 'Location' }}</label>
    <select required class="form-control" name="location_id" >
        @foreach($locations as $location)
            <option value="{{ $location->id }}"
                    @if (isset($showLocation) && $showLocation == $location->designation)
                    selected="selected"
                    @endif
            >{{ $location->designation }}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Mettre à jour' : 'Créér' }}">
</div>
