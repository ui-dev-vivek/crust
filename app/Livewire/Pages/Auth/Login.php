<?php

namespace App\Livewire\Pages\Auth;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $phone;

    public $password;

    public $loading = false;

    public $otp;

    public $showOtp = false;

    public $otpSent = false;

    protected $rules = [
        'phone' => 'required|digits_between:10,15|exists:users,phone',
        'password' => 'required|min:6',
    ];

    protected $messages = [
        'phone.required' => 'Phone number is required',
        'phone.digits_between' => 'Phone number must be between 10 and 15 digits',
        'phone.exists' => 'Phone number does not exist in our records',
        'password.required' => 'Password is required',
        'password.min' => 'Password must be at least 6 characters',

    ];

    public function mount()
    {
        if (Auth::check()) {
            return redirect()->intended('/dashboard');
        }
    }

    public function toggleLoginMethod()
    {
        $this->reset(['password', 'otp', 'otpSent']);
        $this->showOtp = ! $this->showOtp;
    }

    public function sendOtp()
    {
        $this->validate([
            'phone' => 'required|digits_between:10,15|exists:users,phone',
        ]);

        $user = User::where('phone', $this->phone)->first();

        $generatedOtp = rand(100000, 999999); // Or use a service to send actual OTP

        $user->otp = $generatedOtp;
        $user->otp_expires_at = Carbon::now()->addMinutes(5);
        $user->save();

        // Simulate sending OTP (you can integrate SMS API here)
        // e.g., SmsService::send($this->phone, "Your OTP is: $generatedOtp");

        $this->otpSent = true;

        session()->flash('message', 'OTP sent successfully.');
    }

    public function verifyOtp()
    {

        $this->validate([
            'phone' => 'required|digits_between:10,15',
            'otp' => 'required|digits:6',
        ]);

        $user = User::where('phone', $this->phone)->first();

        if (!$user) {
            $this->addError('phone', 'Phone number not found.');
            return;
        }

        if ($user->otp != $this->otp) {
            $this->addError('otp', 'Invalid OTP.');
            return;
        }

        if (Carbon::parse($user->otp_expires_at)->isPast()) {
            $this->addError('otp', 'OTP expired.');
            return;
        }

        // Optional: Mark phone as verified
        // $user->is_phone_verified = true;
        $user->otp = null; // Clear OTP
        $user->otp_expires_at = null;
        $user->save();

        Auth::login($user);
        return redirect()->intended('/dashboard');
    }



    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function login()
    {
        $this->validate();
        $this->loading = true;

        if (Auth::attempt(['phone' => $this->phone, 'password' => $this->password])) {
            return redirect()->intended('/dashboard');
        } else {
            $this->addError('phone', 'Invalid phone number or password');
        }

        $this->loading = false;
    }

    public function render()
    {
        $metaData = [
            'title' => 'Login',
            'description' => 'Login to your account',
            'keywords' => 'login, account, authentication',

        ];

        return view('livewire.pages.auth.login')->layout('components.layouts.auth');

    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
    public function redirectToRegister()
    {
        // return redirect()->route('register');
    }
    public function redirectToForgotPassword()
    {
        // return redirect()->route('forgot-password');
    }
}
