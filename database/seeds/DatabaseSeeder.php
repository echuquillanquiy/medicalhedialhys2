<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(RoomsTableSeeder::class);
        $this->call(ShiftsTableSeeder::class);
        //$this->call(PatientsTableSeeder::class);
        $this->call(MedicamentSeeder::class);
        $this->call(ProceduresSeeder::class);
    }
}
