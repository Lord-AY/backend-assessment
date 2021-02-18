<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SigninController extends Controller
{
  //

  public function login(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'email' => 'required|email|exists:users,email',
      'password' => 'required',
    ]);

    if ($validator->fails()) {
      return response()->json(['data' => ['status' => 'error', 'message' => $validator->errors()]], 400);
    }

    if (auth()->attempt($request->all())) {
      $user = Auth::user();
      $user->generateToken();
      return response()->json(['data' => ['status' => 'success', 'token' => $user->api_token]]);
    }

    return response()->json(['data' => ['status' => 'error', 'message' => "Error login in"]], 400);
  }
}
