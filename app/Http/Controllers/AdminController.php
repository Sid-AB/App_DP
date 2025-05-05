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
        $full_account=[];
        if(isset($request['idedit']))
        {
        //dd($request); 'id_deleg_resp'=>'nullable'
        $account=Accounts::select('nome','prenom','email','post_occupe','sous_direction','privilege','num_action','nom_action_ar','num_sous_prog','num_prog','id_deleg_resp')
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
          //dd( $account)
      }
        else
        {
           
        }
        $prog=Programme::get();
        $sprog=SousProgramme::get();
        $act=Action::get();
        $accounts=Accounts::get();
        foreach($accounts as $accnt)
        {
            $accountz=Accounts::select('nome','prenom','email','post_occupe','sous_direction','privilege','num_action','nom_action_ar','num_sous_prog','num_prog','id_deleg_resp')
        //->join('multimedia','multimedia.related_id','=','id')
        ->join('actions','actions.id_ra','=','accounts.id_min')
        ->join('programmes','programmes.id_rp','=','accounts.id_min')
        ->where('id',$accnt->id)
        ->first();
        if(!isset($accountz))
        {
            $accountz=Accounts::from('accounts as a1')->join('accounts as a2','a1.id_deleg_resp','=','a2.id')
            ->join('actions','actions.id_ra','=','a2.id_ra')
            ->select('a1.nome','a1.prenom','a1.email','a1.post_occupe','a1.sous_direction','a1.privilege','num_action','nom_action_ar','nom_action','a1.id','a1.id_deleg_resp','a2.nome as delege_nome','a2.prenom as delege_prenom')
            ->where('a1.id',$accnt->id)
            ->first();
             if(!isset($accountz->id_deleg_resp))
            {
                $accountz=Accounts::from('accounts')
                ->join('actions','actions.id_ra','=','accounts.id_ra')
                ->select('nome','prenom','email','post_occupe','sous_direction','privilege','num_action','nom_action_ar','nom_action','id')
                ->where('id',$accnt->id)
                ->first();
            }
            if(!isset($accountz))
            {
                $accountz=Accounts::from('accounts as a1')->join('accounts as a2','a1.id_deleg_resp','=','a2.id')
                
                //->join('multimedia','multimedia.related_id','=','id')
                //->join('actions','actions.id_ra','=','accounts.id_ra')
                ->join('programmes','programmes.id_rp','=','a1.id_rp')
                ->select('a1.nome','a1.prenom','a1.email','a1.post_occupe','a1.sous_direction','a1.privilege','num_prog','a1.id_rp','nom_prog','num_prog','a1.id','a1.id_deleg_resp','a2.nome as delege_nome','a2.prenom as delege_prenom')
                ->where('a1.id',$accnt->id)
                ->first();
                    if(!isset($accountz))
                    {
                        $accountz=Accounts::from('accounts as a1')
                        //->join('multimedia','multimedia.related_id','=','id')
                        //->join('actions','actions.id_ra','=','accounts.id_ra')
                        ->join('programmes','programmes.id_rp','=','a1.id_rp')
                        ->select('a1.nome','a1.prenom','a1.email','a1.post_occupe','a1.sous_direction','a1.privilege','num_prog','a1.id_rp','nom_prog','num_prog','a1.id','a1.id_deleg_resp')
                        ->where('a1.id',$accnt->id)
                        ->first();
                    }
                if(!isset($accountz))
                {
                    $accountz=Accounts::from('accounts as a1')->join('accounts as a2','a1.id_deleg_resp','=','a2.id')
                    //->select('nome','prenom','email','post_occupe','sous_direction','privilege','num_portefeuil','id','id_deleg_resp')
                    ->select('a1.nome','a1.prenom','a1.email','a1.post_occupe','a1.sous_direction','a1.privilege','num_portefeuil','a1.id','a1.id_deleg_resp','a2.nome as delege_nome','a2.prenom as delege_prenom')

                //->join('actions','actions.id_ra','=','accounts.id_ra')
                //->join('programmes','programmes.id_rp','=','accounts.id_rp')
                    ->join('portefeuilles','portefeuilles.id_min','=','a1.id_min')
                    ->where('a1.id',$accnt->id)
                    ->first();
                    if(!isset($accountz))
                    {
                        $accountz=Accounts::where('id',$accnt->id)
                        ->first();
                    }
                }
            }
        }
        array_push($full_account,$accountz);
    }
       
        //dd($full_account);
       /*
       Accounts::from('accounts as a1')->join('accounts as a2','a1.id_deleg_resp','=','a2.id')
                                ->select('a1.id','a1.nome','a1.prenom','a2.nome as name_delege','a2.prenom as prenom_delege')
                                ->whereNull('a2.id_deleg_resp')->get();
       */
        if(isset($accounts) && count($accounts) == 0)
        {
            $accounts=Accounts::get();
        }
        return view('Admin.index',compact('full_account','prog','sprog','act','account'));
    }


    public function insert_account(Request $request)
    {
        // ✅ Validate the request
       // dd($request);
       
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
            'id_deleg_resp'=>'nullable',
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
        $uniqueId = hexdec(substr(base_convert(md5($email), 16, 36), 0, 6));
        $idresp= rand(100000, 999999);
        $id_res_Min=null;
        $id_res_prg=null;
        $id_res_act=null;
        $deleg=null;
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


        if(isset($validated['progs']) && !isset($validated['sous_progs'])  && !isset($validated['acts']))
        {
            $res_act=Respo_Action::updateOrCreate([
                'id_ra'=>$idresp,
                'Date_installation_ra'=>Carbon::now(),
               
            ]);
            $res_prg=Respo_Prog::updateOrCreate([
                'id_rp'=>$idresp,
                'Date_installation_rp'=>Carbon::now(),
               
            ]);
            $id_res_prg=$res_prg->id_rp;
            $id_res_act=$res_act->id_ra;
            $prog=Programme::where('num_prog',$validated['progs'])->first();
           // $sous_prog=SousProgramme::where('num_sous_prog',$validated['sous_progs'])->first();
            //$act=Action::where('num_action',$validated['acts'])->first();
            //dd($prog,$act);
            $prog->id_rp=$id_res_prg;
            //$act->id_ra=$id_res_act;
            $prog->update();
            //$act->update();
           // dd($res_Min->id_min);
        }


        if(isset($validated['progs']) && isset($validated['sous_progs'])  && isset($validated['acts']))
        {
            $res_act=Respo_Action::updateOrCreate([
                'id_ra'=>$idresp,
                'Date_installation_ra'=>Carbon::now(),
               
            ]);
            $res_prg=Respo_Prog::updateOrCreate([
                'id_rp'=>$idresp,
                'Date_installation_rp'=>Carbon::now(),
               
            ]);
            $id_res_prg=$res_prg->id_rp;
            $id_res_act=$res_act->id_ra;
            $prog=Programme::where('num_prog',$validated['progs'])->first();
           // $sous_prog=SousProgramme::where('num_sous_prog',$validated['sous_progs'])->first();
            $act=Action::where('num_action',$validated['acts'])->first();
           // dd($prog,$act);
            $prog->id_rp=$id_res_prg;
            $act->id_ra=$id_res_act;
            $prog->update();
            $act->update();
           // dd($res_Min->id_min);
        }
        $account = Accounts::where('email',$validated['email']."@mcomm.local")->first();

        if(isset($account))
        {       // dd($account,$id_res_prg);
            if(isset($account->id_min))
            {
                $id_res_Min=$account->id_min;
                $validated['privilege']=0;
            }
            if(isset($validated['id_deleg_resp']))
            {
                $deleg=$validated['id_deleg_resp'];
            }
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
                'id_deleg_resp'=> $deleg
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
        {
           // dd($account,$uniqueId);
            $account = Accounts::updateOrCreate([
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
            'id_deleg_resp'=> $deleg
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
    
    if (!$user || !Hash::check($request->code_generated, $user->code_generated)) {
        //dd($user);
        return response()->json(['error' => 'Invalid credentials','code'=>401], 401);
    }
    if($user->update_code == 0)
    {
        //dd($user);
        $mail= $request['email'];
        return response()->json([
            'code'=>201,
            'message' => 'Login update!',
            'code_generated'=>$user->code_generated,
            'account' => $mail, // If using Laravel Sanctum
        ]);
    }
    return response()->json([
        'code'=>200,
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

    public function get_responsable($id)
    {
        $account=Accounts::select('nome','prenom','email','post_occupe','sous_direction','privilege','num_action','nom_action_ar','num_sous_prog','num_prog')
        //->join('multimedia','multimedia.related_id','=','id')
        ->join('actions','actions.id_ra','=','accounts.id_min')
        ->join('programmes','programmes.id_rp','=','accounts.id_min')
        ->where('id',$id)
        ->first();
            
        if(!isset($account))
        {
            $account=Accounts::join('actions','actions.id_ra','=','accounts.id_ra')
            //->join('multimedia','multimedia.related_id','=','id')
            ->select('nome','prenom','email','post_occupe','sous_direction','privilege','num_action','nom_action_ar','num_sous_prog','accounts.id_ra')
            //->join('programmes','programmes.id_rp','=','accounts.id_rp')
            ->where('id',$id)
            ->first();
            if(!isset($account))
            {
                $account=Accounts::select('nome','prenom','email','post_occupe','sous_direction','privilege','num_prog','accounts.id_rp','nom_prog','num_prog')
                //->join('multimedia','multimedia.related_id','=','id')
                //->join('actions','actions.id_ra','=','accounts.id_ra')
                ->join('programmes','programmes.id_rp','=','accounts.id_rp')
                ->where('id',$id)
                ->first();
              
                if(!isset($account))
                {
                    $account=Accounts::select('nome','prenom','email','post_occupe','sous_direction','privilege','num_portefeuil')
                //->join('multimedia','multimedia.related_id','=','id')
                //->join('actions','actions.id_ra','=','accounts.id_ra')
                //->join('programmes','programmes.id_rp','=','accounts.id_rp')
                ->join('portefeuilles','portefeuilles.id_min','=','accounts.id_min')
                ->where('id',$id)
                ->first();
                }
            }

        }
        else
        {
            return response()->json(['code'=>404,'message'=>'not Trouve']);
        }
        //dd($account);
        return response()->json(['code'=>200,'message'=>'Trouve','data'=>$account]);
        //$resact=Action::where('id_ra',$account->id_ra)->get();
          //dd( $account);
          
        }
        function get_respo_acc()
        {
            $accounts=Accounts::select('id','nome','prenom')->whereNull('id_deleg_resp')->get();
            if(isset($accounts))
            {
                return response()->json(['message'=>'success','code'=>200,'data'=>$accounts]);
            }
            return response()->json(['message'=>'unsuccess','code'=>404,]);
        }



        public function update_pass(Request $request)
        {

            //App::setLocale(Session::get('locale', config('app.locale')));
            // Valider les données de la requête
           
            $request->validate([
                'mail'=>'required|string',
                'code'=>'required|string',
                'code_portfail'=>'string',
                'current_password' => 'required|string',
                'new_password' => 'required|confirmed|min:5',
               
            ]);
            $user = Accounts::where('email', $request->mail)->where('code_generated', $request->code)->first();
            // Vérifier le mot de passe actuel
            if (!Hash::check($request->current_password, $user->code_generated)) {
               
                return back()->withErrors(['current_password' =>'Vérifier votre Mot de passe']);
            }
           
            // Mettre à jour le mot de passe
            if ($user->update_code == 1) {
                return back()->withErrors(['error' => 'Le mot de passe ne peut être mise à jour qu\'une seule fois']);
            } else {
               
                $user->code_generated = Hash::make($request->new_password);
                $user->password_changed_at = now();
                $user->update_code += 1;
                $user->save();
              
                // Déconnecter l'utilisateur
                //Auth::logout();
        
                // Rediriger avec un message de succès
                return redirect()->to('/')->with('success', 'Mot de passe mis à jour avec succès');
            }
    }
    public function indexupdate(Request $request)
   {        
    $code=$request['code'];
    $mail=$request['mail'];
    return view('Admin.updatePassword',compact('code','mail'));
   }   
}
