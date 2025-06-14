
<?php

use App\Models\Portefeuille;
use App\Models\Programme;
use App\Models\Action;
use App\Models\SousProgramme;
use App\Models\Fonctions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\portfeuilleController;
use App\Http\Controllers\programmeControlleur;
use App\Http\Controllers\sousProgrammeController;
//use App\Http\Controllers\initPortController;
use App\Http\Controllers\actionController;
use App\Http\Controllers\sousActionController;
use App\Http\Controllers\groupOperationController;
use App\Http\Controllers\opeartionController;
use App\Http\Controllers\sousOperationController;
use App\Http\Controllers\modificationController;
use App\Http\Controllers\EmploiBudgetController;
//use App\Http\Controllers\FonctionController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PrimeController;

Route::get('/', function () {
 $portfs =Portefeuille::get();
    return view('welcome',compact('portfs'));
});
Route::get('/testing',function (){
return view('test.carsoule');
});

//===============ROUTE PORTEFEUILLE==============================
Route::controller(portfeuilleController::class)->group(function(){
    Route::get('/Portfail/{id}','affich_portef')->name('home.portfail');
    Route::get('/Form','form_portef')->name('form.portfail'); //afficher formulaire d ajout
    Route::post('/creation','creat_portef')->name('creation.portfail');
    Route::get('/creation/from/{path}','show_prsuiv')->name('creation.show_prsuiv');
    Route::get('/check-portef','check_portef')->name('check.portfail');
    Route::post('/upload-pdf', 'uploadPDF')->name('upload.pdf');
    Route::get('/live-pdf/{id}', 'live_File')->name('live.pdf');
    Route::get('/check-pdf/{id}','check_file')->name('checke.pdf');
});

//===============ROUTE PROGRAMME==============================
Route::controller( programmeControlleur::class)->group(function(){
    Route::get('/Programme/{num_portefeuil}','affich_prog')->name('home.programme');
    Route::post('/creationProg','creat_prog')->name('creation.programme');
    Route::get('/check-prog','check_prog')->name('check.prog');


});

//===============ROUTE SOUS PROGRAMME==============================
Route::controller(sousProgrammeController::class)->group(function(){
    Route::get('/SousProgramme','affich_sou_prog')->name('home.sousProgramme');
    Route::post('/creationSousProg','create_sou_prog')->name('creation.souProgramme');
    Route::get('/check-sousprog','check_sous_prog')->name('check.sousprog');
    Route::get('/progrma_from_sous/{num_sous_prog}','getprog')->name('get.program');

});



//===============ROUTE ACTION==============================
Route::controller(actionController::class)->group(function(){
    Route::get('/Action','affich_action')->name('action.detail');
    Route::get('/Action/{id}','affich_action')->name('actikon');
    Route::post('/creationAction','create_action')->name('creation.action');
    Route::get('/check-action','check_action')->name('check.action');

});

//===============ROUTE SOUS ACTION==============================
Route::controller(sousActionController::class)->group(function(){
    Route::post('/creationsousAction','create_sousaction')->name('creation.sousaction');
    Route::get('/allaction/{numport}','allact')->name('action.lists');
    Route::get('/printdpic/{numport}','printdpic')->name('print-dpic.lists');
    Route::get('/printDPA/{numport}','print_dpa')->name('print-dpa.lists');
    Route::get('/test_print','print_test')->name('print-dpa.listss');
    Route::get('/check-sousaction','check_sousaction')->name('check.sousaction');
    Route::get('/convert/{numport}','showConvertPage')->name('convert');

});

//===============ROUTE GROUPE D'OPERATIONS==============================
Route::controller(groupOperationController::class)->group(function(){
   Route::get('/testing/S_action/{port}/{prog}/{sous_prog}/{act}/{s_act}/{T}', 'insertDPA');

});

//===============ROUTE  OPERATION==============================
Route::controller(opeartionController::class)->group(function(){
    Route::get('/testing/Ss_Action/{port}/{prog}/{sous_prog}/{act}/{s_act}', 'calculerEtEnvoyer');
    Route::get('/testing/S_action/{port}/{s_act}/{T}', 'afficherDPIA');



    Route::get('/testing/S_action/{s_act}', 'afficherDPIAWithoutT');
    Route::get('/testing/codeSousOperation/{s_act}', 'checkSousOperationExist');
   // Route::get('/testing/Action/{port}/{prog}/{sous_prog}/{act}', 'calculerEtEnvoyer');
});

//===============ROUTE SOUS OPERATION==============================
Route::controller(sousOperationController::class)->group(function(){
    Route::get('/testing/Action/{port}/{prog}/{sous_prog}/{act}/','AffichePortsAction');
    Route::get('/testing/S_action/{port}/{prog}/{sous_prog}/{act}/{s_act}','AffichePortsSousAct');
    Route::get('/testing/{port}/{prog}/{sous_prog}/{act}/{s_act}/pdf','impressionpdf');
    Route::get('/testing/{port}/{prog}/{sous_prog}/{act}/pdf','impressionpdf');
    Route::get('/opsinfo/{id}','getdef_sop');
    Route::get('/DPC/modif/{id}','modif_handler')->name('modif-handler');
});
//===============ROUTE modification==============================
Route::controller(modificationController::class)->group(function(){
    Route::post('/update','updateSousOperation');
    Route::post('/updateModif','insertModif');
    Route::get('/affiche_transacation/{numport}','affiche_modif')->name('affich-trans');
    Route::get('/delete_from_portfeuille/{id}','delete_by_id')->name('Delete-trans');
    Route::post('/viderTab','delete_by_t')->name('Delete_T_tab');
    Route::get('/validate_modif/{id}','update_status')->name('validate.modification');
    


});
/*Route::controller(initPortController::class)->group(function(){
    Route::post('/init_ports','create_sou_prog')->name('init.ports');

});*/

Route::controller(EmploiBudgetController::class)->group(function(){
    Route::post('/insertemploi','insertemploi')->name('insertemploi');
    Route::get('/impression_emplois_budgetaire',  'index');
    Route::get('/printallemploi/{id}', 'printallemploi')->name('emplois.pdf');
    Route::get('/getlist_PostSup/{id}','get_list_postsup')->name('emplois.Post_Sup');
    Route::get('/getlist_PostCommuns/{id}','get_list_post_communs')->name('emplois.post_communs');
    Route::get('/getlist_fonctions/{id}','get_list_fonction')->name('emplois.fonctions');
    Route::get('/getlist_cdi/{id}','get_list_cdi')->name('emplois.cdi');
    Route::get('/getlist_cdd/{id}','get_list_cdd')->name('emplois.cdd');
    Route::get('/get_list_OAC/{id}','get_list_OAC')->name('emplois.oac');
    Route::get('/printlist_fonctions/{id}','print_list_fonction')->name('emplois.printfonctions');
    Route::get('/printlist_posts/{id}','print_list_postsup')->name('emplois.printposts');
    Route::get('/printlist_commun/{id}','print_list_post_communs')->name('emplois.printcommun');

    Route::get('/printlist_oap/{id}','print_list_OAP')->name('emplois.printoap');
    Route::get('/printlist_cdd/{id}','print_list_CDD')->name('emplois.printcdd');
    Route::get('/printlist_cdi/{id}','print_list_CDI')->name('emplois.printcdi');

    Route::post('/del_emplois','del_emplois')->name('emplois.delete');

});


/*Route::controller(FonctionController::class)->group(function(){
    Route::get('/listeFct','get_list_fonction')->name('list_fct');

});*/


Route::controller(AdminController::class)->group(function(){
    Route::post('/login', function (Request $request) {
        $credentials = $request->only('name', 'password');
    
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('Admin');
        }
    
        return back()->with('error', 'Nom d\'utilisateur ou mot de passe incorrect.');
    })->name('login');
    Route::post('/login/account','access_login')->name('access_login');
    Route::middleware(['auth'])->group(function () {
        
        Route::get('/admin','index')->name('Admin');
        
        Route::get('/admin/delete/{id}','delete_account')->name('delete.account');
        Route::get('/admin/responsable/{id}','get_responsable')->name('get_responsable.account');
        Route::post('/insert/account','insert_account')->name('account_insertion');
       
        Route::get('/get-accounts','get_respo_acc')->name('get_respo_acc');
        Route::get('/update/pass','indexupdate')->name('passhander');
        Route::post('/update/login','update_pass')->name('password_update');
        });
});

//===============ROUTE Prime==============================
Route::put('/prime/{id}', [PrimeController::class, 'update']);


/*Route::get('/testing/Action/{port}/{prog}/{sous_prog}/{act}/',function ($port,$prog,$sous_prog,$act){



        return view('Action-in.index',compact('port','prog','sous_prog','act'));
        });

        //affiche les portes
       Route::get('/testing/S_action/{port}/{prog}/{sous_prog}/{act}/{s_act}/',function ($port,$prog,$sous_prog,$act,$s_act){



            return view('Action-in.index',compact('port','prog','sous_prog','act','s_act'));
            });
*/
