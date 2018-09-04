@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Collaborations</div>
                    <div class="card-body">
                        <a href="{{ route('collaboration.addCollaboration', $showID) }}" class="btn btn-success btn-sm"
                           title="">
                            <i class="fa fa-plus" aria-hidden="true"></i> Ajouter une collaboration
                        </a>


                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Collaboration</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($collaborations->count() == 0)
                                    <td>Aucune collaboration pour ce spectacle</td>
                                    <td></td>
                                    <td></td>
                                @endif
                                @foreach($collaborations as $item)
                                    <tr>
                                        <td>{{ $loop->iteration or $item->id }}</td>
                                        <td>{{ $item->artisteType()->firstOrFail()->info() }}</td>
                                        <td>


                                            <form method="POST" action="{{ url('collaboration' . '/' . $item->id) }}"
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
