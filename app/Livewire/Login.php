<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Auth;

#[Layout('components.layouts.empty')]
#[Title('Login')]

class Login extends Component
{

    #[Rule('required|email')]
    public string $email = '';

    #[Rule('required')]
    public string $password = '';

    public function mount()
    {
        if (Auth::user()) {
            return redirect('/courses');
        }
    }

    public function login()
    {
        $credentials = $this->validate();

        if (Auth::attempt($credentials)) {
            request()->session()->regenerate();

            $user = Auth::user();
            logger(get_class($user));

            if ($user->role === 'instructor') {
                return redirect()->route('instructor.dashboard');
            }
            return redirect()->intended('/courses');
        }

        $this->addError('email', 'The provided credentials do not match our records.');
    }


    public function render()
    {
        return view('livewire.auth-login');
    }
}
