<?php

namespace App\Http\Controllers;

use App\Models\Contrat;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\Classe;
use App\Models\Enseignant;
use App\Models\Cycle;
use App\Models\Ecue;
use App\Models\Programmation;
use App\Models\Ufr;
use Carbon\Carbon;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use NumberToWords\NumberToWords;
use PhpOffice\PhpWord\Style\Paper;

class ContratController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $user = Auth::user();
        $enseignants = getEnseignantsByUfr($user->ufr_id);

        return view('contrats.index', compact('enseignants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($enseignant_id = null): View
    {
        $user = Auth::user();
        $ufr_id = $user->ufr_id;
        $cycles = Cycle::get();
        $enseignants = getEnseignantsByUfr($user->ufr_id);
        $enseignant = $enseignant_id ? Enseignant::find(decryptid($enseignant_id)) : null;

        return view('contrats.create', compact('enseignants', 'cycles', 'enseignant', 'ufr_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $user = Auth::user();
        $enseignant = Enseignant::find(decryptid($request->enseignant));
        if ($enseignant) {
            foreach ($request->niveaux as $niveau) {
                $contrat = new Contrat();
                $contrat->numero = $niveau['numero'];
                $contrat->enseignant_id = $enseignant->id;
                $contrat->ufr_id = $user->ufr_id;
                $contrat->annee_id = getAnnee()->id;
                $contrat->cycle_id = $niveau['cycle'];
                $contrat->save();
                foreach ($niveau['ecues'] as $ecue) {
                    $valeurs = explode("_", $ecue);
                    $cours = Programmation::find($valeurs[0]);
                    if ($cours->ecue1 == $valeurs[1]) {
                        $cours->contrat1_id = $contrat->id;
                    }
                    if ($cours->ecue2 == $valeurs[1]) {
                        $cours->contrat2_id = $contrat->id;
                    }
                    $cours->save();
                }
            }
            notyf()->addSuccess('Contrat créée avec success.');
            return redirect()->route('contrats.show', ['enseignant_id' => encryptid($enseignant->id)]);
        } else {
            dd('ici');
            notyf()->addError("Une erreur s'est produite. Veuillez réessayer");
            return redirect()->route('contrats.create');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($enseignant_id = null)
    {
        $user = Auth::user();
        $enseignants = getEnseignantsByUfr($user->ufr_id);
        $enseignant = $enseignant_id ? Enseignant::find(decryptid($enseignant_id)) : null;
        $contrats = null;
        if ($enseignant) {
            $contrats = getContratByUfrByEnseignant($user->ufr_id, $enseignant->id);
        }
        return view('contrats.show', compact('enseignant', 'enseignants', 'contrats'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($contrat_id): View
    {
        $contrat = Contrat::find(decryptid($contrat_id));
        if ($contrat) {
            return view('contrats.edit', compact('contrat'));
        } else {
            notyf()->addError("Une erreur s'est produite. Veuillez réessayer");
            return redirect()->route('contrats.index');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $contrat_id): RedirectResponse
    {
        $contrat = Contrat::find($contrat_id);
        if ($contrat) {
            $contrat->numero = $request->numero;
            $contrat->date_contrat = $request->date_contrat ? Carbon::createFromFormat('d/m/Y', $request->date_contrat)->format('Y-m-d') : null;
            $contrat->save();
            if ($request->ecues) {
                foreach ($request->ecues as $ecue) {
                    $valeurs = explode("_", $ecue);
                    $cours = Programmation::find($valeurs[0]);
                    if ($cours->ecue1 == $valeurs[1]) {
                        $cours->contrat1_id = $contrat->id;
                    }
                    if ($cours->ecue2 == $valeurs[1]) {
                        $cours->contrat2_id = $contrat->id;
                    }
                    $cours->save();
                }
            }
            notyf()->addSuccess('Contrat modifiée avec success.');
            return redirect()->route('contrats.show', ['enseignant_id' => encryptid($contrat->enseignant_id)]);
        } else {
            notyf()->addError("Une erreur s'est produite. Veuillez réessayer.");
            return redirect()->route('contrats.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($contrat_id): RedirectResponse
    {
        $contrat = Contrat::find(decryptid($contrat_id));
        if ($contrat) {
            DB::select("UPDATE programmations set contrat1_id= null where contrat1_id=" . $contrat->id);
            DB::select("UPDATE programmations set contrat2_id= null where contrat2_id=" . $contrat->id);
            $contrat->delete();
            notyf()->addSuccess('Contrat supprimé avec success.');
            return redirect()->route('contrats.show', ['enseignant_id' => encryptid($contrat->enseignant_id)]);
        } else {
            notyf()->addError("Une erreur s'est produite. Veuillez réessayer.");
            return redirect()->route('contrats.index');
        }
    }

    public function imprimer($contrat_id): RedirectResponse
    {
        $contrat = Contrat::find(decryptid($contrat_id));
        if ($contrat) {
            dd('imprimer');
        } else {
            notyf()->addError("Une erreur s'est produite. Veuillez réessayer.");
            return redirect()->route('contrats.index');
        }
    }

    public function telecharger($contrat_id)
    {
        $contrat = Contrat::find(decryptid($contrat_id));
        if ($contrat) {
            //Convert
            $numberToWords = new NumberToWords();
            $numberTransformer = $numberToWords->getNumberTransformer('fr');
            $enseignant = Enseignant::find($contrat->enseignant_id);
            $ufr = Ufr::find($contrat->ufr_id);
            $cours = getCoursByContrat($contrat->id);
            $nombreJoursTotal = 19;

            $paper = new Paper();
            $paper->setSize('A4');

            $phpWord = new PhpWord();

            $textFontStyle = array(
                'name' => 'Times New Roman',
                'size' => 10,
            );

            // Titre encadré contrat
            $phpWord->addFontStyle('TextFont', $textFontStyle);
            $phpWord->addNumberingStyle(
                'multilevel',
                array(
                    'type' => 'multilevel',
                    'levels' => array(
                        array('format' => 'decimal', 'text' => '%1.', 'left' => 360, 'hanging' => 360, 'tabPos' => 360),
                        array('format' => 'upperLetter', 'text' => '%2.', 'left' => 720, 'hanging' => 360, 'tabPos' => 720),
                    )
                )
            );

            $justificationStyle = array(
                'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH,
            );
            $section = $phpWord->addSection();
            $table = $section->addTable(array('align' => 'center'));
            $table->addRow();
            $cell = $table->addCell($paper->getWidth());
            $cell->setHeight(300000);

            $textRun = $cell->addTextRun(array('alignment' => 'center'));
            $textRun->addText('CONTRAT DE PRESTATION D’ENSEIGNEMENT', array('name' => 'Calibri', 'size' => 16, 'bold' => true));

            // Appliquer les bordures à la cellule
            $cell->getStyle()->setBorderTopSize(6); // Bordure supérieure
            $cell->getStyle()->setBorderTopColor('000000');
            $cell->getStyle()->setBorderBottomSize(6); // Bordure inférieure
            $cell->getStyle()->setBorderBottomColor('000000');
            $cell->getStyle()->setBorderLeftSize(6); // Bordure gauche
            $cell->getStyle()->setBorderLeftColor('000000');
            $cell->getStyle()->setBorderRightSize(6); // Bordure droite
            $cell->getStyle()->setBorderRightColor('000000');


            //Contenu
            $section->addText('');
            $textRun = $section->addTextRun(['TextFont', 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);
            $textRun->addText('N°');
            $textRun->addText($contrat->numero ? $contrat->numero . ' ' : '………-………/', array('bold' => true));
            $textRun->addText($ufr->universite->code . '/' . $ufr->code . '/DA/SGE/SC/SPE/SerP ', array('italic' => true));
            $textRun->addText('du ');
            $textRun->addText($contrat->date_contrat ? date('d/m/Y', strtotime($contrat->date_contrat)) : '………', array('bold' => true));

            $section->addText('Entre : ', array('bold' => true));

            $textRun = $section->addTextRun(['TextFont', 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH]);
            $textRun->addText($ufr->nom_designation . ' (' . $ufr->code . ')' . ',' . $ufr->lieu . ', représenté(e) par ' . $ufr->appellation_directeur . ' ');
            $textRun->addText($ufr->directeur, array('bold' => true, 'italic' => true,));
            $textRun->addText(' téléphone : ' . $ufr->telephone . ', adresse : ' . $ufr->adresse . ', E-mail professionnel : ' . $ufr->email . ' ci-après dénommé « ETABLISSEMENT » d’une part, ');

            $section->addText('Et', array('bold' => true));

            $textRun = $section->addTextRun(['TextFont', 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH]);
            $textRun->addText($enseignant->civilite . ': ');
            $textRun->addText($enseignant->nom . ' ' . $enseignant->prenoms, array('bold' => true));

            $textRun = $section->addTextRun(['TextFont', 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH]);
            $textRun->addText('Nationalité : ');
            $textRun->addText($enseignant->nationalite, array('bold' => true));

            $textRun = $section->addTextRun(['TextFont', 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH]);
            $textRun->addText('Profession : ');
            $textRun->addText($enseignant->profession, array('bold' => true));

            $textRun = $section->addTextRun(['TextFont', 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH]);
            $textRun->addText('Domicilié : ');
            $textRun->addText($enseignant->adresse, array('bold' => true));

            $textRun = $section->addTextRun(['TextFont', 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH]);
            $textRun->addText('IFU : ');
            $textRun->addText($enseignant->ifu, array('bold' => true));

            $textRun = $section->addTextRun(['TextFont', 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH]);
            $textRun->addText('Compte bancaire N° : ');
            $textRun->addText($enseignant->compte, array('bold' => true));
            $textRun->addText('         / Banque : ');
            $textRun->addText($enseignant->banque->nom, array('bold' => true));

            $textRun = $section->addTextRun(['TextFont', 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH]);
            $textRun->addText('Email : ');
            $textRun->addText($enseignant->email, array('bold' => true));

            $textRun = $section->addTextRun(['TextFont', 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH]);
            $textRun->addText('Numéro de téléphone : ');
            $textRun->addText($enseignant->telephone, array('bold' => true));
            $section->addText("ci-après dénommé « L’ENSEIGNANT PRESTATAIRE » d’autre part");
            $section->addText("qui déclare être disponible pour fournir les prestations objet du présent contrat, ci-après dénommé « PRESTATIONS D’ENSEIGNEMENT »,", null, $justificationStyle);

            $section->addText("Considérant que " .  $ufr->code_designation . " est disposée à faciliter à l’enseignant prestataire l’exécution de ses prestations, conformément aux clauses et conditions du présent contrat ;", null, $justificationStyle);

            $section->addText("Les parties au présent contrat ont convenu de ce qui suit :", null, $justificationStyle);
            $section->addText('');
            $section->addText('         1- Objet du contrat', array('bold' => true), $justificationStyle);
            $section->addText("Le présent contrat a pour objet la fourniture de prestations d’enseignement à " .  $ufr->code_designation . " dans les conditions de délai, normes académiques et de qualité conformément aux clauses et conditions ci-après énoncées.", null, $justificationStyle);

            $section->addText("");
            $section->addText('         2-   Nature des prestations', array('bold' => true), $justificationStyle);
            $textRun = $section->addTextRun(['TextFont', 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH]);
            $textRun->addText("L’Entité retient par la présente les prestations de l’enseignant pour l’exécution de ");
            $textRun->addText($numberTransformer->toWords(getTotalHeureByContrat($contrat->id)) . " (" . getTotalHeureByContrat($contrat->id) . ")", array('bold' => true));
            $textRun->addText(" heures d’enseignement des cours de : ");
            $table = $section->addTable(array(
                'cellMargin' => 50,
                'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER,
            ));
            foreach ($cours as $key => $item) {
                $table->addRow();
                $table->addCell(500)->addText(($key + 1) . ".");
                $table->addCell(2500)->addText(rechercherEcue($item->ecue_id)->nom);
                $table->addCell(1000)->addText($item->heure_theorique . "H");
                $table->addCell()->addText(rechercherClasse($item->classe_id)->cycle->nom . " " . rechercherClasse($item->classe_id)->code);
            }

            $section->addText('Conformément aux exigences énumérées dans le cahier de charges joint au présent contrat.', array('italic' => true), $justificationStyle);

            $section->addText('');
            $section->addText('         3-   Date de démarrage et calendrier', array('bold' => true), $justificationStyle);

            $textRun = $section->addTextRun(['TextFont', 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH]);
            $textRun->addText('La durée de la prestation est de ');
            $textRun->addText($nombreJoursTotal, array('bold' => true));
            $textRun->addText(' jours ouvrables à partir de :');

            $section->addText('');
            $tableStyle = array(
                'borderSize' => 6,
                'borderColor' => '000000',
                'cellMargin' => 50,
                'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER,
            );
            $table = $section->addTable($tableStyle);
            $table->addRow();
            $table->addCell(3000)->addText('Département', array('bold' => true));
            $table->addCell(2000)->addText('Année d\'étude', array('bold' => true));
            $table->addCell(3000)->addText('            ECUE            ', array('bold' => true));
            $table->addCell(2000)->addText('Nombre d\'heures', array('bold' => true));
            $table->addCell(1500)->addText('Date de démarrage', array('bold' => true));
            $table->addCell(1500)->addText('Date de fin', array('bold' => true));

            foreach ($cours as $item) {
                $table->addRow();
                $table->addCell(2000)->addText(rechercherClasse($item->classe_id)->filiere->departement->code);
                $table->addCell(3000)->addText(rechercherClasse($item->classe_id)->nom . " " . rechercherClasse($item->classe_id)->niveau);
                $table->addCell(2000)->addText(rechercherEcue($item->ecue_id)->nom);
                $table->addCell(2000)->addText($item->heure_theorique . 'H');
                $table->addCell(2000)->addText(formaterDate($item->date_debut));
                $table->addCell(2000)->addText(formaterDate($item->date_fin));
            }

            $section->addText('');
            $section->addText('         4-   Temps de présence', array('bold' => true), $justificationStyle);
            $section->addText("Dans l’exécution du présent contrat, « L’ENSEIGNANT PRESTATAIRE » " .  $enseignant->nom . " " . $enseignant->prenoms . " assurera également un volume horaire hebdomadaire de……………………de travaux dirigés et de travaux pratiques s’il y en a lieu. En outre, il surveillera les travaux de recherche des apprenants dans les conditions prévues par les textes de " . $ufr->code_designation . '.', null, $justificationStyle);

            $section->addText("");
            $section->addText('         5-   Termes de paiement et prélèvements', array('bold' => true), $justificationStyle);

            $textRun = $section->addTextRun(['TextFont', 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH]);
            $textRun->addText('Les honoraires pour les prestations d’enseignement sont de ');
            $textRun->addText($contrat->cycle->montant, array('bold' => true));
            $textRun->addText(" FCFA brut par heure exécutée conformément aux exigences de " . $ufr->code_designation . '.');

            $section->addText("Les paiements sont effectués en Francs CFA à la fin des prestations (dépôt de sujets, corrigés types et copies corrigées) dûment constatées par une attestation de service fait, par virement bancaire après le prélèvement de l’AIB.", null, $justificationStyle);

            $section->addText("");
            $section->addText('         6-   Normes de Performance', array('bold' => true), $justificationStyle);
            $section->addText("L’enseignant prestataire s’engage à fournir les prestations conformément aux normes professionnelles, d’éthique et déontologiques, de compétence et d’intégrité les plus exigeantes. Il est systématiquement mis fin au présent contrat en cas de défaillance du prestataire constatée et motivée par écrit de " . $ufr->code_designation . '.', null, $justificationStyle);

            $section->addText("");
            $section->addText('         7-   Droit de propriété, de devoir de réserve et de non-concurrence', array('bold' => true), $justificationStyle);
            $section->addText("Pendant la durée d’exécution du présent contrat et les cinq années suivant son expiration, l’enseignant prestataire ne divulguera aucune information exclusive ou confidentielle concernant la prestation, le présent contrat, les affaires ou les documents de " . $ufr->code_designation . " sans avoir obtenu au préalable l’autorisation écrite de l’Unité de formation et de recherche concernée.", null, $justificationStyle);
            $section->addText("");
            $section->addText("Tous les rapports ou autres documents, que l’enseignant prestataire préparera pour le compte " . $ufr->code_designation . " dans le cadre du présent contrat deviendront et demeureront la propriété de " . $ufr->code_designation . '.', null, $justificationStyle);
            $section->addText("");
            $section->addText("Ne sont pas pris en compte les cours et autres documents préparés par l’enseignant pour l’exécution de ses prestations.", null, $justificationStyle);

            $section->addText("");
            $section->addText('         8-   Règlement des litiges', array('bold' => true), $justificationStyle);
            $section->addText("Pour tout ce qui n’est pas prévu au présent contrat, les parties se référeront aux lois béninoises en la matière. Tout litige survenu lors de l’exécution du présent contrat sera soumis aux juridictions compétentes, s’il n’est pas réglé à l’amiable ou par tout autre mode de règlement agréé par les deux parties.", null, $justificationStyle);
            $section->addText("");
            $section->addText('Fait en Trois (3) copies originales à ..................,le ........................', null, array(
                'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER,
            ));

            $section->addText("");
            $section->addText("");
            $section->addText('Pour ' . $ufr->code_designation, null, array(
                'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::END,
                'italic' => true,
            ));

            $textRun = $section->addTextRun(['TextFont', 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH]);
            $textRun->addText('L\'enseignant prestataire,', array('bold' => true));
            $textRun->addText('                                                                                                 Le Directeur,', array('bold' => true, 'italic' => true,));

            $section->addText("");
            $section->addText("");
            $section->addText("");
            $textRun = $section->addTextRun(['TextFont', 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH]);
            $textRun->addText($enseignant->civilite . ' ' . $enseignant->nom . ' ' . $enseignant->prenoms . '                                                                              ', array('bold' => true));
            $textRun->addText($ufr->directeur, array('bold' => true, 'underline' => 'single', 'italic' => true,));

            $section->addText("");
            $section->addText("");
            $section->addText("");
            $section->addText('VISA DE L\'AGENT COMPTABLE', array('bold' => true), array('alignment' => 'center'));


            // Enregistrer le document Word dans un fichier temporaire
            $tempFilePath = tempnam(sys_get_temp_dir(), 'word');
            $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
            $objWriter->save($tempFilePath);

            // Télécharger le fichier Word
            return response()->download($tempFilePath, 'Contrat-' . $enseignant->nom . '-' . $enseignant->prenoms . '-' . getAnnee()->nom . '.docx')->deleteFileAfterSend(true);
        } else {
            notyf()->addError("Une erreur s'est produite. Veuillez réessayer.");
            return redirect()->route('contrats.index');
        }
    }

    public function generateLettreMission()
    {
        $ufr = getUfr();
        $enseignantId = 1;
        $enseignant = Enseignant::find($enseignantId);
        $cours = [];
        $cycles = Cycle::get();
        foreach ($cycles as $k => $cycle) {
            $cours[$k] = getCoursByEnseignantByCycleByUfr($enseignantId, $cycle->id, $ufr->id);
        }

        $cycleText = "cycle ";
        $nonVides = array_filter($cours, function ($coursCycle) {
            return !empty($coursCycle);
        });
        $count = count($nonVides);
        foreach ($nonVides as $i => $coursCycle) {
            $cycleText .= ($i + 1);
            if ($i < $count - 2) {
                $cycleText .= ", ";
            } elseif ($i === $count - 2) {
                $cycleText .= " et ";
            }
        }

        $cours = resumeCours($cours);

        $heures_theoriques = $cours['heures_theoriques'];
        // dd($cours);

        $justificationStyle = array(
            'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH,
        );
        $paper = new Paper();
        $paper->setSize('A4');
        // Créer une nouvelle instance de PhpWord
        $phpWord = new PhpWord();
        $textFontStyle = array(
            'name' => 'Times New Roman',
            'size' => 10,
        );


        $phpWord->addFontStyle('TextFont', $textFontStyle);
        $phpWord->addNumberingStyle(
            'multilevel',
            array(
                'type' => 'multilevel',
                'levels' => array(
                    array('format' => 'bullet', 'text' => '•', 'left' => 360, 'hanging' => 360, 'tabPos' => 720),

                )
            )
        );
        $section = $phpWord->addSection();
        $section->addText($ufr->lieu . ', le ' . formaterDate(Carbon::now()->format('Y-m-d')), null, array(
            'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::END,
        ));
        $section->addText('N°…………' . Carbon::now()->format('Y') . '/' . $ufr->universite->code . '/' . $ufr->code . '/D/DA/SGE/SPE');
        $section->addText('                                                                                                                         ' . $ufr->appellation_directeur . ',');
        $section->addText('                                                                                                                         A');
        $textRun = $section->addTextRun(['TextFont']);
        $textRun->addText('                                                                                                                         ' . $enseignant->civilite . ' ');
        $textRun->addText($enseignant->nom . ' ' . $enseignant->prenoms . ',', array('bold' => true));

        $section->addText('                                                                                                                         Enseignant collaborateur');
        $section->addText('                                                                                                                         extérieur de ' . $ufr->code_designation);

        $section->addText('                                                                                                                         ' . strtoupper($ufr->lieu), null, array('bold' => true));
        $section->addText('');
        $textRun = $section->addTextRun(['TextFont', 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH]);
        $textRun->addText('Objet ', array('underline' => 'single'));
        $textRun->addText(': Lettre de mission au titre de l’année académique ' . getAnnee()->nom, array('bold' => true));
        $section->addText('          Cher partenaire,', null, $justificationStyle);
        $section->addText('          ' . $ufr->nom_designation . ' (' . $ufr->code . ') est heureuse de votre accord d’enseigner les cours recensés dans le tableau ci-dessous à ses étudiants du ' . $cycleText . '. Vous avez ainsi à charge de délivrer ' . $heures_theoriques . ' heures de cours (cours théoriques, travaux dirigés, travaux pratiques, ateliers/sorties pédagogiques/stages, y compris) aux apprenants. Les détails sur les cours et leurs programmations sont joints à cette lettre de mission.', null, $justificationStyle);
        $section->addText('          Comme vous le savez, ' . $ufr->code_designation . ' est une structure publique de formation professionnelle et de recherche dans les domaines de l’Economie appliquée et du Management des organisations. Elle a pour vocation première de mettre sur le marché du travail des cadres compétents dont les entreprises, les administrations et les autres organisations nationales et internationales, ont besoin pour participer efficacement au développement du Bénin, de la sous-région, de l’Afrique et du reste du monde.', null, $justificationStyle);
        $section->addText('          En tant qu’Enseignant Collaborateur Extérieur (ECE) de ' . $ufr->code_designation . ', vous participez au grand projet public de développement et de formation des cadres de demain.', null, $justificationStyle);
        $section->addText('          Pour rendre notre collaboration officielle, nous vous ferons signer un contrat de prestation intellectuelle. Mais déjà, nous voulons rappeler dans cette lettre de mission quelques clauses du contrat :', null, $justificationStyle);

        $section->addText('1- Dispenser les cours dans le respect des masses horaires et des périodes figurant sur les programmations signées. Il en découle que :', null, array('indent' => 1, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH));
        $section->addListItem('En cas de constat d’absence au cours non signalée à l’Administration par les voies pertinentes 72 heures à l’avance, celle-ci se réserve le droit de remplacer l’ECE ;', 0, null, 'multilevel', array('indent' => 2, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH));
        $section->addListItem('Aucun ECE n’est autorisé à démarrer un cours sur sa propre initiative, sans autorisation préalable ou programmation signée des services compétents de l’Ecole. Tout cours démarré à l’insu de l’Administration ne sera ni pris en compte dans le point des heures de vacation, ni payé ;', 0, null, 'multilevel', array('indent' => 2, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH));
        $section->addListItem('L’Administration de ' . $ufr->code_designation . ' se réserve le droit de modifier les affectations de cours entre enseignants d’une année académique à l’autre.', 0, null, 'multilevel', array('indent' => 2, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH));


        $section->addText('2- Discuter du syllabus du cours avec le Chef de Département, son adjoint concerné et le Chef du Service de Programmation et Examens et le déposer à l’Administration avant le démarrage du cours ;', null, array('indent' => 1, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH));

        $section->addText('3- Remettre un support de cours complet aux étudiants au début du cours ;', null, array('indent' => 1, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH));

        $section->addText('4- Faire deux évaluations aux apprenants afin qu’ils aient par matière deux notes à savoir :', null, array('indent' => 1, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH));
        $section->addListItem('Une note de contrôle continu (interrogation écrite/travaux pratiques/travaux de groupes ou exposés notés) ; cette note comptera pour 25% et sera déposée au bureau du Chef Division-Correction en pool de ' . $ufr->code_designation . '. A cet effet, l’Administration remettra deux exemplaires de la liste des étudiants à l’enseignant pour y reporter les notes. Un exemplaire signé sera déposé à l’Administration tandis que le second sera gardé par l’ECE.', 0, null, 'multilevel', array('indent' => 2, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH));
        $section->addListItem('Une note d’examen terminal fait sur feuille de composition de ' . $ufr->code_designation . ' et organisé par l’Administration. Cette note comptera pour 75%. A ce niveau, l’enseignant réserve les deux dernières heures de son cours pour la composition. L’examen se fera à la dernière séance de cours ou au plus tard le samedi suivant la fin du cours.', 0, null, 'multilevel', array('indent' => 2, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH));

        $section->addText('5- Remplir les cahiers de textes et les fiches de présence à chaque séance avec mention de l’heure de début et de fin et arrêter le cours avec signature en indiquant la masse horaire totale accomplie. Ces documents servent de base d’évaluation des charges horaires. A ce propos, l’enseignant est tenu par l’obligation d’objectivité dans le report des heures de cours. En tout état de cause, c’est la masse horaire effective figurant dans lesdits documents et figurant dans les limites accordées qui sera prise en compte dans l’élaboration du point des cours et le paiement.', null, array('indent' => 1, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH));

        $section->addText('6- Par ailleurs, conformément à l’arrêté ministériel année 2022 N°0388/MESRS/DC/SGM/DPAF/DGES/CJ/SA 055SGG22 du 03 août 2022, dans les universités publiques du Bénin, les enseignements sont dispensés sous formes de :', null, array('indent' => 1, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH));

        $section->addListItem('cours théoriques (CT) ;', 0, null, 'multilevel', array('indent' => 2, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH));
        $section->addListItem('travaux dirigés (TD) ;', 0, null, 'multilevel', array('indent' => 2, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH));
        $section->addListItem('travaux pratiques (TP) ;', 0, null, 'multilevel', array('indent' => 2, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH));
        $section->addListItem('ateliers/sorties pédagogiques/stages.', 0, null, 'multilevel', array('indent' => 2, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH));

        $section->addText('Les parités des autres formes d’enseignement sont fixées comme suit :', null, array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH));

        $section->addListItem('une (01) heure de cours théorique équivaut à une heure et demie (01h30) de travaux dirigés ;', 0, null, 'multilevel', array('indent' => 2, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH));
        $section->addListItem('une (01) heure de cours théorique équivaut à deux (02) heures de travaux pratiques ;', 0, null, 'multilevel', array('indent' => 2, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH));
        $section->addListItem('une (01) heure de cours théorique équivaut à cinq (05) heures d’ateliers/sorties pédagogiques/stages.', 0, null, 'multilevel', array('indent' => 2, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH));

        $section->addText('7- Déposer l’épreuve d’examen terminal au secrétariat du Directeur-adjoint, deux jours au moins avant la composition ;', null, array('indent' => 1, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH));

        $section->addText('8- Corriger les feuilles de composition de l’examen terminal 72 heures au plus tard après la composition pour permettre aux apprenants d’avoir leurs notes dans les meilleurs délais (05 jours après la composition) ; reporter les notes ensemble avec un membre de l’administration et un responsable d’étudiant, en trois exemplaires dont une copie réservée à la direction académique, une copie à l’enseignant et une autre copie au responsable d’étudiant ;', null, array('indent' => 1, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH));

        $section->addText('9- Le paiement des honoraires de cours se fera après constat effectif du dépôt des épreuves des sessions nécessaires (normale et rattrapage le cas échéant) et de la correction des copies ;', null, array('indent' => 1, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH));

        $section->addText('10- Corriger lui-même ses copies ; en cas d’envoi d’assistants pour raison de force majeure, s’assurer que l’assistant a reçu l’autorisation pour donner des cours à ' . $ufr->code_designation . ' ;', null, array('indent' => 1, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH));

        $section->addText('11- Se faire évaluer par les apprenants. L’administration viendra à la fin de chaque composition pour assurer l’évaluation du cours ;', null, array('indent' => 1, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH));

        $section->addText('12- Encadrer les mémoires des étudiants selon les répartitions/affectations faites par l’Administration ;', null, array('indent' => 1, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH));

        $section->addText('13- Participer aux jurys de soutenances des mémoires et rapports de stage des apprenants ;', null, array('indent' => 1, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH));

        $section->addText('14- Enfin, en cas d’invitation expresse, votre présence est vivement souhaitée aux différentes réunions des enseignants, de départements et autres et ce, dans le cadre de l’animation de la gestion participative de l’établissement. A cet effet, la liste de présences auxdites réunions fait foi de votre volonté de collaborer avec l’Ecole.', null, array('indent' => 1, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH));
        $section->addText('          Je vous saurai gré, cher partenaire, des dispositions efficientes que vous prendriez en vue de vous conformer à la présente lettre de mission qui complète votre contrat de prestation de service signé avec ' . $ufr->code_designation . '.', null, $justificationStyle);
        $section->addText('');
        $section->addText('');
        $section->addText('');
        $section->addText('');
        $section->addText($ufr->directeur, array('size' => 12, 'underline' => 'single', 'bold' => true), array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::END));
        $section->addText('Maître de Conférences agrégé', array('size' => 8, 'italic' => true), array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::END));
        $section->addText('');
        $section->addText('PJ : Liste détaillée des cours confiés à l’ECE au titre de ' . getAnnee()->nom . '.', array('size' => 8, 'italic' => true));
        $section->addText('');
        $section->addText('');
        $section->addText('Cours à dispenser au titre de l’année académique ' . getAnnee()->nom, array('size' => 15, 'bold' => true), array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
        $textRun = $section->addTextRun(['TextFont', 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);
        $section->addText('');
        $textRun->addText('Enseignant : ');
        $textRun->addText($enseignant->nom . ' ' . $enseignant->prenoms, array('bold' => true));
        $section->addText('');

        $tableStyle = array(
            'borderSize' => 6,
            'borderColor' => '000000',
            'cellMargin' => 50,
            'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER,
        );
        $table = $section->addTable($tableStyle);
        $table->addRow();
        $table->addCell(500)->addText('N°', array('bold' => true));
        $table->addCell()->addText('Cycle d\'étude', array('bold' => true));
        $table->addCell()->addText('Cours', array('bold' => true));
        $table->addCell()->addText('Masses horaires', array('bold' => true));
        $table->addCell()->addText('Groupes pédagogiques', array('bold' => true));
        $table->addCell(2500)->addText('Observations', array('bold' => true));


        foreach ($cours['details'] as $key => $item) {
            $classe = rechercherClasse($item['classe_id']);
            $ecue = rechercherEcue($item['ecue_id']);
            $table->addRow();
            $table->addCell()->addText($key + 1);
            $table->addCell()->addText('Cycle' . $classe->cycle->id);
            $table->addCell()->addText($ecue->nom);
            $table->addCell()->addText($item['heure_theorique'] . 'H');
            $table->addCell()->addText($classe->code);
            $table->addCell()->addText('');
        }
        $table->addRow();
        $table->addCell(3, array('gridSpan' => 3, 'align' => 'center'))->addText('Total', array('bold' => true));
        $table->addCell()->addText($cours['heures_theoriques'] . 'H', array('bold' => true, 'align' => 'center'));
        $table->addCell()->addText('/', array('align' => 'center'));
        $table->addCell()->addText('/', array('align' => 'center'));

        $section->addText('');
        $section->addText('');
        $section->addText('');

        $section->addText($ufr->appellation_directeur . ',', array('size' => 12), array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));


        $section->addText('');
        $section->addText('');
        $section->addText($ufr->directeur, array('size' => 12, 'underline' => 'single', 'bold' => true), array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
        $section->addText('Maître de Conférences agrégé', array('size' => 8, 'italic' => true), array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));


        // Enregistrer le document Word dans un fichier temporaire
        $tempFilePath = tempnam(sys_get_temp_dir(), 'word');
        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save($tempFilePath);

        // Télécharger le fichier Word
        return response()->download($tempFilePath, 'Lettre-de-mission-' . $enseignant->nom . '-' . $enseignant->prenoms . '-' . getAnnee()->nom . '.docx')->deleteFileAfterSend(true);
    }
}
