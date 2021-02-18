<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactions extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('transactions', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('sender_id');
      $table->unsignedBigInteger('receiver_id');
      $table->unsignedBigInteger('sender_wallet_id');
      $table->unsignedBigInteger('receiver_wallet_id');
      $table->unsignedBigInteger('amount');

      $table->foreign('sender_id')->references('id')->on('users')->onDelete('cascade');
      $table->foreign('receiver_id')->references('id')->on('users')->onDelete('cascade');
      $table->foreign('sender_wallet_id')->references('id')->on('user_wallets')->onDelete('cascade');
      $table->foreign('receiver_wallet_id')->references('id')->on('user_wallets')->onDelete('cascade');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('transactions');
  }
}
