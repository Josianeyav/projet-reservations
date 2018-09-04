<?php

namespace App\Http\Controllers;

use App\Http\Requests;

use App\Artist;
use Illuminate\Http\Request;

class ArtistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $artist = Artist::all();
        if ($this->wantsJson($request)) {
            return response()->json($artist);
        } else {
            return view('artist.index', compact('artist'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $this->checkIsAdmin();

        return view('artist.create');
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
        $this->checkIsAdmin();

        $requestData = $request->all();
        Artist::create($requestData);
        if ($this->wantsJson($request)) {
            return $this->jsonSuccess();
        } else {
            return redirect('artist')->with('status', 'Artiste ajouté!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id, Request $request)
    {
        $artist = Artist::findOrFail($id);
        if ($this->wantsJson($request)) {
            return response()->json($artist);
        } else {
            return view('artist.show', compact('artist'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $artist = Artist::findOrFail($id);
        return view('artist.edit', compact('artist'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $this->checkIsAdmin();

        $requestData = $request->all();

        $artist = Artist::findOrFail($id);
        $artist->update($requestData);

        if ($this->wantsJson($request)) {
            return $this->jsonSuccess();
        } else {
            return redirect('artist')->with('status', 'Artiste mis à jour!');
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
        $this->checkIsAdmin();
        Artist::destroy($id);

        if ($this->wantsJson($request)) {
            return $this->jsonSuccess();
        } else {
            return redirect('artist')->with('status', 'Artiste supprimé!');
        }
    }
}
