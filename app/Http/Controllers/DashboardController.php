<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Notifications\FirebaseNotification;
use App\Notifications\FirebaseNotificationQueue;

class DashboardController extends Controller
{
    /**
     * Show the confirm password view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request): View
    {
        $auth = Auth::user();

        $auth->notify(new FirebaseNotificationQueue());
        // $auth->notify(new FirebaseNotification());

        $data = [
            'user' => $auth,
        ];
        return view('dashboard', $data);
    }
}
