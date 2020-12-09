<?php

namespace App\Http\Controllers;

use App\Models\Match;
use App\Models\Commentaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Gate;

class CommentaireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Match $match)
    {
        // dd($request->all());
        $user = Auth::user();

        $dataComment = $request->validate([
            'type_comments' => ['required'],
            // 'comments' => 'min:3',
            'minute' => 'required',
        ]);

        $dataMatch = $request->validate([
            'home_score' => ['digits:1'],
            'away_score' => ['digits:1'], //'required_without:home_score',
        ]);

        $match->update($dataMatch);

        $dataComment['match_id'] = $match->id;
        // dd($request->all());
        $comment = Commentaire::create($dataComment);
        $comment->user()->associate($user);
        $comment->save();
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Commentaire  $commentaire
     * @return \Illuminate\Http\Response
     */
    public function show(Commentaire $commentaire)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Commentaire  $commentaire
     * @return \Illuminate\Http\Response
     */
    public function edit(Commentaire $commentaire)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Commentaire  $commentaire
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Commentaire $commentaire)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Commentaire  $commentaire
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $commentaire = Commentaire::find($id);

        if ($commentaire->statistic) {
            if ($commentaire->statistic->action == "goal" && $commentaire->team_action == "home") {
                $commentaire->delete();
                $commentaire->commentator->match->home_score -= 1;
                $commentaire->commentator->match->save();
            } elseif ($commentaire->statistic->action == "goal" && $commentaire->team_action == "away") {
                $commentaire->delete();
                $commentaire->commentator->match->away_score -= 1;
                $commentaire->commentator->match->save();
            }
        } else {
            $commentaire->delete();
        }

        $commentaire->delete();
        return back();
    }
}
