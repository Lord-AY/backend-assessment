<?php

namespace App\Observers;

use App\Models\Transactions;
use App\Models\UserWallets;

class TransactionObserver
{
  //

  public function creating(Transactions $transactions)
  {
    $sender_wallet = UserWallets::where('user_id', $transactions->sender_id)->where('id', $transactions->sender_wallet_id)->first();
    $receiver_wallet = UserWallets::where('user_id', $transactions->receiver_id)->where('id', $transactions->receiver_wallet_id)->first();

    $sender_wallet['balance'] -= $transactions->amount;
    $receiver_wallet['balance'] += $transactions->amount;

    $sender_wallet->save();
    $receiver_wallet->save();
  }
}
