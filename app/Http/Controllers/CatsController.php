<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cat;
use App\Models\Dish;
use App\Http\Controllers\Controller;
use App\Http\Requests\Cat\createCat;
use App\Http\Requests\Cat\updateCat;
use App\Http\Requests\Cat\getCat;
use app\Filters\Event\EventCatsName;
use Illuminate\Pipeline\Pipeline;


class CatsController extends Controller
{
    
    public function getCats(getCat $request) {
        $limit = $request->limit ? $request->limit : 6;
        $page = $request->page;
        $pagination = $request->pagination;
        // if(!isset($limit)) {
        //     $limit = 15;
        // }
        $cats = Cat::query()->with('cat_id','name','gender','color');

        $response =
            app(Pipeline::class)
            ->send($cats)
            ->through([
                EventCatsName::class
            ])
            ->via('apply')
            ->then(function ($cats) use ($pagination , $page, $limit){
                return $pagination === 'true'
                    ? $cats->orderBy('date_start','desc')->paginate($limit, ['*'], 'page' , $page)->appends(request()->except('page'))
                    : $cats->orderBy('date_start','desc')->get();
            });
            

        // $cats = Cat:: with('dishes', 'toys')->orderBy('created_at')->cursorPaginate($perPage= $limit, $columns = ['*'], $pageName = $page);
        return response()->json(['status' => 'succes', 'cats' => $response], 200 );
        
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
