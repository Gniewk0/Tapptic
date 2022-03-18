<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Swipes extends Controller
{
    public function store(Request $request)
    {
        $swipe = new Swipes();
        $swipe->user_id = $request->user_id;
        $swipe->swipe_id = $request->swipe_id;
        $swipe->save();

        $pair = Swipes::where('user_id', $request->swipe_id)->firstOrFail();

        if($pair){
            $pair = new Pairs();
            $pair->user_id = $request->user_id;
            $pair->pair_id = $request->swipe_id;
            $swipe->save();
        }

        return ['message' => 'swipe created'];
    }

    public function destroy(Swipes $swipes, Request $request)
    {
        
        $swipe = Swipes::where('user_id', $request->user_id)->where('swipe_id', $request->swipe_id)->delete();

        $pair = Pairs::where('user_id', $request->user_id)->orWhere('pair_id', $request->user_id)->delete();
 
        return ['message' => 'swipe deleted'];
    }
}
