<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Locality;
use App\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $locations = Location::all();
        if ($this->wantsJson($request)) {
            return response()->json($locations);
        } else {
            return view('locations.index', compact('locations'));
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
        $localities = Locality::all();
        return view('locations.create', compact('localities'));
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

        $location = new Location;
        $location->designation = $request->input('designation');
        $location->website = $request->input('website');
        $location->phone = $request->input('phone');
        $location->address = $request->input('address');
        $location->slug = str_slug($request->input('designation'));
        $location->locality()->associate(Locality::findOrFail($request->input('locality_id')));
        $location->save();

        if ($this->wantsJson($request)) {
            return $this->jsonSuccess();
        } else {
            return redirect('locations')->with('status', 'Localisation ajoutée!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id, Request $request)
    {

        $location = Location::findOrFail($id);

        if ($this->wantsJson($request)) {
            return response()->json($location);
        } else {
            return view('locations.show', compact('location'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $this->checkIsAdmin();
        $location = Location::findOrFail($id);
        $localities = Locality::all();
        $localityID = $location->locality()->firstOrFail()->id;

        return view('locations.edit', [
            'location' => $location,
            'localities' => $localities,
            'localityID' => $localityID
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $this->checkIsAdmin();
        $requestData = $request->all();


        $location = Location::findOrFail($id);
        $location->update($requestData);

        $location->locality()->associate(Locality::findOrFail($request->input('locality_id')));
        $location->save();

        if ($this->wantsJson($request)) {
            return $this->jsonSuccess();
        } else {
            return redirect('locations')->with('status', 'Localisation mise à jour!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id, Request $request)
    {
        $this->checkIsAdmin();
        Location::destroy($id);

        if ($this->wantsJson($request)) {
            return $this->jsonSuccess();
        } else {
            return redirect('locations')->with('status', 'Localisation supprimée!');
        }
    }
}
