<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\DepartementController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\CycleController;
use App\Http\Controllers\BanqueController;
use App\Http\Controllers\ContratController;
use App\Http\Controllers\UniversiteController;
use App\Http\Controllers\UeController;
use App\Http\Controllers\UfrController;
use App\Http\Controllers\EnseignantController;
use App\Http\Controllers\EcueController;
use App\Http\Controllers\FiliereController;
use App\Http\Controllers\ProgrammationController;
use App\Http\Controllers\CoursController;
use App\Http\Controllers\FrontendController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', [FrontendController::class, 'index'])->name('index');
Route::get('/inscription', [FrontendController::class, 'ifu'])->name('ifu');
Route::post('/inscription/informations', [FrontendController::class, 'informations'])->name('informations');
Route::post('/inscription/confirmation', [FrontendController::class, 'confirmation'])->name('confirmation');

Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/', [AdminController::class,'index'])->name('dashboard');
    Route::get('/cahier/create/{ecue}/{programmation_id}', [ClasseController::class, 'cahierCreate'])->name('cahier.create')->where('programmation_id', '.*');
    Route::get('/cahier/edit/{cahier_id}', [ClasseController::class, 'cahierEdit'])->name('cahier.edit')->where('cahier_id', '.*');
    Route::get('/cahier/destroy/{cahier_id}', [ClasseController::class, 'cahierDestroy'])->name('cahier.destroy')->where('cahier_id', '.*');
    Route::post('/cahier/update/{cahier_id}', [ClasseController::class, 'cahierUpdate'])->name('cahier.update')->where('cahier_id', '.*');
    Route::get('/cahier/{ecue?}/{classe?}/{programmation_id?}', [ClasseController::class, 'cahier'])->name('cahier')->where('programmation_id', '.*');
    Route::post('/cahier/store', [ClasseController::class, 'cahierStore'])->name('cahier.store');
    Route::resources([
        "banques" => BanqueController::class,
        "cycles" => CycleController::class,
        "users" => UserController::class,
        "ufrs" => UfrController::class,
        "enseignants" => EnseignantController::class,
        'universites' => UniversiteController::class,
        "departements" => DepartementController::class,
        "classes" => ClasseController::class,
        "ues" => UeController::class,
        "ecues" => EcueController::class,
        "filieres" => FiliereController::class
    ]);

    Route::get('/generate-lettre-mission', [ContratController::class, 'generateLettreMission'])->name('generateLettreMission');

    Route::get('search-enseignant-by-npi', [EnseignantController::class, 'searchByNpi'])->name('enseignants.search');
    Route::post('find-enseignant-by-npi', [EnseignantController::class, 'findByNpi'])->name('find-by-npi');

    Route::controller(AjaxController::class)->group(function () {
        Route::post('/delete-banques', 'deleteBanques')->name('delete-banques');
        Route::post('/delete-universites', 'deleteUniversites')->name('delete-universites');
        Route::post('/delete-departements', 'deleteDepartements')->name('delete-departements');
        Route::post('/delete-classes', 'deleteClasses')->name('delete-classes');
        Route::post('/delete-ues', 'deleteUes')->name('delete-ues');
        Route::post('/delete-enseignants', 'deleteEnseignants')->name('delete-enseignants');
        Route::post('/delete-cycles', 'deleteCycles')->name('delete-cycles');
        Route::post('/delete-ecues', 'deleteEcues')->name('delete-ecues');
        Route::post('/delete-ufrs', 'deleteUfrs')->name('delete-ufrs');
        Route::post('/delete-filieres', 'deleteFilieres')->name('delete-filieres');
        Route::post('/delete-users', 'deleteUsers')->name('delete-users');
        Route::post('/selectAction', 'selectAction')->name('select');
    });

    Route::controller(ProgrammationController::class)->group(function () {
        Route::get('/programmations', 'index')->name('programmations.index');
        Route::get('/programmation/{classe}/show', 'show')->name('programmation.show');
        Route::get('/programmation/{classe}/edit', 'edit')->name('programmation.edit');
        Route::get('/programmation/programmer/{cours}', 'programmer')->name('programmation.programmer');
        Route::post('/programmation/update', 'update')->name('programmation.update');
        Route::get('/programmation/evaluations', 'evaluations')->name('programmation.evaluations');
        Route::post('/programmation/evaluations', 'evaluations')->name('programmation.post-evaluations');
        Route::get('/programmation/pdfProgrammation', 'generatePdf')->name('programmation.post-pdf');
    });

    Route::controller(CoursController::class)->group(function () {
        Route::get('/cours', 'index')->name('cours.index');
        Route::get('/cours/{classe}/show', 'show')->name('cours.show');
        Route::get('/cours/{classe}/edit', 'edit')->name('cours.edit');
        Route::get('/cours/create', 'create')->name('cours.create');
        Route::post('/cours/store', 'store')->name('cours.store');
        Route::post('/cours/copier', 'copier')->name('cours.copier');
        Route::get('/cours/transmettre', 'transmettre')->name('cours.transmettre');
        Route::get('/cours/post_transmettre', 'post_transmettre')->name('cours.post_transmettre');
    });

    Route::controller(ContratController::class)->group(function () {
        Route::get('/contrats', 'index')->name('contrats.index');
        Route::get('/contrats/create/{enseignant_id?}', 'create')->name('contrats.create')->where('enseignant_id', '.*');
        Route::get('/contrats/show/{enseignant_id?}', 'show')->name('contrats.show')->where('enseignant_id', '.*');
        Route::get('/contrats/edit/{contrat_id}', 'edit')->name('contrats.edit')->where('contrat_id', '.*');
        Route::post('/contrats/store', 'store')->name('contrats.store');
        Route::post('/contrats/update/{contrat_id}', 'update')->name('contrats.update');
        Route::get('/contrats/destroy/{contrat_id}', 'destroy')->name('contrats.destroy')->where('contrat_id', '.*');
        Route::get('/contrats/imprimer/{contrat_id}', 'imprimer')->name('contrats.imprimer')->where('contrat_id', '.*');
        Route::get('/contrats/telecharger/{contrat_id}', 'telecharger')->name('contrats.telecharger')->where('contrat_id', '.*');
    });
    Route::get('programmations/export', [ProgrammationController::class, 'export'])->name('programmations.export');

    Route::get('/changer-annee/{annee}', [AdminController::class, 'changeAnnee'])->name('changeAnnee');
    Route::get('/import', [AdminController::class,'import'])->name('import');
});
