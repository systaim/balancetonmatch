<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\Commentator;
use App\Models\Match;
use App\Models\Player;
use App\Models\Staff;
use App\Models\Statistic;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $matchesToday = Match::whereBetween('date_match', [Carbon::now()
        ->startOfDay(), Carbon::now()->endOfDay()])->get();
        $matchesTomorrow = Match::where('date_match', [Carbon::tomorrow()])->get();
        $futurMatches = Match::where('date_match', '>=', Carbon::now()->subHours(6))
            ->orderBy('date_match', 'asc')->get();
        $matches = Match::all();
        $clubs = Club::all();
        $staffs = Staff::all();
        $players = Player::all();
        $dateJour = Carbon::now();
        $user = Auth::user();
        $today = now()->subHours(3);
        $goals= Statistic::where('action', 'goal')->get();
        $yellowCards= Statistic::where('action', 'yellow_card')->get();
        $redCards= Statistic::where('action','red_card')->get();
        $commentators = Commentator::all();
        // $liveMatches = Match::where('date_match','>=', Carbon::now()->subMinutes(240))
        //                     ->where(function($query) {
        //                         $query->where('live', '!=', 'attente');
        //                     })->get();
        // $matchsDuWeekEnd = Match::where(Auth::user()->club)
        

    return view('welcome', compact(
        'matchesToday', 
        'matchesTomorrow', 
        'futurMatches', 
        'staffs', 
        'matches', 
        'clubs', 
        'players', 
        'dateJour', 
        'user', 
        'today',
        'goals',
        'yellowCards',
        'redCards',
        'commentators',
        'liveMatches',
    ));
    }
}
