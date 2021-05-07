<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;

use Illuminate\Http\Request;
use App\Models\MenuItem as Model;

class MenuItemController extends Controller
{

    public function index()
    {
        $records = Model::orderBy('id','desc')->with(['categories','menu'])->where('status',1)->paginate(20)->withQueryString();
        $response = [
            'success' => true,
            'data'    => $records,
            'message' => 'Success',
        ];
        return response()->json($response, 200);
    }

}