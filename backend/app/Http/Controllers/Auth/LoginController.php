<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    public function guestLogin()
    {
        $guestUserId = 1; 
        $user = User::find($guestUserId);
        Auth::login($user);
        $categories = Auth::user()->categories;
        $first_category_id = $categories->sortBy('id')->first()->id;
        return redirect('/ownitems/category/'.$first_category_id);
    }
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    
    // protected $redirectTo = RouteServiceProvider::HOME;
    // ログイン後のページ書き換え
    protected function redirectTo(){
        // $categories = Auth::user()->categories;
        // $first_category_id = $categories->sortBy('id')->first()->id;
        // return '/ownitems/category/'.$first_category_id;
        return app(RouteServiceProvider::class)->homePath();
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
