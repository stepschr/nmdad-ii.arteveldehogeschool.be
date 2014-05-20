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

class ListsController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
          //return Lists::all();
        //$users = Lists::where('user_id', '=', Auth::user()->id)
          //  ->get()
            //->load('pomodori', 'pomodori.labels')
       // ;

        //return $users;
        $lists = Lists::where(function($query) {
            $query->whereNull('user_id')
                ->orWhere('user_id', Auth::user()->id)
            ;
        })
            ->orderBy('user_id', 'desc')
            ->orderBy('name')
            ->get()
        ;
//        Log::info(DB::getQueryLog());
        return $lists;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        /**
         * In POSTMAN
         * POST naar http://nmdad-ii.arteveldehogeschoool.be/api/task
         * met als header Content-Type: application/json
         */
        $lists = new Lists(Input::all());
        $lists->user()->associate(Auth::user());
        $lists->save();

        return Redirect::to('/#page-lists');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {

        $lists = Lists::findOrFail($id);
        return View::make('listEdit', ['list' => $lists, 'id' => $id]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {


            $lists = Lists::find($id);
            $lists->name = Input::get('name');
            $lists->save();
            return Redirect::to('/#page-lists');

    }

    public function getLijst(){

        $lists = Lists::where('user_id', '=', Auth::user()->id)->get();

        $lists->load('Tasks');
       // die("die");
        $tasks = Task::where('lists_id', '=', Lists::where('user_id', '=', Auth::user()->id)->pluck('id'))->get();
        return $lists;
        //return $tasks;
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        return Lists::destroy($id);
    }

}
