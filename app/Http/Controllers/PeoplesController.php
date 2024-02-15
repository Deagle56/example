<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\People;
use App\Http\Requests\People\createPeople;
use App\Http\Requests\People\updatePeople;
use App\Http\Requests\People\getPeople;

class PeoplesController extends Controller
{
    public function getPeoples(getPeople $request) {
        $limit = $request->limit;
        $page = $request->page;
        $peoples=People::with('cats')->orderBy('created_at')->Paginate($perPage= $limit, $columns = ['*'], $pageName = $page);
        
        // $toys=Toy::with('cat')->orderBy('created_at')->cursorPaginate($perPage = $limit, $columns = ['*'], $pageName = $page);
        return response()->json(['peoples' => $peoples], 200 );
    }

    public function create(createPeople $request) {
        $peoples =People::create([    
        'name' => $request->name,
        'age' => $request->age,
        'number' => $request->number
    ]);    
    return response()->json(['peoples'=> $peoples], 200);
    }

    public function getPeople($id) {
        $peoples=People::find($id);
        return response()->json(['peoples'=> $peoples], 200);
    }

    public function destroy($id) {
      $peoples=People::find($id);
      $peoples->delete();
    }

    public function update(updatePeople $request)
    {
       $peoples=People::find($request->id);
       
       $peoples->update([
        'name' => $request->name,
        'age' => $request->age,
        'number' => $request->number
        // 'gender' => $request->gender
       ]);
       return response()->json(['peoples'=> $peoples], 200);
    }

    public function createPeopleCat($cat_id, $people_id){
        $cat = People::find($people_id)->cats()->attach($cat_id);
        return response()->json(['status' => 'succes'], 200);
    }



}
