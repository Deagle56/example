<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Toy;
use App\Http\Requests\Toy\createToy;
use App\Http\Requests\Toy\updateToy;
use App\Http\Requests\Toy\getToy;
use Illuminate\Cache\RateLimiting\Limit;

class toyscontroller extends Controller
{
    public function getToys(getToy $request) {
        $limit = $request->limit;
        $page = $request->page;
        $toys=Toy::with('cat')->orderBy('created_at')->cursorPaginate($perPage = $limit, $columns = ['*'], $pageName = $page);
        return response()->json(['status' => 'succes', 'toys' => $toys, $limit = 1], 200 );
    }

    public function create(createToy $request) {
        $Toys =Toy::create([    
        'color' => $request->color,
        'cat_id' => $request->cat_id
    ]);    
    return response()->json(['Toy'=> $Toys], 200);
    }

    public function getToy($id) {
        $Toys=Toy::find($id);
        return response()->json(['toys'=> $Toys], 200);
    }

    public function destroy($id) {
      $Toys=Toy::find($id);
      $Toys->delete();
    }

    public function update(updateToy $request)
    {
       $Toys=Toy::find($request->id);
       
       $Toys->update([
        'color' => $request->color
       ]);
       return response()->json(['Toy'=> $Toys], 200);
}
    public function createToyCat($toy_id, $cat_id){
        $cat = Toy::find($toy_id)->update([
            'cat_id' => $cat_id
        ]);
        return response()->json(['status' => 'succes'], 200);
    }
}
