<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Programmation des examens</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        /*header {*/
        /*  text-align: left;*/
        /*}*/
        h6 {
            margin: 0;
            opacity: 0.7;
            font-size: 12px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            border: 1px solid black;
        }

        th,
        td {
            border: 1px solid black;
            padding: 5px;
            text-align: center;
        }
    </style>
</head>


<body>
<table style="border:solid 2px; ">
    <thead style="border:solid 2px;">
    <tr style="border: solid 2px;">
        <th>N</th>
        <th>Groupe pédagogique</th>
        <th>Semestres</th>
        <th>UE</th>
        <th>ECUE</th>
        <th>Masse horaire</th>
        <th>Période</th>
        <th>Salles</th>
        <th>Enseignants</th>
        <th>Exécution</th>
        <th> %Exécution</th>
    </tr>
    </thead>
    <tbody>
        <tr style="border:solid 2px;">
            @php
                $gps = $programmations->groupBy(['classe_id']);
            @endphp
            @foreach($programmations as $prog)

                @php
                    //dd(getEcueByClasse($prog->classe_id));
                    $ues = [];
                //    foreach ($prog->classe as $nom ){
                //        $gps[] = $nom->nom;
                //    }

                    $tab = [1];
                    $ues = [1,2,3,4,5,6,7,8];
                    $sems = [1,2];

                @endphp
            @endforeach
            <tr>

                @foreach($gps as $gpss)

                    <td rowspan="{{$gpss[$loop->iteration -1]->classe->cours->count()}}">{{$loop->iteration}}</td>
                    <td rowspan="{{$gpss[$loop->iteration -1]->classe->cours->count()}}">{{$gpss[$loop->iteration -1]->classe->nom}}</td>
                        @foreach($gpss->groupBy('semestre') as $gp)
                            <td rowspan="{{$gp[$loop->iteration -1]->classe->cours->count()}}">
                                Semestre {{$gp[$loop->iteration -1]->semestre}}</td>
                            @foreach($gp->groupBy('ue_id') as $ue)
                                @php
                                    $ecue = rechercherEcue(getEcueByClasseBySemestre($gpss[$loop->iteration -1]->classe_id,$gp[$loop->iteration -1]->semestre )[$loop->iteration - 1]->ecue_id);
                                    $span = 1;
                                    $ecue2 = getEcueByClasseBySemestre($gpss[$loop->iteration -1]->classe_id,$gp[$loop->iteration -1]->semestre + 1 );
                                    if(count($ecue2) > 0)
                                        {
                                    $ecue2 = rechercherEcue(getEcueByClasseBySemestre($gpss[$loop->iteration -1]->classe_id,$gp[$loop->iteration -1]->semestre + 1 )[$loop->iteration - 1]->ecue_id) ;
                                    $span++;

                                        }

                                @endphp
                                <td rowspan="{{$span}}">{{$ue[0]->ue->nom}}</td>
                                <td>{{$ecue->nom}}</td>
                                <td>{{$gp[$loop->iteration -1]->heure_theorique1}}</td>
                                <td>{{ $gp[$loop->iteration -1]->plage_debut1 . ' à ' . $gp[$loop->iteration -1]->plage_fin1. ' Du ' . \Illuminate\Support\Facades\Date::make($gp[$loop->iteration - 1]->date_debut1?? now())->format("d F Y")  . ' au '. \Illuminate\Support\Facades\Date::make($gp[$loop->iteration - 1]->date_fin1?? now())->format("d F Y")  }}</td>
                                <td>{{$gp[$loop->iteration -1]->salle1}}</td>
                                @php
                                    $enseignant = rechercherEnseignant($gp[$loop->iteration -1]->enseignant1);
                                @endphp
                                <td>{{$enseignant?->prenoms . ' ' .$enseignant?->nom }}</td>
                                <td>0</td>
                                <td> %0</td>
            </tr>
                    @if($ecue2 )
                        <tr>

                            <td>Ecue2</td>
                            <td>20h</td>
                            <td>periode</td>
                            <td>A2</td>
                            <td>Enseignant2</td>
                            <td>Exécution</td>
                            <td> Exécution</td>
                        </tr>
                    @endif

                @endforeach
                @endforeach
                @endforeach
            </tr>
    </tbody>
</table>

</body>

</html>
