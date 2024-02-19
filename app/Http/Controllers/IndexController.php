<?php

namespace App\Http\Controllers;
use App\Http\Requests\Cat\FilterCat;
use App\Models\Cat;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke(FilterCat $request)
    {
        $query=Cat::query();
        $cats = $request->validated();
        
        if (isset($cats['name'])){
            $query->where('title', 'like', "%{$cats['name']}%");
        }

    }
}
