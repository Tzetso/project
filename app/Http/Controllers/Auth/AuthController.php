<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|max:255|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        	'currency' => 1000
        ]);
    }
    
    public function register(Request $request)
    {
    	$validator = $this->validator($request->all());
    
    	if ($validator->fails()) {
    		$this->throwValidationException(
    				$request, $validator
    				);
    	}
    
    	Auth::guard($this->getGuard())->login($this->create($request->all()));

    	//Connect the new user to all the consumables
    	$items = Item::where('cosmetic' ,'=' , '0')->get();
    	$user = Auth::user();
    	var_dump($user);
    
    	foreach($items as $item){
    		$user->items()->attach($item->id);
    	}
    	//Add default skin
    	$user->items()->attach(1);
    	$user->items->find(1)->pivot->update(['quantity' => 1]);
    	return redirect($this->redirectPath());
    }
}
