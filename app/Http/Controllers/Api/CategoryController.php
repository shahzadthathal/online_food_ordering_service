<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;

use Illuminate\Http\Request;
use App\Models\MenuItemCategory as Model;

class CategoryController extends Controller
{

    public function index()
    {
        $records = Model::orderBy('id','desc')->with('menuItems')->where('status',1)->paginate(20)->withQueryString();
        $response = [
            'success' => true,
            'data'    => $records,
            'message' => 'Success',
        ];
        return response()->json($response, 200);
    }

}