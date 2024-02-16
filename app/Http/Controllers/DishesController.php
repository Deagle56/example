<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dish;
use App\http\Requests\Dish\createDish;
use App\http\Requests\Dish\updateDish;
use App\http\Requests\Dish\getDish;

class DishesController extends Controller
{
    public function getDishes(getDish $request) {
        $limit = $request->limit;
        $page = $request->page;
        if(!isset($limit)) {
            $limit = 2;
        }
        $dishes=Dish::with('cat')->orderBy('created_at')->cursorPaginate($perPage= $limit, $columns = ['*'], $pageName = $page);
        // $peoples=People::with('cats')->orderBy('created_at')->Paginate($perPage= $limit, $columns = ['*'], $pageName = $page);
        return response()->json(['status' => 'succes', 'dishes' => $dishes], 200 );
    }

    public function create(createDish $request) {
        $dishes =Dish::create([    
        'color' => $request->color,
        'cat_id' => $request->cat_id
    ]);    
    return response()->json(['dishes'=> $dishes], 200);
    }

    public function getDish($id) {
        $dishes=Dish::find($id);
        return response()->json(['dishes'=> $dishes], 200);
    }

    public function destroy($id) {
      $dishes=Dish::find($id);
      $dishes->delete();
    }

    public function update(updateDish $request)
    {
       $dishes=Dish::find($request->id);
       
       $dishes->update([
        'color' => $request->color
       
       ]);
       return response()->json(['dishes'=> $dishes], 200);
}
}
