<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function show()
    {
        return view('auth.register');
    }

   public function store(Request $request)
    {
        // 1. Validation
        $request->validate([
            'title'    => 'required|string',
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'phone'    => 'required|string|max:20',
            'group'    => 'required|string|max:255',
            'church'   => 'required|string|max:255',
            'cell'     => 'required|string|max:255',
            'password' => 'required|min:8|confirmed',
        ]);

        // 2. Generate the unique membership code
        $randomNumber = rand(1000, 9999);
        $randomLetter = strtoupper(Str::random(1));
        $generatedCode = "CELZ5-{$randomNumber}-{$randomLetter}";

        // 3. Create User
        $user = User::create([
            'title'                 => $request->title,
            'name'                  => $request->name,
            'email'                 => $request->email,
            'phone'                 => $request->phone,
            'group'                 => $request->group,
            'church'                => $request->church,
            'cell'                  => $request->cell,
            'password'              => Hash::make($request->password),
            'membership_code'       => $generatedCode,
            'member_id'             => $generatedCode,
            'qr_code_data'          => $generatedCode,
            'notifications_enabled' => true,
        ]);

        // 4. Log the user in
        Auth::login($user);

        // 5. Success Message & Redirect
        return redirect()->route('profile.edit')->with('success', 'Welcome! Your membership ID ' . $generatedCode . ' has been created.');
    }


    public function destroy()
    {
        $user = Auth::user();
        Auth::logout();

        if ($user) {
            $user->delete();
        }

        return redirect('/')->with('message', 'Account deleted.');
    }
}
