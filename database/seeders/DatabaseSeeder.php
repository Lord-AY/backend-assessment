<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {
    \App\Models\User::factory(20)->create();
    $this->call(WalletTypeSeeder::class);
    \App\Models\UserWallets::factory(40)->create();
    \App\Models\Transactions::factory(60)->create();
  }
}
