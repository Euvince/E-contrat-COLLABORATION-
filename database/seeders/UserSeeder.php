<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $administrateur = User::create([
            'nom' => 'COMLAN',
            'prenom' => 'Maurice',
            'email' => 'maurice.comlan@uac.bj',
            'ufr_id' => null,
            'password' => Hash::make('admin'),
            'email_verified_at'=>'2022-01-02 17:04:58',
            //'avatar' => 'avatar-1.jpg',
            'created_at' => now()
        ]);

        $administrateur->assignRole('Administrateur');

        $manager = User::create([
            'nom' => 'AKODJENOU',
            'prenom' => 'Hervé',
            'email' => 'akodjenouherve13@gmail.com',
            'ufr_id' => 1,
            'password' => Hash::make('admin'),
            'email_verified_at'=>'2022-01-02 17:04:58',
            //'avatar' => 'avatar-1.jpg',
            'created_at' => now()
        ]);

        $manager->assignRole('Manager');
        $manager->assignRole('Ufr');

        $cd = User::create([
            'nom' => 'SENOU',
            'prenom' => 'Barthélémy',
            'email' => 'senou@uac.bj',
            'ufr_id' => 1,
            'departement_id' => 1,
            'password' => Hash::make('admin'),
            'email_verified_at'=>'2022-01-02 17:04:58',
            //'avatar' => 'avatar-1.jpg',
            'created_at' => now()
        ]);

        $cd->assignRole('Chef de Département');
        $cd->assignRole('Ufr');

        $personnel = User::create(['nom' => 'Personnel',
        'prenom' => 'UAC',
        'email' => 'personnel@eneam.bj',
        'ufr_id' => 1,
        'password' => Hash::make('admin'),
        'email_verified_at'=>'2022-01-02 17:04:58',
        //'avatar' => 'avatar-1.jpg',
        'created_at' => now(),]);

        $personnel->assignRole('Personnel');
        $personnel->assignRole('Ufr');

        $assistantpersonnel = User::create(['nom' => 'Personnel',
        'prenom' => 'Assisstant',
        'email' => 'assistant.personnel@eneam.bj',
        'ufr_id' => 1,
        'password' => Hash::make('admin'),
        'email_verified_at'=>'2022-01-02 17:04:58',
        //'avatar' => 'avatar-1.jpg',
        'created_at' => now(),]);

        $assistantpersonnel->assignRole('Assistant Personnel');
        $assistantpersonnel->assignRole('Ufr');

        $programmation = User::create(['nom' => 'Programmation',
        'prenom' => 'ENEAM',
        'email' => 'programmation@uac.bj',
        'ufr_id' => 1,
        'password' => Hash::make('admin'),
        'email_verified_at'=>'2022-01-02 17:04:58',
        //'avatar' => 'avatar-1.jpg',
        'created_at' => now(),]);

        $programmation->assignRole('Programmation');
        $programmation->assignRole('Ufr');

        $assistant = User::create(['nom' => 'Programmation',
        'prenom' => 'Assistant',
        'email' => 'assistant.programmation@uac.bj',
        'ufr_id' => 1,
        'password' => Hash::make('admin'),
        'email_verified_at'=>'2022-01-02 17:04:58',
        //'avatar' => 'avatar-1.jpg',
        'created_at' => now(),]);

        $assistant->assignRole('Assistant Programmation');
        $assistant->assignRole('Ufr');


        $responsable = User::create(['nom' => 'Responsable',
        'prenom' => 'AIP',
        'email' => 'responsable@eneam.bj',
        'classe_id' => 1,
        'ufr_id' => 1,
        'password' => Hash::make('admin'),
        'email_verified_at'=>'2022-01-02 17:04:58',
        //'avatar' => 'avatar-1.jpg',
        'created_at' => now(),]);

        $responsable->assignRole('Responsable');

    }
}
