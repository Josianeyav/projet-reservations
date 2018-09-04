<?php

namespace App\Http\Controllers;

use App\Artist;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ArtisteType;
use App\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArtisteTypeController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function editForArtist($id)
    {
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            abort(403);
        }

        $artisttypes = Artist::find($id)->artisteTypes()->get();
        $artist = Artist::find($id);
        return view('artist-type.editForArtist', [
            'artisttypes' => $artisttypes,
            'artistID' => $id,
            'artist' => $artist
        ]);
    }

    /**
     * @return \Illuminate\View\View
     */
    public function addArtistType($id)
    {
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            abort(403);
        }
        $types = Type::all();
        return view('artist-type.addArtistType', [
            'types' => $types,
            'artist' => Artist::find($id)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            abort(403);
        }

        $artistID = $request->input('artistID');
        $typeID = $request->input('typeID');

        $artist = Artist::find($artistID);
        if (ArtisteType::where('artist_id', $artistID)->where('type_id', $typeID)->count() == 0) {
            $artistType = new ArtisteType;
            $artistType->artist()->associate($artist);
            $artistType->type()->associate(Type::find($typeID));
            $artistType->save();

            if ($this->wantsJson($request)) {
                return $this->jsonSuccess();
            } else {
                return redirect()->route('artistType.editForArtist', $artistID)
                    ->with('status', "Type ajouté à l'ariste");
            }
        } else {
            if ($this->wantsJson($request)) {
                return $this->jsonProblem("L'artiste a déjà ce type");
            } else {
                return redirect()->route('artistType.editForArtist', $artistID)
                    ->with('status', "L'artiste a déjà ce type");
            }
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id, Request $request)
    {
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            abort(403);
        }

        $artistType = ArtisteType::find($id);
        $artistID = $artistType->artist()->firstOrFail()->id;

        ArtisteType::destroy($id);
        if ($this->wantsJson($request)) {
            return $this->jsonSuccess();
        } else {
            return redirect()->route('artistType.editForArtist', $artistID)->with('status', "Type supprimé à l'artiste");
        }
    }
}
