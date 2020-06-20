<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();
        $adminUser = factory(User::class)->create([
            'email' => 'admin@gmail.com'
        ]);

        $adminUser->roles()->attach(Role::whereName(Role::$adminName)->first());

        $editor = Role::whereName(Role::$editorName)->first();
        for ($i=0; $i < 9; $i++) { 
            $editorUser = factory(User::class, )->create();
            $editorUser->roles()->attach($editor);
        }
        DB::commit();
    }
}
