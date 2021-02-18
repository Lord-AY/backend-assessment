<?php

namespace App\Http\Resources\Wallet;

use Illuminate\Http\Resources\Json\JsonResource;

class WalletTypeResource extends JsonResource
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
      'name' => $this->name,
      'minimum_balance' => $this->minimum_balance,
      'interest_rate' => $this->interest_rate
    ];
  }
}
