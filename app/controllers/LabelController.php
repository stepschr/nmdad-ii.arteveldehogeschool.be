<?php
/**
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *                                                                           *
 *                                                                           *
 *                                                                           *
 *                        aaaAAaaa            HHHHHH                         *
 *                     aaAAAAAAAAAAaa         HHHHHH                         *
 *                    aAAAAAAAAAAAAAAa        HHHHHH                         *
 *                   aAAAAAAAAAAAAAAAAa       HHHHHH                         *
 *                   aAAAAAa    aAAAAAA                                      *
 *                   AAAAAa      AAAAAA                                      *
 *                   AAAAAa      AAAAAA                                      *
 *                   aAAAAAa     AAAAAA                                      *
 *                    aAAAAAAaaaaAAAAAA       HHHHHH                         *
 *                     aAAAAAAAAAAAAAAA       HHHHHH                         *
 *                      aAAAAAAAAAAAAAA       HHHHHH                         *
 *                         aaAAAAAAAAAA       HHHHHH                         *
 *                                                                           *
 *                                                                           *
 *                                                                           *
 *      a r t e v e l d e  u n i v e r s i t y  c o l l e g e  g h e n t     *
 *                                                                           *
 *                                                                           *
 *                                MEMBER OF GHENT UNIVERSITY ASSOCIATION     *
 *                                                                           *
 *                                                                           *
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *
 * @author     Olivier Parent
 * @copyright  Copyright © 2014 Artevelde University College Ghent
 */

class LabelController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $labels = Label::where(function($query) {
            $query->whereNull('user_id')
                ->orWhere('user_id', Auth::user()->id)
            ;
        })
            ->orderBy('user_id', 'desc')
            ->orderBy('name')
            ->get()
        ;
//        Log::info(DB::getQueryLog());
        return $labels;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        // Do nothing.
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $label = new Label(Input::all());
        $label->user()->associate(Auth::user());
        $label->save();

        return $label;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return Label::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        // Do nothing.
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $label = Label::find($id);
        $label->name   = Input::get('name');
        $label->colour = Input::get('colour');
        $label->save();

        return $label;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        // Opgelet, controleer eerst of de gebruiker een bepaald label mag verwijderen!
        return Label::destroy($id);
    }

}
