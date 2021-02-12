<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\Player;
use App\Models\Statistic;
use App\Models\Match;
use App\Mail\PlayerMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlayerController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->only('create');
    }

    use SoftDeletes;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Club $club)
    {
        $user = Auth::user();
        $index = 0;
        $players = Player::where('club_id', $club->id)
            ->orderBy('last_name', 'asc')
            ->orderBy('first_name', 'asc')
            ->get();
        return view('players.index', compact('club', 'players', 'user', 'index'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Club $club)
    {
        return View('players.create', ['club' => $club]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Club $club)
    {
        $user = Auth::user();
        // dd($user->id);
        // $players = Player::where('club_id', $club->id)
        //     ->orderBy('last_name', 'asc')
        //     ->orderBy('first_name', 'asc')
        //     ->get();

        $matchs = Match::where('home_team_id', $club->id)->orwhere('away_team_id', $club->id)->orderBy('date_match', 'desc')->get();

        $dataPlayer = $request->validate([
            'last_name' => 'required|max:50|min:2',
            'first_name' => 'required|max:50|min:2',
            'date_of_birth' => 'nullable|date',
            'file' => 'nullable|max:10240',
            'position' => 'required',
        ]);
        $dataPlayer['club_id'] = $club->id;
        $dataPlayer['created_by'] = $user->id;


        // @dd($players);

        if ($request->has('file')) {
            $path = $request->file->store('avatars');
            $dataPlayer['avatar_path'] = $path;
        }

        $player = Player::create($dataPlayer);
        // $player->user()->associate($user);
        $player->save();

        // $playersClub = collect($players);
        // $players->push($player);



        // dd($player);

        //envoi d'un mail avec les informations du joueur

        $playerCreate = [
            'last_name' => $player->last_name,
            'first_name' => $player->first_name,
            'date_of_birth' => $player->date_of_birth,
            'position' => $player->position,
            'club_id' => $player->club->name,
            'creator_first_name' => $player->creator->first_name,
            'creator_last_name' => $player->creator->last_name,
            'creator_id' => $player->created_by,
        ];

        $superAdmin = User::where('role', 'super-admin')->get()->pluck('email');
        // $admins = User::where('role', 'admin')->get()->pluck('email');

        Mail::to($superAdmin)
                ->send(new PlayerMail($playerCreate));

        // foreach ($admins as $admin) {
        //     Mail::to($admin)
        //     ->send(new ContactMail($contactCreate));
        // }

        return redirect('clubs/' .$club->id. '/players')->with('success', $player->first_name. ' a été créé avec succes !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function show(Player $player)
    {
        $goals = Statistic::where('action', 'goal')->count();

        return View('players.show', compact('player', 'goals'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function edit(Player $player)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Club $club, Player $player)
    {
        $user = Auth::user();

        $dataPlayer = $request->validate([
            'last_name' => 'required|max:50|min:2',
            'first_name' => 'required|max:50|min:2',
            'date_of_birth' => 'nullable|date',
            'file' => 'nullable|max:10240',
            'position' => 'max:15',
        ]);


        $player->first_name = $request->first_name;
        $player->last_name = $request->last_name;
        $player->date_of_birth = $request->date_of_birth;
        $player->position = $request->position;
        $player->created_by = $user->id;
        if ($request->has('file')) {
            $path = $request->file->store('avatars');
            $player->avatar_path = $path;
        }

        // $player->user()->associate($user);

        $player->save();
        return redirect('clubs/' .$club->id. '/players')->with('success', $player->first_name. ' a été mis à jour !');
        // return back()->with('messageUpdate', 'Le joueur a bien été mis à jour');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function destroy(Club $club, Player $player)
    {
        $player->delete();
        return back();
    }
}
