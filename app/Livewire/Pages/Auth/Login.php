<?php

namespace App\Livewire\Pages\Auth;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;

class Login extends Component
{
    public $phone;
    public $showName = false;
    public $password;

    public $otp;

    public $name;

    public $loading = false;

    public $otpSent = false;

    public $showOtp = true;

    protected $rules = [
        'phone' => 'required|digits_between:10,15',
        'password' => 'required|min:6',
    ];

    protected $messages = [
        'phone.required' => 'Phone number is required',
        'phone.digits_between' => 'Phone number must be between 10 and 15 digits',
        'password.required' => 'Password is required',
        'password.min' => 'Password must be at least 6 characters',
    ];

    public function mount()
    {
        if (Auth::check()) {
            return redirect()->intended('/dashboard');
        }
    }

    public function render()
    {
        return view('livewire.pages.auth.login', [
            'metaData' => [
                'title' => 'Login',
                'description' => 'Login to your account',
                'keywords' => 'login, account, authentication',
            ],
        ])->layout('components.layouts.auth');
    }

    public function updated($property)
    {
        $this->validateOnly($property);
    }

    public function sendOtp()
    {
        $this->validate([
            'phone' => 'required|digits_between:10,15',
        ]);
        sleep(1);
        if (cache()->has('otp_request_' . $this->phone)) {
            return $this->addError('otp', 'Please wait before requesting another OTP.');
        }
        cache()->put('otp_request_' . $this->phone, true, now()->addSeconds(30));
        $user = User::firstOrCreate(
            ['phone' => $this->phone],
            ['password' => bcrypt($random = Str::random(8))]
        );

        if ($user->wasRecentlyCreated) {
            session()->flash('message', 'OTP sent successfully, on '.$this->phone);
        }

        $otp = random_int(100000, 999999);
        logger("OTP for {$this->phone}: {$otp}");

        $user->update([
            'otp' => $otp,
            'otp_expires_at' => now()->addMinutes(5),
        ]);

        $this->otpSent = true;
        session()->flash('message', 'OTP sent successfully, on +91 '.$this->phone);
    }


    public function verifyOtp()
    {
        $this->validate([
            'phone' => 'required|digits_between:10,15',
            'otp' => 'required|digits:6',
        ]);

        $user = User::where('phone', $this->phone)->first();

        if (! $user) {
            return $this->addError('otp', 'Phone number not found.');
        }

        if ($user->otp != $this->otp) {
            return $this->addError('otp', 'Invalid OTP.');
        }

        if (Carbon::parse($user->otp_expires_at)->isPast()) {
            return $this->addError('otp', 'OTP expired.');
        }

        $user->update([
            'otp' => null,
            'otp_expires_at' => null,
        ]);

        if (empty($user->name)) {
            sleep(1);
            session()->flash('message', 'Enter your name and get 20% off on your first order');
            $this->showName = true;
            return;
        }

        Auth::login($user);

        session()->flash('message', 'Logged in successfully');
        return redirect()->intended('/dashboard');
    }


    public function submitName()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|digits_between:10,15',
        ]);

        $user = User::where('phone', $this->phone)->first();
        $user->update(['name' => $this->name]);

        Auth::login($user);
        session()->flash('message', 'Welcome, '.$user->name);

        return redirect()->intended('/dashboard');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }
}
