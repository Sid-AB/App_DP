<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;  
use Illuminate\Http\Request;
use App\Models\Accounts;
use App\Models\SousProgramme;
use App\Models\Programme; 
use App\Models\Action;

use App\Models\Ministre;
use App\Models\Respo_Action;
use App\Models\Respo_Prog;

use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //
   public function index(Request $request)
    {
        $account=null;
        if(isset($request['idedit']))
        {
        //dd($request);
        $account=Accounts::select('nome','prenom','email','post_occupe','sous_direction','privilege','num_action','nom_action_ar','num_sous_prog','num_prog')
        //->join('multimedia','multimedia.related_id','=','id')
        ->join('actions','actions.id_ra','=','accounts.id_min')
        ->join('programmes','programmes.id_rp','=','accounts.id_min')
        ->where('id',$request['idedit'])
        ->first();
            
        if(!isset($account))
        {
            $account=Accounts::join('actions','actions.id_ra','=','accounts.id_ra')
            //->join('multimedia','multimedia.related_id','=','id')
            ->select('nome','prenom','email','post_occupe','sous_direction','privilege','num_action','nom_action_ar','num_sous_prog','accounts.id_ra')
            //->join('programmes','programmes.id_rp','=','accounts.id_rp')
            ->where('id',$request['idedit'])
            ->first();
            if(!isset($account))
            {
                $account=Accounts::select('nome','prenom','email','post_occupe','sous_direction','privilege','num_prog','accounts.id_rp')
                //->join('multimedia','multimedia.related_id','=','id')
                //->join('actions','actions.id_ra','=','accounts.id_ra')
                ->join('programmes','programmes.id_rp','=','accounts.id_rp')
                ->where('id',$request['idedit'])
                ->first();
                if(!isset($account))
                {
                    $account=Accounts::select('nome','prenom','email','post_occupe','sous_direction','privilege',)
                //->join('multimedia','multimedia.related_id','=','id')
                //->join('actions','actions.id_ra','=','accounts.id_ra')
                //->join('programmes','programmes.id_rp','=','accounts.id_rp')
                ->where('id',$request['idedit'])
                ->first();
                }
            }

        }
        //$resact=Action::where('id_ra',$account->id_ra)->get();
          //dd( $account);
        }
        else
        {
           
        }
        $prog=Programme::get();
        $sprog=SousProgramme::get();
        $act=Action::get();
        $accounts=Accounts::get();
        //dd($accounts);
        if(isset($accounts) && count($accounts) == 0)
        {
            $accounts=Accounts::get();
        }
        return view('Admin.index',compact('accounts','prog','sprog','act','account'));
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
            'progs'=>'nullable|string|max:255',
            'sous_progs'=>'nullable|string|max:255',
            'acts'=>'nullable|string|max:255',
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
        $idresp= rand(100000, 999999);
        $id_res_Min=null;
        $id_res_prg=null;
        $id_res_act=null;
        if(isset($validated['progs']) && isset($validated['sous_progs'])  && !isset($validated['acts']))
        {
            $res_prg=Respo_Prog::updateOrCreate([
                'id_rp'=>$idresp,
                'Date_installation_rp'=>Carbon::now(),
               
            ]);
            $id_res_prg=$res_prg->id_rp;
            $prog=Programme::where('num_prog',$validated['progs'])->first();
            $prog->id_rp=$id_res_prg;
            $prog->update();
           // $act->update();
           // $sous_prog=SousProgramme::where('num_sous_prog',$validated['sous_progs'])->first();
            //$act=Action::where('num_action',isset($validated['acts']))->first();
            //dd($res_prg);
        }
        if(!isset($validated['progs'])  && !isset($validated['sous_progs']) && isset($validated['acts']))
        {
            $res_act=Respo_Action::updateOrCreate([
                'id_ra'=>$idresp,
                'Date_installation_ra'=>Carbon::now(),
               
            ]);
            $id_res_act=$res_act->id_ra;
           // $prog=Programme::where('num_prog',$validated['progs'])->first();
           // $sous_prog=SousProgramme::where('num_sous_prog',$validated['sous_progs'])->first();
            $act=Action::where('num_action',$validated['acts'])->first();
            $act->id_ra=$id_res_act;
          //  $prog->update();
            $act->update();
           // dd($res_act);
        }

        if(isset($validated['progs']) && isset($validated['sous_progs'])  && isset($validated['acts']))
        {
            $res_Min=Ministre::updateOrCreate([
                'id_min'=>$idresp,
                'Date_installation'=>Carbon::now(),
            ]);
            $res_act=Respo_Action::updateOrCreate([
                'id_ra'=>$idresp,
                'Date_installation_ra'=>Carbon::now(),
               
            ]);
            $res_prg=Respo_Prog::updateOrCreate([
                'id_rp'=>$idresp,
                'Date_installation_rp'=>Carbon::now(),
               
            ]);
            $id_res_Min=$res_Min->id_min;
            $prog=Programme::where('num_prog',$validated['progs'])->first();
           // $sous_prog=SousProgramme::where('num_sous_prog',$validated['sous_progs'])->first();
            $act=Action::where('num_action',$validated['acts'])->first();
           // dd($act);
            $prog->id_rp=$id_res_Min;
            $act->id_ra=$id_res_Min;
            $prog->update();
            $act->update();
           // dd($res_Min->id_min);
        }
        $account = Accounts::where('email',$validated['email']."@mcomm.local");
       // dd($account);
        if($account)
        {
            $account->update([
               
                'nome' => $validated['nome'],
                'prenom' => $validated['prenom'],
                'sous_direction' => $validated['sous_direction'],
              
                'id_min'=>$id_res_Min,
                'id_ra'=>$id_res_act,
                'id_rp'=>$id_res_prg,
                'code_generated' => Hash::make($validated['code_generated']), // Hash the password
                'post_occupe' => $validated['post_occupe'],
                'privilege' => $validated['privilege'],
            ]);
            $account=$account->first();
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
                    return back()->with('success', 'update registered successfully!');
                }
            }
        }else
        {$account = Accounts::updateOrCreate([
            'id'=>$uniqueId,
            'nome' => $validated['nome'],
            'prenom' => $validated['prenom'],
            'sous_direction' => $validated['sous_direction'],
            'email' => $validated['email']."@mcomm.local",
            'id_min'=>$id_res_Min,
            'id_ra'=>$id_res_act,
            'id_rp'=>$id_res_prg,
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
                    return back()->with('success', 'User registered successfully!');
                }
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
    //dd( $request);
        $mail= $request['email'];
    $user = Accounts::where('email', $mail)->first();
//dd($user);
    if (!$user || !Hash::check($request->code_generated, $user->code_generated)) {
        return response()->json(['error' => 'Invalid credentials','code'=>401], 401);
    }

    return response()->json([
        'message' => 'Login successful!',
        'account' => $user->code_generated, // If using Laravel Sanctum
    ]);
}
    function delete_account($id)
    {
        $account=Accounts::find($id);
        if($account)
        {
            $account->delete();
            return back()->with('success', 'User deleted successfully!');
        }
        return back()->with('unsuccess', 'User deleted unsuccessfully!');
    }
}
