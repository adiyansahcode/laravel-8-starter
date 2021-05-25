<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kreait\Laravel\Firebase\Facades\Firebase;

class ProfileController extends Controller
{
    /**
     * Show the confirm password view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        // Return an instance of the Auth component for the default Firebase project
        // $authFirebase = Firebase::auth();
        // $userFirebase = [
        //     'phoneNumber' => '+6287741413213',
        // ];
        // $signInFirebase = $authFirebase->createUser($userFirebase);

        // $firebaseUid = $signInFirebase->uid;

        // var_dump($signInFirebase->uid);
        // var_dump($user->routeNotificationForFcm());

        // $this->sendNotification();

        return view('auth.profile');
    }

    /**
     * Write code on Method.
     *
     *
     *
     * @return response()
     */
    public function send(Request $request)
    {
        $firebaseToken = Auth::user()->pluck('fcm_token');

        $SERVER_API_KEY = 'AAAAjzfOYLE:APA91bFiwi3zu2EHMbSUhixqmYYuaJJO6N7-EiD9kmRuIlhgYIoBZFtJWaW3WvJ2mmRwbBQjkN8xvO4hriTRnBNcqQuFc0DCeU0jUTtS8Kt_04wgSkVuYl6aAHHg-3Ba5hph_7qCfaOt';

        $data = [
            'registration_ids' => $firebaseToken,
            'notification' => [
                'title' => '1',
                'body' => '2',
            ],
        ];
        $dataString = json_encode($data);
        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
        $response = curl_exec($ch);
        dd($response);
    }
}
