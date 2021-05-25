<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\SettingProfileRequest;
use App\Http\Requests\Auth\SettingSecurityRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\AuthTwoFactor;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    /**
     * Display setting profile view
     *
     * @return \Illuminate\View\View
     */
    public function profile()
    {
        $user = Auth::user();
        $data = [
            'user' => $user,
        ];

        return view('auth.setting-profile', $data);
    }

    /**
     * Handle an incoming profile update request.
     *
     * @param  SettingProfileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function profileUpdate(SettingProfileRequest $request)
    {
        $auth = Auth::user();
        $auth->fullname = $request->fullname;
        $auth->username = $request->username;
        $auth->email = $request->email;
        $auth->phone = $request->phone;

        if ($request->image) {
            Storage::delete('public/images/' . $auth->image);

            $fileName = time() . '_' . $request->image->getClientOriginalName();
            Storage::putFileAs(
                'public/images',
                $request->file('image'),
                $fileName
            );

            $auth->image = $fileName;
            $auth->image_url = asset('storage/images/' . $fileName);
        }

        $auth->save();

        return redirect()->route('profile')->with('status', 'Profile Updated !');
    }

    /**
     * Display setting security view
     *
     * @return \Illuminate\View\View
     */
    public function security()
    {
        $twoFactor = AuthTwoFactor::all();

        $isChecked = 0;
        if (isset(Auth::user()->authTwoFactor)) {
            $isChecked = Auth::user()->authTwoFactor->id;
        }

        return view(
            'auth.setting-security',
            [
                'twoFactor' => $twoFactor,
                'isChecked' => $isChecked,
            ]
        );
    }

    /**
     * Handle an incoming profile update request.
     *
     * @param  SettingProfileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function securityUpdate(SettingSecurityRequest $request)
    {
        $auth = Auth::user();
        if (empty($request->twoFactor)) {
            $auth->authTwoFactor()->dissociate();
        } else {
            $authTwoFactor = AuthTwoFactor::find($request->twoFactor);
            $auth->authTwoFactor()->associate($authTwoFactor);
        }
        $auth->save();

        return redirect()->route('profile')->with('status', 'Security Updated !');
    }
}
