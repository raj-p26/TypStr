<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Http\Response;

class DashboardController extends Controller
{
    function settings(Request $request)
    {
        session(['max_words' => $request['max_words'], 'theme' => $request['theme']]);

        return redirect()->back()->with(['alert_type' => 'success', 'message' => "Settings updated!"]);
    }

    function login(Request $request)
    {
        $request->validate([
            'loginEmail' => 'email|required',
            'loginPassword' => 'required|max:255'
        ]);

        echo "Email: " . $request['loginEmail'] . "<br />";
        echo "Password: " . $request['loginPassword'];
    }

    function register(Request $request)
    {
        $request->validate([
            'username' => 'required|max:255',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        echo "Username: " . $request['username'] . "<br />";
        echo "Email: " . $request['email'] . "<br />";
        echo "Password: " . $request['password'];
    }
}
