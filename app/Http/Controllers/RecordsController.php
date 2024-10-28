<?php

namespace App\Http\Controllers;

use App\Models\Record;
use Illuminate\Http\Request;

class RecordsController extends Controller
{
    function index(Request $request)
    {
        $userID = $request->session()->get('user_id');

        if (!$userID) return view('error')->with('error', 'You are unauthorized!');

        $records = Record::where([
            'user_id' => $userID
        ])->orderBy('wpm', 'desc')->get();

        return view('history')->with('data', $records);
    }

    function store(Request $request)
    {
        $content = json_decode($request->getContent(), true);

        $record = new Record;

        $record['user_id'] = (int) $content['user_id'];
        $record['accuracy'] = (int) $content['accuracy'];
        $record['wpm'] = (int) $content['wpm'];
        $record['mistakes'] = (int) $content['mistakes'];
        $record['completed'] = (int) $content['completed'];
        $record['num_of_words'] = (int) $content['num_of_words'];
        $record['record_type'] = $content['record_type'];

        $record->save();

        return true;
    }

    /**
     * @param string $id
     */
    function destroy($id, Request $request)
    {
        $userID = $request->session()->get('user_id');
        if (!$userID) return view('error')->with('error', 'You are unauthorized');
        $record = Record::where([
            'user_id' => $userID,
            'id' => $id
        ])->first();

        if (!$record) return view('error')->with('error', 'You are unauthorized');

        $record->delete();

        return redirect()
            ->back()
            ->with(['alert_type' => 'success', 'message' => "Record Deleted!"]);
    }
}
