<?php

namespace App\Http\Controllers;

use App\ArtisteType;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Collaboration;
use App\Show;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CollaborationController extends Controller
{
    public function editForShow($id) {

        $this->checkIsAdmin();


        $show = Show::find($id);
        $collaborations = $show->collaborations()->get();
        return view('collaboration.editForShow', [
            'collaborations' => $collaborations,
            'showID' => $id
        ]);
    }

    public function addCollaboration($id)
    {
        $this->checkIsAdmin();

        $artistTypes = ArtisteType::all();
        return view('collaboration.addCollaboration', [
            'artistTypes' => $artistTypes,
            'show' => Show::find($id)
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
        $this->checkIsAdmin();


        $showID = $request->input('showID');
        $artistTypeID = $request->input('artistTypeID');

        if (Collaboration::where('show_id', $showID)->where('artiste_type_id', $artistTypeID)->count() == 0) {
            $collaboration = new Collaboration;
            $collaboration->artisteType()->associate(ArtisteType::findOrFail($artistTypeID));
            $collaboration->show()->associate(Show::findOrFail($showID));
            $collaboration->save();
            return redirect()->route('collaboration.editForShow', $showID)
                ->with('status', "Collaboration ajoutée au show");
        } else {
            return redirect()->route('collaboration.editForShow', $showID)
                ->with('status', "Le spectacle a déjà cette collaboration");
        }
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

        $artisttypeshow = Collaboration::findOrFail($id);
        $artisttypeshow->update($requestData);

        return redirect('collaboration')->with('status', 'Collaboration mise à jour!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $this->checkIsAdmin();

        $showID = Collaboration::find($id)->show->firstOrFail()->id;
        Collaboration::destroy($id);

        return redirect()->route('collaboration.editForShow', $showID)->with('status', 'Collaboration supprimée!');
    }


}
