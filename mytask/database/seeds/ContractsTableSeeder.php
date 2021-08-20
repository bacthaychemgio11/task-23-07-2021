<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContractsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $payMethods = ['Cash', 'Credit or debit', 'Money order', 'Personal check', 'Cashier\'s check'];
        $idUsers = DB::table('users')->pluck('id');

        for ($i = 0; $i < 50; $i++) {
            // TEST TREN LOCAL 21-ID CUA HO SI HUNG
            // 20/08/2021
            if ($i < 5) {
                $owner = 21;
            } else {
                $owner = $idUsers[rand(0, count($idUsers) - 1)];
            }

            // $owner = $idUsers[rand(0, count($idUsers) - 1)];
            $buyer = $idUsers[rand(0, count($idUsers) - 1)];

            while ($owner == $buyer) {
                $buyer = $idUsers[rand(0, count($idUsers) - 1)];
            }

            DB::table('contracts')->insert([
                'price' => rand(1, 100) * 1000,
                'payment' => $payMethods[rand(0, count($payMethods) - 1)],
                'id_owner' => $owner,
                'id_buyer' => $buyer,
            ]);
        }
    }
}
