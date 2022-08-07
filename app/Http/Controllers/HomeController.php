<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Article;
use App\Models\Club;
use App\Models\Commentator;
use App\Models\Rencontre;
use App\Models\Player;
use App\Models\Region;
use App\Models\Staff;
use App\Models\Statistic;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

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
        $dateJour = Carbon::now();
        $user = Auth::user();
        $users = User::all();
        $today = now()->subHours(3);
        $goals= Statistic::where('action', 'goal')->get();
        $yellowCards= Statistic::where('action', 'yellow_card')->get();
        $redCards= Statistic::where('action','red_card')->get();
        $statistics = Statistic::where('action', 'goal')->where('created_at', '>=', now()->subDays(6))->orderBy('created_at', 'desc')->get();
        $stats = $statistics->unique('player_id');
        $activities = Activity::where('created_at', '>', now()->subDays(15))->orderByDesc('created_at')->get();
        $commentators = Commentator::where('created_at', '>', Carbon::now()->subDays(5))->where('user_id', '=!', 0)->get();
        $all_articles= Article::where('active', 1)->take(3)->get()->sortByDesc('created_at');

        $comOfTheWeek = Commentator::whereBetween('created_at',[Carbon::now()->subDays(6), Carbon::now()->addDay(1)])
        ->where('user_id', '=!', 0)
        ->get() ;

        

    return view('welcome', compact(
        'dateJour', 
        'user', 
        'users',
        'today',
        'goals',
        'yellowCards',
        'redCards',
        'commentators',
        'stats',
        'statistics',
        'comOfTheWeek',
        'activities',
        'all_articles'
    ));
    }
}
