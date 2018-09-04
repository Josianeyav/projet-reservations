<?php

namespace App\Http\Controllers;

use App\Location;
use App\Show;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Rap2hpoutre\FastExcel\FastExcel;

class ShowController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $shows = Show::all();

        if ($this->wantsJson($request)) {
            return response()->json($shows);
        } else {
            return view('show.index', [
                'shows' => $shows,
                'search' => $request->query('search'),
                'titre' => 'Liste des spectacles',
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->checkIsAdmin();

        $locations = Location::all();
        return view('show.create', [
            'locations' => $locations
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->checkIsAdmin();



        $show = new Show;
        if ($show->poster_url) {
            $path = $request->poster->store('public/images');
            $show->poster_url = str_replace("public/", "", $path);
        }
        $show->title = $request->input('title');
        $show->slug = str_slug($request->input('slug'));
        $show->price = $request->input('price');
        $show->bookable = $request->input('bookable') == 1;
        $show->location()->associate(Location::find($request->input('location_id')));
        $show->save();

        if ($this->wantsJson($request)) {
            return $this->jsonSuccess();
        } else {
            return redirect()->route('shows.index')->with('status', 'Spectacle créé!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Show $show
     * @return \Illuminate\Http\Response
     */
    public function show(Show $show, Request $request)
    {
        if ($this->wantsJson($request)) {
            return response()->json($show);
        } else {
            return view('show.show', [
                'show' => $show
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Show $show
     * @return \Illuminate\Http\Response
     */
    public function edit(Show $show)
    {
        $this->checkIsAdmin();

        $locations = Location::all();
        $showLocation = $show->location()->first()->designation;
        return view('show.edit', [
            'show' => $show,
            'locations' => $locations,
            'showLocation' => $showLocation
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Show $show
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Show $show)
    {
        $this->checkIsAdmin();

        if ($request->hasFile('poster')) {
            $path = $request->poster->store('public/images');

            // Effacer ancienne image si elle existe
            if ($show->poster_url) {
                Storage::delete($this->toImagePath($show->poster_url));
            }

            $show->poster_url = $this->toImageUrl($path);
        }

        $requestData = $request->except(['poster', 'location_id']);
        $requestData["slug"] = str_slug($requestData["slug"]);
        $show->update($requestData);

        $location = Location::find($request->input('location_id'));
        $show->location()->associate($location);
        $show->save();



        if ($this->wantsJson($request)) {
            return $this->jsonSuccess();
        } else {
            return redirect()->route('shows.index')->with('status', 'Spectacle mis à jour!');
        }
    }

    private function toImageUrl($imagePath) {
        $count = 1;
        return str_replace("public/", "", $imagePath, $count);
    }

    private function toImagePath($imageUrl) {
        $count = 1;
        return str_replace("images/", "public/images/", $imageUrl, $count);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Show $show
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Show $show, Request $request)
    {
        $this->checkIsAdmin();
        Storage::delete($this->toImagePath($show->poster_url));
        $show->delete();


        if ($this->wantsJson($request)) {
            return $this->jsonSuccess();
        } else {
            return redirect()->route('shows.index');
        }
    }

    public function exportCSV(Request $request)
    {
        $this->checkIsAdmin();
        $shows = Show::all();
        return (new FastExcel($shows))->download('shows.csv');
    }

    public function importCSV(Request $request)
    {
        $this->checkIsAdmin();

        if ($request->hasFile('dataFile')) {
            $path = $request->dataFile->storeAs('CSVs', 'dataFile.csv');
            $users = (new FastExcel)->import(storage_path('app/' . $path), function ($line) {
                $show = new Show;
                $show->slug = $line["slug"];
                $show->title = $line["title"];
                $show->poster_url = $line["poster_url"];
                $show->bookable = $line["bookable"] == 1;
                $show->price = doubleval($line["price"]);
                $show->location()->associate(Location::find($line["location_id"]));
                $show->save();
            });

            return redirect()->route('shows.index')->with('status', 'Spectaces ajoutés!');
        } else {
            return redirect()->route('shows.index')->with('status', 'Veuillez ajouter un fichier!');
        }
    }
}
