<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu as Model;


class MenuController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $records = Model::sortable()->paginate(10)->withQueryString();

        return view('menu.index', [
            'records' => $records
        ]);

    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('menu.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|min:2|unique:menus',
        ]);

        $title = $request->input('title');
        $record = new Model([
            'title' => $title,
            'slug' => str_replace([' ', '.', "'",'--'], '-', strtolower($title)),
            'status' => $request->input('status'),
        ]);
        $record->save();
        return redirect()->action([MenuController::class, 'index'])->with('success', 'Record has been inserted.');
    }

    public function show($id)
    {
        $record = Model::find($id);
        return view('menu.show',compact('record'));
    }

    public function edit($id)
    {
        $record = Model::find($id);
        return view('menu.edit',compact('record'));
    }

    public function update($id, Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|min:2|unique:menus,title,'. $id,
        ]);
        $record = Model::find($id);
        $record->update($request->all());

        return redirect()->action([MenuController::class, 'index'])->with('success', 'Record has been updated.');
    }

    public function destroy($id)
    {
        $record = Model::find($id);
        $record->delete();
        // return response()->json([
        //     'message' => 'Record deleted successfully!'
        // ]);
        return redirect()->action([MenuController::class, 'index'])->with('success', 'Record has been deleted.');

    }
}
