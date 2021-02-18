<?php

namespace App\Http\Resources\Wallet;

use Illuminate\Http\Resources\Json\JsonResource;

class WalletsResource extends JsonResource
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
          'wallet_type_id' => $this->wallet_type_id,
          'balance' => $this->balance,
          'date' => $this->created_at,
        ];
    }
}
