<?php

namespace App\Http\Controllers;

use App\Models\Record;
use Illuminate\Http\Request;
use \App\Models\User;

class DashboardController extends Controller
{
    function settings(Request $request)
    {
        session([
            'max_words' => $request['max_words'],
            'theme' => $request['theme'],
            'custom_text' => $request['custom_text']
        ]);

        return redirect()
            ->back()
            ->with(['alert_type' => 'success', 'message' => "Settings updated!"]);
    }

    function login(Request $request)
    {
        $request->validate([
            'loginEmail' => 'email|required',
            'loginPassword' => 'required|max:255'
        ]);

        $user = User::where([
            'email' => $request['loginEmail'],
            'password' => md5($request['loginPassword'])
        ])->first();

        if (!$user)
            return redirect()
                ->back()
                ->with(['alert_type' => 'danger', 'message' => "Invalid Credentials"]);

        session(['user_id' => $user['id']]);

        return redirect()
            ->back()
            ->with(['alert_type' => "success", 'message' => "Welcome Back, " . $user['username'] . "!"]);
    }

    function register(Request $request)
    {
        $request->validate([
            'username' => 'required|max:255',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = new User;
        $user['username'] = $request['username'];
        $user['email'] = $request['email'];
        $user['password'] = md5($request['password']);

        $user->save();

        session(['user_id' => $user['id']]);

        return redirect()
            ->back()
            ->with(['alert_type' => "success", 'message' => "Successfully Signed Up!"]);
    }

    function logout(Request $request)
    {
        $request->session()->forget('user_id');

        return redirect('/')
            ->with(['alert_type' => 'success', 'message' => 'Successfully Logged Out!', 'logged_out' => true]);
    }

    function leaderboard()
    {
        return view('leaderboard');
    }
}
