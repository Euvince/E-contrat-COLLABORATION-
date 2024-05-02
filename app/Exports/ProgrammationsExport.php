<?php

namespace App\Exports;

use App\Models\Programmation;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class ProgrammationsExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */


    public function view(): View
    {
        $programmations = Programmation::where('annee_id', getAnnee()->id)->get();
        return view('exports.programmation_annuelle', compact('programmations'));
    }
}
