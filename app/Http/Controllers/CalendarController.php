<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Events;

class CalendarController extends Controller
{
    public function index(){
        $events = Events::all();
        $events_array = [];

        foreach ($events as $key => $value) {
            $events_array[] = [
                'title' => $value->title,
                'start' => $value->start_date,
                'end' => $value->end_date,
            ];
        }
        // return $events_array;
        return view('admin.calander',compact('events_array'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255|string',
        ]);
    }
}
