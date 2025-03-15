<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;  
use Illuminate\Http\Request;
use App\Models\Accounts;
use Illuminate\Support\Facades\Hash;

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
            'email' => 'required|string|max:255',
            'sous_direction' => 'required|string|max:255',
            'code_generated' => 'required|min:6', // Requires password_confirmation field
            'post_occupe' => 'required|string|max:255',
            'privilege' => 'required|string|max:255',
            'profile_picture' => 'nullable|mimes:jpg,png,jpeg,pdf|max:2048', // Validate image

        ]);
        //dd($validated);
        if ($request->hasFile('profile_picture')) {
            $filePath = $request->file('profile_picture')->store('profile_pictures', 'public');
        } else {
            $filePath = null;
        }
        // ✅ Insert data into the database
        $email = $validated['email'];
        $uniqueId = substr(base_convert(md5($email), 16, 36), 0, 6);
        $account = Accounts::create([
            'id'=>$uniqueId,
            'nome' => $validated['nome'],
            'prenom' => $validated['prenom'],
            'sous_direction' => $validated['sous_direction'],
            'email' => $validated['email']."@mcomm.local",
            'code_generated' => Hash::make($validated['code_generated']), // Hash the password
            'post_occupe' => $validated['post_occupe'],
            'privilege' => $validated['privilege'],
        ]);
        
        $file=$request->file('profile_picture');
            if($account)
            {
                    $media= DB::table('multimedia')->insert([
                    'nom_fichier' => $file->getClientOriginalName(),
                    'filepath' => $filePath,
                    'filetype' => $file->getClientMimeType(),
                    'size' => $file->getSize(),
                    'date_upload'=>now(),
                    'uploaded_by' => 1, // Assurez-vous que l'utilisateur est connecté
                    'related_id' => $account->id,
      
                ]);
                if($media)
                {
                    return response()->json(['message' => 'Account created successfully!', 'account' => $account], 201);
                }
            }
            return response()->json(['message' => 'Account created unsuccessfully!'], 404);
        
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
