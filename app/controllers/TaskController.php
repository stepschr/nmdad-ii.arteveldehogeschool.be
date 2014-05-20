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

class TaskController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
//        return Task::all();
		$users = Task::where('user_id', '=', Auth::user()->id)
            ->get()

        ;

        return $users;
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return Redirect::to('/#page-task-create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

        $task = new Task(Input::all());
        $task->user()->associate(Auth::user());
        $task->save();

        return Redirect::to('/#page-tasks');

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        return Task::find($id)
            ->load('user', 'pomodori', 'pomodori.labels')
        ;
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function edit($id)
    {

        $task = Task::findOrFail($id);
        return View::make('taskEdit', ['task' => $task, 'id' => $id]);

        //return Redirect::to('/#page-task-update', ['task' => $task, 'id' => $id]);
    }

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $rules = [
            'name'            => 'required',
            'due_at'         => 'required'
        ];

            $task = Task::find($id);
            $task->name = Input::get('name');
            $task->due_at = Input::get('due_at');
            $task->lists_id = Input::get('lists_id');
            $task->prioriteit = Input::get('prioriteit');

            $task->save();
            return Redirect::to('/#page-tasks');



	}

    public function finished($id)
    {
        $task = Task::find($id);
        $task->finished_at = New DateTime();
        $task->save();
        //return Redirect::to('index');
    }

    public function unfinished($id)
    {

        $task = Task::find($id);

        $task->finished_at = '0000-00-00 00:00:00';
        $task->save();
        //return Redirect::to('index');
    }

    public function getTasks(){
        $task = Task::orderBy('due_at', 'ASC')->where('user_id', '=', Auth::user()->id)->where('finished_at', '=', '0000-00-00 00:00:00')->get();

        return $task;
    }
    public function getAllTasks(){
        $task = Task::orderBy('due_at', 'ASC')->get();

        return $task;
    }

    public function getFinished(){
        $finished = Task::orderBy('due_at', 'ASC')->where('user_id', '=', Auth::user()->id)->where('finished_at', '!=', '0000-00-00 00:00:00')->get();
        return $finished;
    }
    /**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        return Task::destroy($id);
	}

}
