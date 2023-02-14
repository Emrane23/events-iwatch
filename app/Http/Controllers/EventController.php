<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Panel;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(){
        $events = Event::with('panels')->get();
        return response()->json(['events' => $events], 200);
    }
    public function searchPanel($event){
        $panels = Panel::where('event_id',$event)-> with('Event')->get();
        return response()->json(['panels' => $panels], 200);
    }
}
