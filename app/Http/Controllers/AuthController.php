<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Carbon;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:4',
            'role' => 'required|string|in:patient,admin',
        ]);

        // Store registration data in session
        session([
            'registration_data' => $request->only('name', 'email', 'password', 'role')
        ]);

        return $this->sendVerificationCode($request->email);
    }

    public function resendRegistrationOtp(Request $request)
    {
        $data = session('registration_data');
        if (!$data) {
            return response()->json(['error' => 'Session expired. Please start over.'], 400);
        }
        return $this->sendVerificationCode($data['email']);
    }

    private function sendVerificationCode($email)
    {
        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $email],
            ['token' => Hash::make($otp), 'created_at' => Carbon::now()]
        );

        try {
            Mail::raw("Welcome to JeevanSetu! Your account verification code is: $otp", function ($message) use ($email) {
                $message->to($email)->subject('Verify your account - JeevanSetu');
            });
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Mail Error: ' . $e->getMessage()], 500);
        }
    }

    public function verifyRegistrationOtp(Request $request)
    {
        $request->validate(['otp' => 'required|string|size:6']);
        $data = session('registration_data');

        if (!$data) {
            return response()->json(['error' => 'Your session has expired. Please try signing up again.'], 400);
        }

        $reset = DB::table('password_reset_tokens')->where('email', $data['email'])->first();

        if (!$reset) {
            return response()->json(['error' => 'No verification code found for this email.'], 400);
        }

        if (!Hash::check($request->otp, $reset->token)) {
            return response()->json(['error' => 'The code you entered is incorrect.'], 400);
        }

        // Check if code is expired (10 mins)
        if (Carbon::parse($reset->created_at)->addMinutes(10)->isPast()) {
            return response()->json(['error' => 'This code has expired. Please request a new one.'], 400);
        }

        try {
            // Create User
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'role' => $data['role'],
            ]);

            DB::table('password_reset_tokens')->where('email', $data['email'])->delete();
            session()->forget('registration_data');
            Auth::login($user);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Could not create account: ' . $e->getMessage()], 500);
        }
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'role' => 'required|string|in:patient,admin',
        ]);

        $credentials = $request->only('email', 'password', 'role');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }

        return back()->withErrors([
            'email' => 'Invalid credentials or role for this portal.',
        ])->onlyInput('email');
    }

    public function sendLoginOtp(Request $request)
    {
        try {
            $request->validate(['email' => 'required|email']);
            $user = User::where('email', $request->email)->first();

            if (!$user) {
                return response()->json(['error' => 'No account found with this email.'], 404);
            }

            $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
            
            DB::table('password_reset_tokens')->updateOrInsert(
                ['email' => $request->email],
                ['token' => Hash::make($otp), 'created_at' => Carbon::now()]
            );

            Mail::raw("Your JeevanSetu login code is: $otp", function ($message) use ($request) {
                $message->to($request->email)->subject('Login OTP - JeevanSetu');
            });

            session(['login_email' => $request->email]);
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Server Error: ' . $e->getMessage()], 500);
        }
    }

    public function verifyLoginOtp(Request $request)
    {
        $request->validate(['otp' => 'required|string|size:6']);
        $email = session('login_email');

        if (!$email) {
            return response()->json(['error' => 'Login session expired.'], 400);
        }

        $reset = DB::table('password_reset_tokens')->where('email', $email)->first();

        if (!$reset || !Hash::check($request->otp, $reset->token)) {
            return response()->json(['error' => 'Invalid OTP.'], 400);
        }

        $user = User::where('email', $email)->first();
        Auth::login($user);
        
        DB::table('password_reset_tokens')->where('email', $email)->delete();
        session()->forget('login_email');

        return response()->json(['success' => true]);
    }

    public function sendOtp(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['error' => 'No account found with this email.'], 404);
        }

        // Generate a real 6-digit random OTP
        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        
        // Store or update the OTP in password_reset_tokens table
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            [
                'token' => Hash::make($otp),
                'created_at' => Carbon::now()
            ]
        );

        // Send the real email (will be logged to storage/logs/laravel.log)
        try {
            Mail::raw("Your JeevanSetu password reset OTP is: $otp. This code will expire in 10 minutes.", function ($message) use ($request) {
                $message->to($request->email)
                        ->subject('Password Reset OTP - JeevanSetu');
            });
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to send email. Please try again later.'], 500);
        }

        return response()->json(['success' => true, 'message' => 'OTP has been sent to your email address!']);
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|string|size:6',
            'email' => 'required|email'
        ]);
        
        $reset = DB::table('password_reset_tokens')
                    ->where('email', $request->email)
                    ->first();

        if (!$reset || Carbon::parse($reset->created_at)->addMinutes(10)->isPast()) {
            return response()->json(['error' => 'OTP expired or not found. Please request a new one.'], 400);
        }

        if (Hash::check($request->otp, $reset->token)) {
            // Store verified email in session for the next step
            session(['verified_email' => $request->email]);
            return response()->json(['success' => true]);
        }

        return response()->json(['error' => 'Invalid OTP. Please try again.'], 400);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:4|confirmed',
        ]);

        $email = session('verified_email');
        
        if (!$email) {
            return response()->json(['error' => 'Session expired. Please restart the process.'], 400);
        }

        $user = User::where('email', $email)->first();

        if ($user) {
            $user->update(['password' => Hash::make($request->password)]);
            
            // Cleanup
            DB::table('password_reset_tokens')->where('email', $email)->delete();
            session()->forget('verified_email');
            
            return response()->json(['success' => true]);
        }

        return response()->json(['error' => 'User not found.'], 404);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }
}
