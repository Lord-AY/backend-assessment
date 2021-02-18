<?php

namespace App\Http\Resources\Wallet;

use App\Models\Transactions;
use Illuminate\Http\Resources\Json\JsonResource;

class WalletResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array
   */
  public function toArray($request)
  {
    return [
      'id' => $this->id,
      'user_id' => $this->user_id,
      'type' => new WalletTypeResource($this->walletType),
      'balance' => $this->balance,
      'transactions' => Transactions::where('sender_wallet_id', $this->id)->orWhere('receiver_wallet_id', $this->id)->get(),
      'date' => $this->created_at,
    ];
  }
}
