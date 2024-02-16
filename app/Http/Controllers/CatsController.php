<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cat;
use App\Models\Dish;
use App\Http\Requests\Cat\createCat;
use App\Http\Requests\Cat\updateCat;
use App\Http\Requests\Cat\getCat;

class CatsController extends Controller
{
    
    public function getCats(getCat $request) {
        $limit = $request->limit;
        $page = $request->page;
        if(!isset($limit)) {
            $limit = 2;
        }
        $cats = Cat:: with('dishes', 'toys')->orderBy('created_at')->cursorPaginate($perPage= $limit, $columns = ['*'], $pageName = $page);
        return response()->json(['status' => 'succes', 'cats' => $cats], 200 );
        
    }

    public function create(createCat $request) {
        $cats =Cat::create([    
        'name' => $request->name,
        'gender' => $request->gender,
        'color' => $request->color
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

    public function update(updateCat $request)
    {
       $cats=Cat::find($request->id);
       
       $cats->update([
        'name' => $request->name,
        'gender' => $request->gender
       ]);
       return response()->json(['cats'=> $cats], 200);
}
    public function createDishCat($dish_id, $cat_id){
        $cat = Cat::find($cat_id)->update([
            'dish_id' => $dish_id
        ]);
        $dish = Dish::find($dish_id)->update([
            'cat_id' => $cat_id
        ]);
        return response()->json(['status' => 'succes', 'cat' => $cat], 200);
    }
}
