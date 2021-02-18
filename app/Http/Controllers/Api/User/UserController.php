<?php

namespace App\Http\Controllers\Api\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserResource;
use App\Http\Resources\User\UsersResource;

class UserController extends Controller
{
  //

  public function index()
  {
    $users = User::all();
    if (count($users) > 0) {
      return UsersResource::collection($users);
    }
    return response()->json(['status' => 'error', 'data' => ['message' => "No record available"]], 400);
  }

  public function find($id)
  {
    $user = User::find($id);
    if (!$user) {
      return response()->json(['status' => 'error', 'data' => ['message' => "No record available"]], 400);
    }
    return new UserResource($user);
  }
}
