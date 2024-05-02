<?php

namespace App\Http\Controllers;

use App\Exports\ProgrammationsExport;
use App\Models\Ue;
use Carbon\Carbon;
use App\Models\Ufr;
use App\Models\Ecue;
use App\Models\Cours;
use App\Models\Classe;
use Barryvdh\DomPDF\PDF;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\Programmation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Illuminate\Http\RedirectResponse;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use App\Http\Requests\ProgrammationStoreRequest;
use App\Http\Requests\ProgrammationUpdateRequest;
use Maatwebsite\Excel\Facades\Excel;


class ProgrammationController extends Controller
{
    public function index(Request $request): View
    {
        $user = Auth::user();
        if ($user->hasRole('Administrateur') ) {
            $classes = Classe::get();
        }else if( $user->hasRole('Ufr') ) {
            $classes = Classe::with('filiere.departement.ufr')->whereHas('filiere.departement', function ($query) use ($user) {
                $query->where('ufr_id', $user->ufr_id);
            })->get();
        }else{
            $classes = null;
        }
        return view('programmation.index', compact('classes'));
    }
    public function show(Classe $classe): View
    {
        return view('programmation.show', compact('classe'));
    }

    public function programmer($id): View
    {
        $cours = Programmation::find($id);
        return view('programmation.programmer', compact('cours'));
    }

    public function update(ProgrammationUpdateRequest $request): RedirectResponse
    {
        $cours = Programmation::find($request->cours);
        if($cours){
            $cours->montant=$cours->classe->cycle->montant;
            if($cours->ecue1){
                $cours->enseignant1 = $request->enseignant1;
                $cours->date_debut1 = $request->date_debut1 ? Carbon::createFromFormat('d/m/Y', $request->date_debut1)->format('Y-m-d') : null;
                $cours->date_fin1=$request->date_fin1 ? Carbon::createFromFormat('d/m/Y', $request->date_fin1)->format('Y-m-d') : null;
                $cours->plage_debut1 = $request->heure_debut1 ? $request->heure_debut1 : null;
                $cours->plage_fin1 = $request->heure_fin1 ? $request->heure_fin1 : null;
                $cours->date_composition1=$request->composition1 ? Carbon::createFromFormat('d/m/Y H:i', $request->composition1)->format('Y-m-d H:i') : null;
                $cours->salle1 = $request->salle1;
            }
            if($cours->ecue2){
                $cours->enseignant2 = $request->enseignant2;
                $cours->date_debut2 = $request->date_debut2 ? Carbon::createFromFormat('d/m/Y', $request->date_debut2)->format('Y-m-d') : null;
                $cours->date_fin2=$request->date_fin2 ? Carbon::createFromFormat('d/m/Y', $request->date_fin2)->format('Y-m-d') : null;
                $cours->plage_debut2 = $request->heure_debut2 ? $request->heure_debut2 : null;
                $cours->plage_fin2 = $request->heure_fin2 ? $request->heure_fin2 : null;
                $cours->date_composition2=$request->composition2 ? Carbon::createFromFormat('d/m/Y H:i', $request->composition2)->format('Y-m-d H:i') : null;
                $cours->salle2 = $request->salle2;
            }
            $cours->save();
            notyf()->addSuccess('Cours programmé avec success.');
            return redirect()->route('programmation.edit',['classe'=> $cours->classe->slug]);
        }else{
            notyf()->addSuccess("Une erreur s'est produite. Veuillez réessayer");
            return redirect()->route('programmation.programmer',['cours'=> $cours->id]);
        }

    }

    public function edit(Classe $classe): View
    {
        return view('programmation.edit', compact('classe'));
    }

    public function evaluations(): View
    {
        return view('programmation.evaluations');
    }


    public function generatePdf()
    {

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('programmation.pdfProgrammation');

        return $pdf->stream();
    }

    public function export()
    {
//        \Maatwebsite\Excel\Excel::create('New file', function($excel) {
//
//            $excel->sheet('New sheet', function($sheet) {
//                $programmations = Programmation::where('annee_id', getAnnee()->id)->get();
//
//                $sheet->loadView('exports.programmation_annuelle', compact('programmations'));
//
//            });
//
//        })->export('xls');
//        try {
//            return \Maatwebsite\Excel\Facades\Excel::download(new ProgrammationsExport, 'programmations.xlsx');
//        } catch (\PhpOffice\PhpSpreadsheet\Reader\Exception $e) {
//            // Log or print the exception message
//            echo 'Error loading file: ' . $e->getMessage();
//        }
        $programmations = Programmation::where('annee_id', getAnnee()->id)->get();
        return \view('exports.programmation_annuelle', compact('programmations'));
    }
}
