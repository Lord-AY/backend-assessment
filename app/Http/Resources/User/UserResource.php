<?php

namespace App\Http\Resources\User;

use App\Models\Transactions;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
      'name' => $this->name,
      'email' => $this->email,
      'wallets' => $this->wallets,
      'transactions' => Transactions::where('sender_id', $this->id)->orWhere('receiver_id', $this->id)->get()
    ];
  }
}
