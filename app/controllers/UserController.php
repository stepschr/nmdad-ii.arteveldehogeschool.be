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

class UserController extends \BaseController {

    protected $layout = 'layouts.master';

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
     *
     *
	 */

    //Admin
    public function admin(){
        if(Auth::user()->is_admin == 1){
            return Redirect::route('user.index');
        }
        else{

            $this->layout->content = View::make('admin');
        }
    }

    public function index()
    {
        $this->layout->content = View::make('user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $this->layout->content = View::make('user.create');
    }

    public function postProfile()
    {
        if(Auth::check()) {
            $rules = [
                'password'        => 'sometimes|min:8',
                'password_repeat' => 'same:password',
                'username'        => 'required|min:2|max:40',
                'profile_picture' => 'sometimes|image|max:2000' // ongeveer 2MB
            ];

            $validator = Validator::make(Input::all(), $rules);

            // Alleen wachtwoord herhalen als er een wachtwoord ingevuld is
            $validator->sometimes('password_repeat', 'required|same:password', function($input)
            {
                return $input->password !== '';

            });

            if ($validator->passes()) {
                $user = Auth::user();
                if (Input::get('password') != null) {
                    $user->password = Input::get('password'); // Hash wordt in het model geregeld via het 'creating' event!
                }
                $neededInput = Input::except(array('email', 'profile_picture')); // Vermijden dat email toch geset wordt

                if (Input::hasFile('profile_picture'))
                {
                    $name = Input::file('profile_picture')->getClientOriginalName();
                    $name = strlen($name) > 200 ? substr($name, 0, 200) : $name;
                    $name = time() . '-' . $name;

                    Input::file('profile_picture')->move(public_path().'publicimages/profile_pictures', $name);

                    $user->profile_picture = $name;
                }

                $user->update($neededInput);
                $user->save();

                return Redirect::to('/#page-instellingen'); // Redirect to correct JQuery mobile page
                //
            } else {

                return Redirect::to('/#page-instellingen') // Zie: $ php artisan routes
                    ->withInput(Input::except(array('password','password_repeat')))             // Vul het formulier opnieuw in met de Input.
                    ->withErrors($validator); // Maakt $errors in View.
            }
        }
        else {
            return Redirect::route('home');
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $rules = [
            'email'           => 'required|email|max:255',
            'password'        => 'required|min:8',
            'password_repeat' => 'required|same:password',
            'username'        => 'required|min:2|max:40',
        ];

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->passes()) {
            $user = new User(Input::all());
            $user->password = Input::get('password'); // Hash wordt in het model geregeld via het 'creating' event!
            $user->save();

            return Redirect::route('user.login'); // Zie: $ php artisan routes
            //
        } else {

            return Redirect::route('user.create') // Zie: $ php artisan routes
                ->withInput()             // Vul het formulier opnieuw in met de Input.
                ->withErrors($validator); // Maakt $errors in View.
        }
    }

    /**
     *
     */
    public function login()
    {
        $this->layout->content = View::make('user.login');
    }

    /**
     *
     */
    public function auth()
    {
        $rules = [
            'email'    => 'required|email',
            'password' => 'required',
        ];

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->passes()) {
            $credentials = [
                'email'      => Input::get('email'),
                'password'   => Input::get('password'),
                'deleted_at' => null, // Extra voorwaarde.
            ];
            $remember = Input::get('switch-auth') == 'remember'; // Onthoud authenticatie.

            if (Auth::attempt($credentials, $remember)) {


                     return Redirect::route('user.index');


            } else {

                return Redirect::route('user.index')
                    ->withInput()             // Vul het formulier opnieuw in met de Input.
                    ->with('auth-error-message') //'U heeft een onjuiste gebruikersnaam of een onjuist wachtwoord ingevoerd.')
                    ;
            }
        } else {

            return Redirect::route('user.index') // Zie: $ php artisan routes
                ->withInput()             // Vul het formulier opnieuw in met de Input.
                ->withErrors($validator); // Maakt $errors in View.
        }
    }

    public function getUsers(){
        $user = User::where('id', '!=', Auth::user()->id)->get();



        return $user;
    }


    public  function getDeletedUserList(){
        $userDeletedlist = User::onlyTrashed()->get();

        return $userDeletedlist;

    }

    public function destroy($id)
    {
        return User::destroy($id);
    }

    public function restore($id)
    {
        $user = User::withTrashed()->find($id);

        $user->restore();
    }


}