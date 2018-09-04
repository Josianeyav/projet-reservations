<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Representation;
use App\Show;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class RepresentationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $representation = Representation::all();
        if ($this->wantsJson($request)) {
            return response()->json($representation);
        } else {
            return view('representation.index', compact('representation'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            abort(403);
        }

        $shows = Show::all();
        return view('representation.create', [
            'shows' => $shows
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

        $representation = new Representation;
        $representation->schedule = $request->input('schedule');
        $representation->ref = $request->input('ref');
        $representation->show()->associate(Show::find($request->input('show_id')));
        $representation->save();
        if ($this->wantsJson($request)) {
            return $this->jsonSuccess();
        } else {
            return redirect('representation')->with('status', 'Representation créée!');
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

        $representation = Representation::findOrFail($id);
        if ($this->wantsJson($request)) {
            return response()->json($representation);
        } else {
            return view('representation.show', [
                'representation' => $representation,
                'show' => $representation->show()->firstOrFail(),
            ]);
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
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            abort(403);
        }

        $representation = Representation::findOrFail($id);
        $schedule = Carbon::parse($representation->schedule)->format('Y-m-d\TH:i');
        $show = $representation->show()->firstOrFail();
        $shows = Show::all();
        return view('representation.edit', [
            'representation' => $representation,
            'shows' => $shows,
            'show' => $show,
            'schedule' => $schedule
        ]);
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
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            abort(403);
        }


        $requestData = $request->all();

        $representation = Representation::findOrFail($id);
        $representation->update($requestData);

        if ($this->wantsJson($request)) {
            return $this->jsonSuccess();
        } else {
            return redirect('representation')->with('status', 'Representation updated!');
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

        Representation::destroy($id);

        if ($this->wantsJson($request)) {
            return $this->jsonSuccess();
        } else {
            return redirect('representation')->with('status', 'Representation deleted!');
        }
    }
}
