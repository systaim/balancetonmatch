<?php

namespace App\Http\Livewire;

use App\Models\Favorismatch;
use App\Models\Rencontre;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class FavoriMatch extends Component
{

    public $club, $choix;
    public $user;
    public $star = "";
    public $nbrFavoris;
    public $login;
    public $match;

    public function mount(Rencontre $match)
    {
        if (Auth::check() && $this->user->isFavoriMatch($match)) {
            $this->choix = true;
        } else {
            $this->choix = false;
        }
    }

    public function myMatch(Rencontre $match)
    {

        if ($this->user->isFavoriMatch($match)) {
            $matchData = Favorismatch::where('user_id', $this->user->id)->where('match_id', $match->id)->delete();
            $this->choix = false;
            $this->nbrFavoris-=1;
            session()->flash('messageMyMatch', 'Tu ne suis plus ce match.');
            
        } else {
            $data['user_id'] = $this->user->id;
            $data['match_id'] = $match->id;
            $teamData = Favorismatch::create($data);
            $this->choix = true;
            $this->nbrFavoris+=1;
            session()->flash('messageMyMatch', 'Tu suis ce match.');
        }
    }

    public function clickLogin()
    {
        $this->login = "Tu souhaites suivre ce match ?";
    }

    public function render()
    {
        return view('livewire.favori-match');
    }
}
// <?php

// namespace App\Http\Livewire;

// use App\Models\Favorismatch;
// use App\Models\Rencontre;
// use Illuminate\Support\Facades\Auth;
// use Livewire\Component;

// class FavoriMatch extends Component
// {

//     public $club;
//     public $user;
//     public $star = "";
//     public $nbrFavoris;
//     public $login;
//     public $match;

//     public function mount(Rencontre $match)
//     {
//         if (Auth::check() && $this->user->isFavoriMatch($match)) {
//             $this->star = "M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z";
//             // $this->star = "M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z";

//         } else {
//             $this->star = "M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z";
//             // $this->star = "M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z";

//         }
//     }


//     public function myMatch(Rencontre $match)
//     {

//         if ($this->user->isFavoriMatch($match)) {
//             $matchData = Favorismatch::where('user_id', $this->user->id)->where('match_id', $match->id)->delete();
//             // $this->star = "M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z";
//             $this->star = "M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z";
            
//             $this->nbrFavoris-=1;
//             session()->flash('messageMyMatch', 'Tu ne suis plus ce match.');
//         } else {
//             $data['user_id'] = $this->user->id;
//             $data['match_id'] = $match->id;
//             $teamData = Favorismatch::create($data);
//             // $this->star = "M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z";
//             $this->star = "M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z";
            
//             $this->nbrFavoris+=1;
//             session()->flash('messageMyMatch', 'Tu suis ce match.');
//         }
//     }

//     public function clickLogin()
//     {
//         $this->login = "Tu souhaites suivre ce match ?";
//     }

//     public function render()
//     {
//         return view('livewire.favori-match');
//     }
// }
