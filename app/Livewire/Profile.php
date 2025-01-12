<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Student;
use App\Models\Instructor;

class Profile extends Component
{
    use WithFileUploads;

    public $name;
    public $email;
    public $password;
    public $bio;
    public $avatar;
    public $newAvatar;

    public function mount()
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;

        if ($user->instructor) {
            $profile = Instructor::where('user_id', $user->id)->first();
        } else {
            $profile = Student::where('user_id', $user->id)->first();
        }

        if ($profile) {
            $this->bio = $profile->bio;
            $this->avatar = $profile->avatar;
        }
    }

    public function updatedNewAvatar()
    {
        $this->validate([
            'newAvatar' => 'image|max:1024|mimes:jpg,jpeg,png,gif', // 1mb max
        ]);
    }

    public function updateProfile()
    {
        $user = Auth::user();

        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:8',
            'bio' => 'nullable|string|max:500',
            'newAvatar' => 'nullable|image|max:1024|mimes:jpg,jpeg,png,gif',
        ]);

        // Update user basic info
        $user->name = $this->name;
        $user->email = $this->email;

        if ($this->password) {
            $user->password = Hash::make($this->password);
        }
        $user->save();

        if ($user->instructor) {
            $profile = Instructor::where('user_id', $user->id)->first();
        } else {
            $profile = Student::where('user_id', $user->id)->first();
        }

        if ($profile) {
            $profile->bio = $this->bio;

            if ($this->newAvatar) {
                if ($profile->avatar) {
                    Storage::delete($profile->avatar);
                }
                $avatarPath = $this->newAvatar->store('avatars', 'public');
                $profile->avatar = $avatarPath;
            }

            $profile->save();
        }

        session()->flash('message', 'Profile updated successfully.');
    }

    public function render()
    {
        $user = Auth::user();

        if ($user->instructor) {
            return view('livewire.profile', [
                'user' => $user,
                'bio' => $this->bio,
                'avatar' => $this->avatar,
            ])->layout('components.layouts.instructor');
        } else {
            return view('livewire.profile', [
                'user' => $user,
                'bio' => $this->bio,
                'avatar' => $this->avatar,
            ])->layout('components.layouts.app');
        }
    }
}
