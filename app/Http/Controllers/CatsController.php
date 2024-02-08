<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cat;

class CatsController extends Controller
{
    
    public function getCats() {
        $cats=Cat::all();
        return response()->json(['status' => 'succes', 'cats' => $cats], 200 );
    }
    public function create(Request $request) {
        $cats =Cat::create([    
        'name' => $request->name,
        'gender' => $request->gender
    ]);    
    return response()->json(['cats'=> $cats], 200);
    }

    public function getCat($id) {
        $cats=Cat::find($id);
        return response()->json(['cats'=> $cats], 200);
    }

    public function destroy($id) {
      $cats=Cat::find($id);
      $cats->delete();
    }

    public function update(Request $request)
    {
       $cats=Cat::find($request->id);
       
       $cats->update([
        'name' => $request->name,
        'gender' => $request->gender
       ]);
       return response()->json(['cats'=> $cats], 200);
}
}
