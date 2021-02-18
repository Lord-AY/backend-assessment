<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WalletTypeSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('wallet_types')->insert([
      'name' => 'Standard',
      'minimum_balance' => 500,
      'interest_rate' => 2,
    ]);

    DB::table('wallet_types')->insert([
      'name' => 'Classic',
      'minimum_balance' => 1500,
      'interest_rate' => 5,
    ]);

    DB::table('wallet_types')->insert([
      'name' => 'Premium',
      'minimum_balance' => 2000,
      'interest_rate' => 8,
    ]);
  }
}
