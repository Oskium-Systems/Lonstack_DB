<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function index()
    {
        return view('admin.profile.index');
    }


    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string|max:255',
            'profile_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ], [
            'name.required' => 'The name is required.',
            'email.required' => 'The email is required.',
            'email.unique' => 'This email is already taken.',
            'phone.required' => 'The phone number is required.',
            'profile_image.image' => 'The file must be an image.',
            'profile_image.mimes' => 'The image must be a JPEG, PNG, or JPG file.',
            'profile_image.max' => 'The image size must not exceed 2MB.',
        ]);

        try {
            $user = Auth::user();
            $profile = $user->profile ?? new Profile(['user_id' => $user->id]);

            // Handle image upload
            $imagePath = $profile->profile_image;
            if ($request->hasFile('profile_image')) {
                // Delete old image if exists
                if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                    Storage::disk('public')->delete($imagePath);
                }
                $image = $request->file('profile_image');
                $filename = Str::uuid() . '.' . $image->getClientOriginalExtension();
                $imagePath = $image->storeAs('profile-images', $filename, 'public');
            }

            // Update user
            $user->update([
                'name' => $validated['name'],
                'email' => $validated['email'],
            ]);

            // Update or create profile
            $profile->fill([
                'phone' => $validated['phone'],
                'address' => $validated['address'],
                'profile_image' => $imagePath,
            ])->save();

            return redirect()->route('admin.profile.index')->with('success', 'Profile updated successfully');
        } catch (\Exception $e) {
            if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
            return back()->withInput()->with('error', 'Failed to update profile: ' . $e->getMessage());
        }
    }



    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ], [
            'current_password.required' => 'Current password is required.',
            'new_password.required' => 'New password is required.',
            'new_password.min' => 'New password must be at least 8 characters.',
            'new_password.confirmed' => 'Password confirmation does not match.',
        ]);

        try {
            $user = Auth::user();

            // Verify current password
            if (!Hash::check($validated['current_password'], $user->password)) {
                return back()->withErrors(['current_password' => 'Current password is incorrect']);
            }

            // Update password
            $user->update([
                'password' => Hash::make($validated['new_password']),
            ]);

            // $user->update([
            //     'password' => $validated['new_password'],
            // ]);

            return redirect()->route('profile.index')->with('success', 'Password updated successfully');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Failed to update password: ' . $e->getMessage());
        }
    }
}
