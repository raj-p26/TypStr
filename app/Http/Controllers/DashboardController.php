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
}
