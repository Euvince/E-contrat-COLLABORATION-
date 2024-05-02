<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use App\Models\Annee;
use App\Models\Cycle;
use App\Models\Enseignant;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        if ($user->hasRole('Administrateur') ) {
            return view('admin.dashboard-administrateur');
        } else if ($user->hasRole('Manager')) {
            return view('admin.dashboard-manager');
        } else if ($user->hasRole('Comptabilite')) {
            return view('admin.dashboard-comptabilite');
        }else if ($user->hasRole('Personnel')||$user->hasRole('Assistant Personnel')) {
            $cycles=Cycle::get();
            return view('admin.dashboard-personnel', compact('cycles'));
        }else if ($user->hasRole('Programmation')||$user->hasRole('Assistant Programmation')) {
            return view('admin.dashboard-programmmation');
        }else if ($user->hasRole('Chef de Département')) {
            $departement=$user->departement;
            $cycles=Cycle::get();
            return view('admin.dashboard-cd', compact('departement','cycles'));
        }else if ($user->hasRole('Responsable')) {
            $classe=$user->classe;
            return view('admin.dashboard-responsable', compact('classe'));
        }
    }

    public function changeAnnee($annee)
    {
        $annee = Annee::find($annee);
        if ($annee) {
            session()->put('ANNEE_ID', $annee->id);
        }
        return redirect()->route('dashboard');
    }

    public function import (){
        $spreadsheet = IOFactory::load("documents/liste.xlsx");
        $writer = new Xlsx($spreadsheet);
        $sheet = $spreadsheet->setActiveSheetIndex(0);
        for ($i=2;$i<=$sheet->getHighestRow();$i++) {
            $params = ['ifu' =>$sheet->getCell('D'.$i)->getCalculatedValue()];
            $eneignant=Enseignant::firstOrNew($params);
            $eneignant->nom=$sheet->getCell('E'.$i)->getCalculatedValue();
            $eneignant->prenoms=$sheet->getCell('F'.$i)->getCalculatedValue();
            $eneignant->email=$sheet->getCell('B'.$i)->getCalculatedValue();
            $eneignant->date_naissance= Carbon::parse(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToTimestamp($sheet->getCell('G'.$i)->getCalculatedValue()))->format('Y-m-d');
            $eneignant->lieu_naissance=$sheet->getCell('H'.$i)->getCalculatedValue();
            $eneignant->sexe=$sheet->getCell('I'.$i)->getCalculatedValue();
            $eneignant->telephone=$sheet->getCell('J'.$i)->getCalculatedValue();
            $eneignant->structure_origine=$sheet->getCell('M'.$i)->getCalculatedValue();
            $eneignant->corps_fonction_publique=$sheet->getCell('Q'.$i)->getCalculatedValue();
            $eneignant->nb_enfants=$sheet->getCell('T'.$i)->getCalculatedValue();
            $eneignant->poste_administratif=$sheet->getCell('U'.$i)->getCalculatedValue();
            $eneignant->diplome_recrutement=$sheet->getCell('W'.$i)->getCalculatedValue();
            $eneignant->specialite_diplome_recrutement=$sheet->getCell('X'.$i)->getCalculatedValue();
            $eneignant->diplome_actuel=$sheet->getCell('Y'.$i)->getCalculatedValue();
            $eneignant->specialite_diplome_actuel=$sheet->getCell('Z'.$i)->getCalculatedValue();
            $eneignant->save();
        }

    }


    public function root()
    {
        return view('index');
    }

    /*Language Translation*/
    public function lang($locale)
    {
        if ($locale) {
            App::setLocale($locale);
            Session::put('lang', $locale);
            Session::save();
            return redirect()->back()->with('locale', $locale);
        } else {
            return redirect()->back();
        }
    }

    public function updateProfile(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email'],
            'avatar' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:1024'],
        ]);

        $user = User::find($id);
        $user->name = $request->get('name');
        $user->email = $request->get('email');

        if ($request->file('avatar')) {
            $avatar = $request->file('avatar');
            $avatarName = time() . '.' . $avatar->getClientOriginalExtension();
            $avatarPath = public_path('/images/');
            $avatar->move($avatarPath, $avatarName);
            $user->avatar =  $avatarName;
        }

        $user->update();
        if ($user) {
            Session::flash('message', 'User Details Updated successfully!');
            Session::flash('alert-class', 'alert-success');
            // return response()->json([
            //     'isSuccess' => true,
            //     'Message' => "User Details Updated successfully!"
            // ], 200); // Status code here
            return redirect()->back();
        } else {
            Session::flash('message', 'Something went wrong!');
            Session::flash('alert-class', 'alert-danger');
            // return response()->json([
            //     'isSuccess' => true,
            //     'Message' => "Something went wrong!"
            // ], 200); // Status code here
            return redirect()->back();
        }
    }

    public function updatePassword(Request $request, $id)
    {
        $request->validate([
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        if (!(Hash::check($request->get('current_password'), Auth::user()->password))) {
            return response()->json([
                'isSuccess' => false,
                'Message' => "Your Current password does not matches with the password you provided. Please try again."
            ], 200); // Status code
        } else {
            $user = User::find($id);
            $user->password = Hash::make($request->get('password'));
            $user->update();
            if ($user) {
                Session::flash('message', 'Password updated successfully!');
                Session::flash('alert-class', 'alert-success');
                return response()->json([
                    'isSuccess' => true,
                    'Message' => "Password updated successfully!"
                ], 200); // Status code here
            } else {
                Session::flash('message', 'Something went wrong!');
                Session::flash('alert-class', 'alert-danger');
                return response()->json([
                    'isSuccess' => true,
                    'Message' => "Something went wrong!"
                ], 200); // Status code here
            }
        }
    }
}
