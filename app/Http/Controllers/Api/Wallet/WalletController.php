<?php

namespace App\Http\Controllers\Api\Wallet;

use App\Models\UserWallets;
use App\Models\Transactions;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Wallet\WalletResource;
use App\Http\Resources\Wallet\WalletsResource;

class WalletController extends Controller
{
  //
  public function index()
  {
    $wallets = UserWallets::all();
    if (count($wallets) > 0) {
      return WalletsResource::collection($wallets);
    }
    return response()->json(['status' => 'error', 'data' => ['message' => "No record available"]], 400);
  }

  public function find($id)
  {
    $wallet = UserWallets::find($id);
    if (!$wallet) {
      return response()->json(['status' => 'error', 'data' => ['message' => "No record available"]], 400);
    }
    return new WalletResource($wallet);
  }

  public function transfer(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'wallet_id' => 'required|exists:user_wallets,id',
      'receiver_wallet_id' => 'required|exists:user_wallets,id',
      'amount' => 'required|integer|gte:200'
    ]);

    if ($validator->fails()) {
      return response()->json(['data' => ['status' => 'error', 'message' => $validator->errors()]], 400);
    }

    $user = Auth::user();
    $user_wallet = UserWallets::where('user_id', $user->id)->where('id', $request['wallet_id'])->with('walletType')->first();
    $receiver_wallet = UserWallets::where('id', $request['receiver_wallet_id'])->first();

    if (!$user_wallet) {
      return response()->json(['data' => ['status' => 'error', 'message' => 'Wallet does not exist or belong to you']], 400);
    }

    if (!$receiver_wallet) {
      return response()->json(['data' => ['status' => 'error', 'message' => 'Wallet does not exist']], 400);
    }

    if ($user_wallet['balance'] < $request['amount']) {
      return response()->json(['data' => ['status' => 'error', 'message' => 'Insufficient funds']], 400);
    }

    if ($user_wallet['balance'] - $request['amount'] < $user_wallet['wallet_type']['minimum_balance']) {
      return response()->json(['data' => ['status' => 'error', 'message' => $user_wallet->wallet_type->name . ' cannot have funds below ' . $user_wallet->wallet_type->minimum_balance]], 400);
    }

    try {
      Transactions::create([
        'sender_id' => auth()->user()->id,
        'receiver_id' => $receiver_wallet['user_id'],
        'sender_wallet_id' => $user_wallet->id,
        'receiver_wallet_id' => $receiver_wallet->id,
        'amount' => $request['amount']
      ]);
      return response()->json(['data' => ['status' => 'success', 'message' => 'Transfer successful']]);
    } catch (\Exception $ex) {
      return response()->json(['data' => ['status' => 'error', 'message' => 'Error transferring funds']], 400);
    }
  }
}
