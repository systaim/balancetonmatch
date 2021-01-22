<?php

namespace App\Http\Controllers;

use App\Mail\StaffMail;
use App\Models\Staff;
use App\Models\Club;
use App\Models\Player;
use App\Models\Match;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class StaffController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->only('create');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Club $club)
    {
        return view('staffs.index', ['club' => $club]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Club $club)
    {
        return View('staffs.create', ['club' => $club]);
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
        $matchs = Match::where('home_team_id', $club->id)->orwhere('away_team_id', $club->id)->orderBy('date_match','desc')->get();

        $dataStaff = $request->validate([
            'last_name' => 'required|max:50|min:2',
            'first_name' => 'required|max:50|min:2',
            'file' => 'nullable|max:10240',
            'quality' => 'required|min:3',
        ]);
            
        $dataStaff['club_id'] = $club->id;

        if ($request->has('file')) {
            $path = $request->file->store('avatars');
            $dataStaff['avatar_path'] = $path;
        } else {
            $dataStaff['avatar_path'] = "/images/PlayerAvatar.jpg";
        }

        $staff = Staff::create($dataStaff);
        $staff->user()->associate($user);
        $staff->save();

        $staffCreate = [
            'last_name' => $staff->last_name,
            'first_name' => $staff->first_name,
            'quality' => $staff->quality,
            'club_id' => $staff->club->name,
            'user_first_name' => $staff->user->first_name,
            'user_last_name' => $staff->user->last_name,
            'user_id' => $staff->user_id,
        ];

        $admins = User::where('role_id', '1')->get();

        foreach ($admins as $admin) {
            Mail::to($admin->email)
                ->send(new StaffMail($staffCreate));
        }

        return redirect('clubs/' .$club->id. '/staffs')->with('success', $staff->first_name. ' a été créé avec succes !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function show(Staff $staff)
    {
        $staffs = Staff::all();
        return view('clubs.pageClub', compact('club', 'staffs'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function edit(Staff $staff)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Club $club, Staff $staff)
    {
        $user = Auth::user();

        $datastaff = $request->validate([
            'last_name' => 'required|max:50|min:2',
            'first_name' => 'required|max:50|min:2',
            'date_of_birth' => 'nullable|date',
            'file' => 'nullable|max:10240',
            'quality' => 'max:15',
        ]);


        $staff->first_name = $request->first_name;
        $staff->last_name = $request->last_name;
        $staff->date_of_birth = $request->date_of_birth;
        $staff->quality = $request->quality;
        if ($request->has('file')) {
            $path = $request->file->store('avatars');
            $staff->avatar_path = $path;
        }

        // dd($staff);
        $staff->user()->associate($user);

        $staff->save();
        return back()->with('messageUpdate', 'Le joueur a bien été mis à jour');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function destroy(Club $club, Staff $staff)
    {
        $staff->delete();
        return back();
    }
}
