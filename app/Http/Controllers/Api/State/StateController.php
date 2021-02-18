<?php

namespace App\Http\Controllers\Api\State;

use App\Models\State;
use Illuminate\Http\Request;
use App\Imports\StatesImport;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class StateController extends Controller
{
  //

  public function index()
  {
    if (count(State::all()) > 0) {
      $states = State::all()->groupBy('state');

      foreach ($states as $key => $value) {
        $newLga = [];
        foreach ($value as $lga) {
          array_push($newLga, $lga->lga);
        }
        $states[$key] = $newLga;
      }

      return response()->json(['status' => 'success', 'data' => $states]);
    }

    return response()->json(['status' => 'error', 'data' => ['message' => "No record available"]], 400);
  }

  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'file' => 'required|mimes:xlsx',
    ]);

    if ($validator->fails()) {
      return response()->json(['data' => ['status' => 'error', 'message' => $validator->errors()]], 400);
    }


    if ($request->hasFile('file')) {
      try {
        if (count(State::all()) > 0) {
          DB::table('state_lga')->truncate();
        }
        Excel::import(new StatesImport, $request->file('file'));

        return response()->json(['data' => ['status' => 'success', 'message' => 'Upload successful']]);
      } catch (\Exception $ex) {
        dd($ex->getMessage());
        return response()->json(['data' => ['status' => 'error', 'message' => "Error uploading files to database"]], 400);
      }
    }

    return response()->json(['data' => ['status' => 'error', 'message' => "Error uploading files to database"]], 400);
  }
}
