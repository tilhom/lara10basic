<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\ProfileStoreRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{

    /**
     * Display the user's profile form.
     */
    public function view(Request $request): View
    {
        return view('profile.view', [
            'user' => $request->user(),
        ]);
    }


    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function store(ProfileStoreRequest $request)
    {
        $request->user()->fill($request->validated());

        // $file = $request->file('profile_image');

        // $filename = date('YmdHi').$file->getClientOriginalName();
        // $file->move(public_path('upload/admin_images'),$filename);
        if ($request->file('profile_image')) {
            $filename = $request->file('profile_image')->store('admin_images', 'public');
            $request->user()->profile_image = $filename;
        }

        $request->user()->save();

        // return redirect()->route('profile.view');

        $notification = array(
            'message' => 'Admin Profile Updated Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('profile.view')->with($notification);
    } // End Method


    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/login');
    }

    public function change_password()
    {

        return view('profile.change_password');
    } // End Method

    public function update_password(Request $request)
    {
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],

        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);
        session()->flash('message', 'Password Updated Successfully');
        return redirect()->back();
    }
}
