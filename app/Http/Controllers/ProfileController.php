<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return View
     */
    public function index()
    {
        $breadcrumbs = [
            ['link' => route('profile'), 'name' => __('locale.Profile')],
            ['name' => __('locale.Index')]
        ];

        return view('content.profile.index', ['breadcrumbs' => $breadcrumbs, 'user' => auth()->user()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserRequest  $request
     * @param  \App\Models\User  $user
     * @return RedirectResponse
     */
    public function update(UpdateProfileRequest $request)
    {
        $userData = $request->validated();
        $user = Auth::user();
        $user->fill($userData);
        $user->save();
        return back()->with(['message' => __('Profile updated successfully.')]);
    }

}
