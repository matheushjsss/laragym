<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */    public function run()
    {
        // Use PRAGMA for SQLite, otherwise use SET foreign_key_checks
        if (DB::connection()->getDriverName() === 'sqlite') {
            DB::statement("PRAGMA foreign_keys = OFF");
        } else {
            DB::statement("SET foreign_key_checks=0");
        }
        
        Model::unguard();

        $this->call(UserSeeder::class);
        $this->call(CycleSeeder::class);
        $this->call(ServiceSeeder::class);
        $this->call(ActivitySeeder::class);
        $this->call(PackageSeeder::class);

        Model::reguard();
        
        // Re-enable foreign key checks
        if (DB::connection()->getDriverName() === 'sqlite') {
            DB::statement("PRAGMA foreign_keys = ON");
        } else {
            DB::statement("SET foreign_key_checks=1");
        }
    }
}
