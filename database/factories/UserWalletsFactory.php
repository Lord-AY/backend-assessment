<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\UserWallets;
use App\Models\WalletType;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserWalletsFactory extends Factory
{
  /**
   * The name of the factory's corresponding model.
   *
   * @var string
   */
  protected $model = UserWallets::class;

  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {
    return [
      'user_id' => User::all()->random()->id,
      'wallet_type_id' => WalletType::all()->random()->id,
      'balance' => $this->faker->numberBetween(1000, 9000),
    ];
  }
}
