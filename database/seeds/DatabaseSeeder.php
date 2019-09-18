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
        DB::table('users')->insert([
            'name' => 'Managing Director',
            'email' => 'mhasan@nnslbd.com',
            'password' => bcrypt('Asdf1234'),
            'phone'=>'01730039990',
            'role_id'=>'1'
        ]);
        DB::table('roles')->insert(
            [
                'name' => 'super_admin',
                'display_name' =>'Super Admin'
            ]
        );
        DB::table('role_user')->insert([
            'user_id' => 1,
            'role_id' =>1
        ]);
        DB::table('permissions')->insert([
            'name' => 'trip_view',
            'display_name' =>'Trip view',
        ]);
        DB::table('permissions')->insert([
            'name' => 'trip_add',
            'display_name' =>'Trip add',
        ]);
        DB::table('permissions')->insert([
            'name' => 'trip_edit',
            'display_name' =>'Trip edit',
        ]);
        DB::table('permissions')->insert([
            'name' => 'trip_delete',
            'display_name' =>'Trip delete',
        ]);
        DB::table('permissions')->insert([
            'name' => 'user_view',
            'display_name' =>'User view',
        ]);
        DB::table('permissions')->insert([
            'name' => 'user_add',
            'display_name' =>'User add',
        ]);
        DB::table('permissions')->insert([
            'name' => 'user_edit',
            'display_name' =>'User edit',
        ]);
        DB::table('permissions')->insert([
            'name' => 'user_password',
            'display_name' =>'User password',
        ]);
        DB::table('permissions')->insert([
            'name' => 'view_all',
            'display_name' =>'View all',
        ]);
        DB::table('permissions')->insert([
            'name' => 'income_view',
            'display_name' =>'Income view',
        ]);
        DB::table('permissions')->insert([
            'name' => 'income_add',
            'display_name' =>'Income add',
        ]);
        DB::table('permissions')->insert([
            'name' => 'income_edit',
            'display_name' =>'Income edit',
        ]);
        DB::table('permissions')->insert([
            'name' => 'income_delete',
            'display_name' =>'Income delete',
        ]);
        DB::table('permissions')->insert([
            'name' => 'expense_view',
            'display_name' =>'Expense view',
        ]);
        DB::table('permissions')->insert([
            'name' => 'expense_add',
            'display_name' =>'Expense add',
        ]);
        DB::table('permissions')->insert([
            'name' => 'expense_edit',
            'display_name' =>'Expense edit',
        ]);
        DB::table('permissions')->insert([
            'name' => 'expense_delete',
            'display_name' =>'Expense delete',
        ]);
        DB::table('permissions')->insert([
            'name' => 'date',
            'display_name' =>'Date manipulation',
        ]);
        DB::table('permissions')->insert([
            'name' => 'ship_view',
            'display_name' =>'Ship View',
        ]);
        DB::table('permissions')->insert([
            'name' => 'notify_all',
            'display_name' =>'Notify All',
        ]);
        DB::table('permissions')->insert([
            'name' => 'gexpense_view',
            'display_name' =>'General Expense view',
        ]);
        DB::table('permissions')->insert([
            'name' => 'gexpense_add',
            'display_name' =>'General Expense add',
        ]);
        DB::table('permissions')->insert([
            'name' => 'gexpense_edit',
            'display_name' =>'General Expense edit',
        ]);
        DB::table('permissions')->insert([
            'name' => 'gexpense_delete',
            'display_name' =>'General Expense delete',
        ]);
        DB::table('ships')->insert([
            'name' => 'Hasan Hamim 1',
            'type' =>'General Career',
            'double_trip'=>18,
            'prefix'=>'HM1',
        ]);
        DB::table('ships')->insert([
            'name' => 'Hasan Hamim 3',
            'type' =>'General Career',
            'double_trip'=>20,
            'prefix'=>'HM3',
        ]);
        DB::table('options')->insert([
            'key' => 'site_name',
            'value' =>'NNSL',
        ]);
        DB::table('options')->insert([
            'key' => 'allow_reg',
            'value' =>'0',
        ]);
        DB::table('options')->insert([
            'key' => 'date_format',
            'value' =>'Y-m-d',
        ]);
    }
}
