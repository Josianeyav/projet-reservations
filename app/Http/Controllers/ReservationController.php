<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Reservation;
use App\Show;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {

        if (!Auth::check()) {
            abort(403);
        }
        $user = Auth::user();
        if ($user->isAdmin()) {
            $reservations = Reservation::all();
        } else {
            $reservations = $user->reservations()->with('representation')->get();
        }

        if ($this->wantsJson($request)) {
            return response()->json($reservations);
        } else {
            return view('reservation.index', [
                'reservations' => $reservations
            ]);
        }
    }

    private function checkPermissions($id) {
        if (!Auth::check() ) {
            abort(403);
        }

        $reservation = Reservation::findOrFail($id);

        $isReservationOwner = Auth::user()->id != $reservation->user()->firstOrFail()->id;
        if (!$isReservationOwner && !Auth::user()->isAdmin()) {
            abort(403);
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

        return view('reservation.create');
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
        if (!Auth::check()) {
            abort(403);
        }


        Validator::make($request->all(),
            [
                'places' => 'required|integer|min:1',
            ],
            [
                'places.min' => 'Vous devez réserver au moins une place!',
            ]
        )->validate();

        $representationID = $request->input('representationID');

        $reservation = new Reservation;
        $reservation->places = $request->input('places');
        $reservation->user()->associate(Auth::user());
        $reservation->representation()->associate($representationID);
        $reservation->save();


        if ($this->wantsJson($request)) {
            return $this->jsonSuccess();
        } else {
            return redirect('reservation')->with('status', 'Reservation créée!');
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
        $this->checkPermissions($id);
        $reservation = Reservation::findOrFail($id);
        if ($this->wantsJson($request)) {
            return response()->json($reservation);
        } else {
            return view('reservation.show', compact('reservation'));
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
        $this->checkPermissions($id);
        $reservation = Reservation::findOrFail($id);

        return view('reservation.edit', compact('reservation'));
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
        $this->checkPermissions($id);
        $reservation = Reservation::findOrFail($id);

        $requestData = $request->all();
        $reservation->update($requestData);


        if ($this->wantsJson($request)) {
            return $this->jsonSuccess();
        } else {
            return redirect('reservation')->with('status', 'Réservation mise à jour!');
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
        $this->checkPermissions($id);
        Reservation::destroy($id);

        if ($this->wantsJson($request)) {
            return $this->jsonSuccess();
        } else {
            return redirect('reservation')->with('status', 'Réservation effacée!');
        }
    }
}
