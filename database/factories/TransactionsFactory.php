<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Transactions;
use App\Models\UserWallets;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionsFactory extends Factory
{
  /**
   * The name of the factory's corresponding model.
   *
   * @var string
   */
  protected $model = Transactions::class;

  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {
    return [
      //
      'amount' => $this->faker->numberBetween(100, 2000),
      'sender_id' => User::all()->random()->id,
      'receiver_id' => User::all()->random()->id,
      'sender_wallet_id' => UserWallets::all()->random()->id,
      'receiver_wallet_id' => UserWallets::all()->random()->id,
    ];
  }
}
