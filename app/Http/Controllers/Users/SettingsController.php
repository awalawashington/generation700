<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use App\Rules\CheckSamePassword;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rules\Password;

class SettingsController extends Controller
{
    public function index()
    {
        return view('Admin.Admin.profile');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone_number' => 'required|numeric'
        ]);

        auth()->user()->update([
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'email' => $request->email
        ]);

        return redirect()->route('profile')->with('success','Profile successfully updated');

    }

    public function updatePassword(Request $request)
    {
        
        //current password
        //new password
        //password confirmation
        
        $this->validate($request,[
            'current_password' => ['required',new MatchOldPassword], 
            'password' => [
                'required', 
                'confirmed',
                Password::min(8)
                ->mixedCase()
                ->letters()
                ->numbers()
                ->symbols()
                ->uncompromised(),
                 new CheckSamePassword
                 ]
            ]);

            $request->user()->update([
                "password" => bcrypt($request->password) 
            ]);

            return redirect()->route('profile')->with('success','Password successfully Changed');

    }



}
