<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transactions;
use App\Models\User;
use App\Models\UserWallets;
use Illuminate\Http\Request;

class BaseController extends Controller
{
  //

  public function getInfo()
  {
    $user_count = User::all()->count();
    $wallet_count = UserWallets::all()->count();
    $total_wallet_balance = UserWallets::all()->sum('balance');
    $total_trans_volume = Transactions::all()->sum('amount');

    return response()->json(['data' => [
      'user_count' => $user_count,
      'wallet_count' => $wallet_count,
      'total_wallet_balance' => $total_wallet_balance,
      'total_trans_volume' => $total_trans_volume,
    ]]);
  }
}
