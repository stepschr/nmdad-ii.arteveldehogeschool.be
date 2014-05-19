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

        return Redirect::to('/#page-task');

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
        var_dump("hey");exit;
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

        $validator = Validator::make(Input::all(), $rules);
        if ($validator->passes()) {
            $task = Task::find($id);
            var_dump($id);exit;
            $task->name = Input::get('name');
            $task->due_at = Input::get('deadline');
            $task->lists_id = Input::get('lijst_id');
            //$task->prioriteit = Input::get('prioriteit');

            $task->save();
            return Redirect::to('home');

            return Redirect::route('home'); // Zie: $ php artisan routes
            //
        } else {

            return Redirect::route('task.create') // Zie: $ php artisan routes
                ->withInput()             // Vul het formulier opnieuw in met de Input.
                ->withErrors($validator); // Maakt $errors in View.
        }
	}

    public function getTasks(){
        $tasks = Task::orderBy('due_at', 'ASC')->where('user_id', '=', Auth::user()->id)->where('finished_at', '=', null)->get();

        return $tasks;
    }
    public function getAllTasks(){
        $tasks = Task::orderBy('due_at', 'ASC')->get();

        return $tasks;
    }

    public function getFinished(){
        $finished = Task::orderBy('due_at', 'ASC')->where('user_id', '=', Auth::user()->id)->whereNotNull('finished_at')->get();

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