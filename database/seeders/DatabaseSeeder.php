<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    protected $toTruncate = ['cours'];
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AnneeSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(CycleSeeder::class);
        $this->call(UniversiteSeeder::class);
        $this->call(UfrSeeder::class);
        $this->call(DepartementSeeder::class);
        $this->call(FiliereSeeder::class);
        $this->call(ClasseSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(UeSeeder::class);
        $this->call(EcueSeeder::class);
        $this->call(BanqueSeeder::class);
        $this->call(GradeSeeder::class);
        $this->call(StatusSeeder::class);
        $this->call(CoursSeeder::class);
        
    }
}
