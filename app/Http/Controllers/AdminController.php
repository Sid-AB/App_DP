<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;  
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
   public function index()
    {
        return view('Admin.index');
    }


    public function insert_account(Request $request)
    {
        // ✅ Validate the request
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:accounts,email',
            'sous_direction' => 'required|string|max:255',
            'code_generated' => 'required|min:6|confirmed', // Requires password_confirmation field
            'post_occupe' => 'required|string|max:255',
            'privilege' => 'required|string|max:255',
        ]);

        // ✅ Insert data into the database
        $account = Account::create([
            'nome' => $validated['nome'],
            'prenom' => $validated['prenom'],
            'sous_direction' => $validated['sous_direction'],
            'email' => $validated['email'],
            'code_generated' => Hash::make($validated['code_generated']), // Hash the password
            'post_occupe' => $validated['post_occupe'],
            'privilege' => $validated['privilege'],
        ]);

        return response()->json(['message' => 'Account created successfully!', 'account' => $account], 201);
    }

    public function access_login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'code_generated' => 'required'
    ]);
        $code= Hash::make($validated['code_generated']);
    $user = Account::where('code_generated', $code)->first();

    if (!$user || !Hash::check($request->code_generated, $user->code_generated)) {
        return response()->json(['error' => 'Invalid credentials'], 401);
    }

    return response()->json([
        'message' => 'Login successful!',
        'account' => $user,
        'token' => $user->createToken('AuthToken')->plainTextToken, // If using Laravel Sanctum
    ]);
}
    
}
