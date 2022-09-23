<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Api\CommentaireController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\RencontreController;
use App\Http\Controllers\PlayerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClubController;
use App\Http\Controllers\CompetitionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\StaffController;
use App\Models\Article;
use App\Models\CategoryArticle;
use App\Models\CategoryArticleArticle;
use App\Models\Competition;
use App\Models\Department;
use App\Models\Club;
use App\Models\Commentator;
use App\Models\DivisionsDepartment;
use App\Models\DivisionsRegion;
use App\Models\Group;
use App\Models\Journee;
use App\Models\Rencontre;
use App\Models\Player;
use App\Models\Region;
use App\Models\Staff;
use App\Models\Statistic;
use App\Models\User;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Livewire;

$club = ClubController::class;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/competitions/coupe-de-france', function () {

    $matchs = Rencontre::where('competition_id', 3)->where('date_match', '>=', Carbon::now()->subDays(5))->orderBy('date_match', 'asc')->get();
    $user = Auth::user();
    $title = "coupe De France";

    return view('competitions.coupeDeFrance', compact('matchs', 'user', 'title'));
});

Route::get('/competitions/coupe-de-bretagne', function () {

    $matchs = Rencontre::where('competition_id', 4)->where('date_match', '>=', Carbon::now()->subDays(5))->where('region_id', 3)->orderBy('date_match', 'asc')->get();
    $user = Auth::user();
    $title = "coupe de Bretagne";
    $region = Region::find(3);

    return view('competitions.coupeDeBretagne', compact('matchs', 'user', 'title', 'region'));
});

Route::get('/competitions/coupe-ange-lemee', function () {

    $matchs = Rencontre::where('competition_id', 5)->where('date_match', '>=', Carbon::now()->subDays(5))->where('department_id', 22)->orderBy('date_match', 'asc')->get();
    $user = Auth::user();
    $title = "coupe Ange Lemée";
    $region = Region::find(3);
    $departement = Department::find(22);

    return view('competitions.coupeAngeLemee', compact('matchs', 'user', 'title', 'region', 'departement'));
});

Route::get('/competitions/coupe-du-departement/region/{region:slug}/departement/{departement}', function (Region $region, Department $departement) {

    $matchs = Rencontre::where('competition_id', 7)->where('date_match', '>=', Carbon::now()->subDays(5))->where('region_id', $region->id)->where('department_id', $departement->id)->orderBy('date_match', 'asc')->get();
    $user = Auth::user();
    $title = "Coupe du département";
    $region = Region::find(3);
    $departement = Department::find(22);

    return view('competitions.coupeDuDepartement', compact('departement', 'matchs', 'user', 'title', 'region', 'departement'));
});

Route::get('region/{region:slug}/regional/{division}/groupe/{groupe}', function (Region $region, DivisionsRegion $division, Group $groupe) {

    $matchs = Rencontre::where('region_id', $region->id)->where('date_match', '>=', Carbon::now()->subDays(5))->where('division_region_id', $division->id)->where('group_id', $groupe->id)->get()->groupBy('journee_id');
    $journees = Journee::find($matchs->keys());

    return view('competitions.regional', compact('region', 'matchs', 'journees', 'division', 'groupe'));
})->name('competition.regionale');


Route::get('region/{region:slug}/departement/{departement}/district/{division}/groupe/{groupe}', function (Region $region, Department $departement, Competition $competition, DivisionsDepartment $division, Group $groupe) {

    $matchs = Rencontre::where('region_id', $region->id)->where('date_match', '>=', Carbon::now()->subDays(5))->where('department_id', $departement->id)->where('division_department_id', $division->id)->where('group_id', $groupe->id)->get()->groupBy('journee_id');
    $journees = Journee::find($matchs->keys());

    return view('competitions.district', compact('region', 'departement', 'matchs', 'journees', 'division', 'groupe'));
})->name('competition.district');


Route::get('/competitions/amicaux', function () {

    $matchs = Rencontre::where('competition_id', 6)->where('date_match', '>=', Carbon::now()->subDays(5))->where('date_match', '>=', Carbon::now()->subHours(12))->orderBy('date_match', 'asc')->get();
    $user = Auth::user();

    return view('competitions.amicaux', compact('matchs', 'user'));
});


Route::get('/contact', function () {

    return view('contact');
})->name('contact');

Route::get('/mentions-legales', function () {

    return view('mentionslegales');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/mon-espace/mes-favoris', function () {
    return view('mon-espace.mes-favoris');
});

// Route::middleware(['auth:sanctum', 'verified'])->get('/admin/addClub', function () {
//     $regions = Region::all();
//     $role = Auth::user()->role;

//     if ($role == "super-admin" || $role == "admin") {
//         return view('admin.addClub', compact('regions'));
//     } else {
//         return redirect('/')->with('danger', "Vous n'êtes pas autorisé à entrer ici");
//     }
// })->middleware('auth');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::get('/admin/create-article', function () {
        $role = Auth::user()->role;
        $categories = CategoryArticle::all();

        if ($role == "super-admin" || $role == "admin") {

            return view('admin.create-article', compact('categories'));
        } else {

            return redirect('/')->with('danger', "Vous n'êtes pas autorisé à entrer ici");
        }
    });

    Route::get('/admin/articles', function () {

        $articles = Article::all();

        return view('admin.articles', compact('articles'));
    });

    Route::get('/admin/addClub', function () {
        $regions = Region::all();
        $role = Auth::user()->role;

        if ($role == "super-admin" || $role == "admin") {
            return view('admin.addClub', compact('regions'));
        } else {
            return redirect('/')->with('danger', "Vous n'êtes pas autorisé à entrer ici");
        }
    });
});


// Route::middleware(['auth:sanctum', 'verified'])->get('/admin/create-article', function () {

//     $role = Auth::user()->role;
//     $categories = CategoryArticle::all();

//     if ($role == "super-admin" || $role == "admin") {

//         return view('admin.create-article', compact('categories'));
//     } else {

//         return redirect('/')->with('danger', "Vous n'êtes pas autorisé à entrer ici");
//     }
// });

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/', HomeController::class)->name('home');
Route::resource('articles', ArticleController::class);
Route::resource('clubs', ClubController::class);
Route::resource('players', PlayerController::class);
Route::resource('matches', RencontreController::class);
Route::resource('commentaires', CommentaireController::class);
Route::resource('clubs.players', PlayerController::class);
Route::resource('clubs.staffs', StaffController::class);
Route::resource('regions', RegionController::class)->parameters([
    'regions' => 'region:slug'
]);
Route::resource('competitions', CompetitionController::class);

// Route::resource('competitions.division_region.groups', Group::class)->only('show');
// Route::get('regions/{region:slug}', function (Region $region) {
//     $clubs = Club::where('region_id', $region->id)->get();
//     // $regionDeFrance = Region::find($region->id);
//     // dd($region->name);
//     // $matchesByRegion = Rencontre::where('region_id', $region->id)->where('date_match','>=', Carbon::now()->subHours(12))->paginate(10);
//     // $competitions = Competition::find($matchesByRegion->keys());

//     return view('regions.show', compact('region', 'clubs'));
// });

Route::resource('admin/users', 'App\Http\Controllers\UserController')->middleware('auth');
Route::resource('admin', AdminController::class)->middleware('auth');

Route::post('contacts', 'App\Http\Controllers\ContactController@store')->name('contacts.store');
Route::post('contactsNewTeam', 'App\Http\Controllers\ContactController@askNewTeam')->name('contacts.askNewTeam');
Route::post('contactsForPlayers', 'App\Http\Controllers\ContactController@askPlayer')->name('contacts.askPlayer');
Route::post('contactsForBecomeManager', 'App\Http\Controllers\ContactController@becomeManager')->name('contacts.becomeManager');

Route::get('live', function () {

    $user = Auth::user();

    return view('matches.live', compact('user'));
});

Route::middleware(['auth:sanctum', 'verified'])->get('notifications', function () {
    return view('notifications.index');
});

Route::get('commentaire/delete/{id}', 'App\Http\Controllers\CommentaireController@destroy')->name('supprimer');

// Route::get('demo', 'App\Http\Controllers\RencontreController@demo')->name('demo');

Route::get('/offline', function () {
    return view('vendor/laravelpwa/offline');
});

Route::get('/politique-de-confidentialite', function () {
    return view('politique-de-confidentialite');
})->name('politique-de-confidentialite');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('recup-matchs', 'App\Http\Controllers\RecupMatchController@getMatches')->name('recup-matchs');
});
