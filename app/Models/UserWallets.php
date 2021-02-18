<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserWallets extends Model
{
  use HasFactory;

  protected $table = "user_wallets";
  protected $guarded = ['id'];

  public function walletType()
  {
    return $this->belongsTo(WalletType::class);
  }
}
