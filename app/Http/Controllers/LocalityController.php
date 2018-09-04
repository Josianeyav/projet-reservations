<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Locality;
use Illuminate\Http\Request;

class LocalityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {

        $localities = Locality::all();
        if ($this->wantsJson($request)) {
            return response()->json($localities);
        } else {
            return view('localities.index', compact('localities'));
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
        return view('localities.create');
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
        
        Locality::create($requestData);


        if ($this->wantsJson($request)) {
            return $this->jsonSuccess();
        } else {
            return redirect('localities')->with('status', 'Localité ajoutée!');
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
        $locality = Locality::findOrFail($id);

        if ($this->wantsJson($request)) {
            return response()->json($locality);
        } else {
            return view('localities.show', compact('locality'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id, Request $request)
    {
        $this->checkIsAdmin();
        $locality = Locality::findOrFail($id);

        if ($this->wantsJson($request)) {
            return response()->json($locality);
        } else {
            return view('localities.edit', compact('locality'));
        }
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
        
        $locality = Locality::findOrFail($id);
        $locality->update($requestData);


        if ($this->wantsJson($request)) {
            return $this->jsonSuccess();
        } else {
            return redirect('localities')->with('status', 'Localité mise à jour!');
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
        Locality::destroy($id);


        if ($this->wantsJson($request)) {
            return $this->jsonSuccess();
        } else {
            return redirect('localities')->with('status', 'Localité supprimée!');
        }
    }
}
