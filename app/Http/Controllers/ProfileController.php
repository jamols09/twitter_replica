<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index()
    {
        $user = User::find(Auth::user()->id);
        return view('profile.index')->with(['user' => $user]);
    }

    public function update(ProfileUpdateRequest $data)
    {
        
        $validated = $data->validated();

        if ($data->file('thumbnail')) {
            $thumb_path = $data->file('thumbnail')->storeAs(
                'public/files',
                time() . '.' . $data->file('thumbnail')->extension()
            );
            $validated['thumbnail'] = basename($thumb_path);
        }

        User::find(Auth::user()->id)->update($validated);

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
}
