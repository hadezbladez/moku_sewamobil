<?php
  
namespace App\Http\Controllers\Auth;
  
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
use Hash;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
  
class AuthController extends Controller
{
    public function index()
    {
        if(Auth::check()){return redirect('dashboard');}
        return view('auth.login');
    }
    public function registration()
    {
        if(Auth::check()){return redirect('dashboard');}
        return view('auth.registration');
    }
    public function dashboard()
    {
        if(Auth::check()){return view('dashboard');}
  
        return redirect("login")->withSuccess('Opps! You do not have access');
    }
    public function mmobil()
    {
        if(Auth::check()){return view('mobilmanajemen');}
  
        return redirect("login")->withSuccess('Opps! You do not have access');
    }



    
    public function postLogin(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')
                        ->withSuccess('You have Successfully loggedin');
        }
  
        return redirect("login")->withSuccess('Oppes! You have entered invalid credentials');
    }
    
    public function postRegistration(Request $request): RedirectResponse
    {  
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'alamat' => 'required',
            'phone' => 'required|regex:/(0)[0-9]{9}/',
            'sim' => 'required|regex:/[0-9]{9}/',
            'password' => 'required|min:6',
        ]);
           
        $data = $request->all();
        $check = $this->create($data);
         
        return redirect("dashboard")->withSuccess('Great! You have Successfully loggedin');
    }
    

    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        
        'alamat' => $data['alamat'],
        'phone' => $data['phone'],
        'sim' => $data['sim'],

        'password' => Hash::make($data['password'])
      ]);
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function logout(): RedirectResponse
    {
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }
}