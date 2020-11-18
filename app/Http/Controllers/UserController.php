<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Mail\Mailable;
use Illuminate\Notifications\Notifiable;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{

    use Notifiable;

}
