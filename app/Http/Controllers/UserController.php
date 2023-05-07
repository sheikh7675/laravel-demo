<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Validator;
use App\Models\User;
class UserController extends Controller
{
    public function index()
    {
        return view('user');
    }
    
    public function userForm(Request $request)
    {
        Validator::extend('without_spaces', function($attr, $value){
            return preg_match('/^\S*$/u', $value);
        });
  
        $request->validate([
                'name' => 'required',
                'username' => 'required|without_spaces',
            ],
            [
                'username.without_spaces' => 'Whitespace not allowed.'
            ]);
     
        $input = $request->all();
        $user = User::create($input);
      
        return back()->with('success', 'User data has been stored.');
    }
}
