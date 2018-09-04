@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Types de l'artiste {{ $artist->fullname() }}</div>
                    <div class="card-body">
                        <a href="{{ route('artistType.addArtistType', $artistID) }}" class="btn btn-success btn-sm"
                           title="Add New ArtistType">
                            <i class="fa fa-plus" aria-hidden="true"></i> Ajouter
                        </a>



                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Type</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($artisttypes->count() == 0)
                                    <tr>
                                    <td>Aucun type pour cet artiste</td>
                                    <td></td>
                                    <td></td>
                                    </tr>
                                @endif
                                @foreach($artisttypes as $item)
                                    <tr>
                                        <td>{{ $loop->iteration or $item->id }}</td>
                                        <td>{{ $item->type()->first()->type }}</td>
                                        <td>


                                            <form method="POST" action="{{ url('/artist-type' . '/' . $item->id) }}"
                                                  accept-charset="UTF-8" enctype="multipart/form-data"
                                                  style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Vous êtes sûr?')"><i
                                                            class="fa fa-trash-o" aria-hidden="true"></i> Supprimer
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
