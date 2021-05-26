<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

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

        $msgData = [
            'title' => 'hello',
            'message' => 'welcome to dashboard',
        ];
        $auth->sendFirebaseNotification($msgData);

        $data = [
            'user' => $auth,
        ];
        return view('dashboard', $data);
    }
}
