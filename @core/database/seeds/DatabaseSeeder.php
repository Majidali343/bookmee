<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{

    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        //$this->call(StaticOptionsTableSeeder::class);
        update_static_option('site_script_version','1.4.6');

//          $permissions = [
// //            'wallet-list',
// //            'wallet-history',
//          ];
         
//       foreach ($permissions as $permission){
//           \Spatie\Permission\Models\Permission::updateOrCreate(['name' => $permission],['name' => $permission,'guard_name' => 'admin']);
//       }
    }
}
