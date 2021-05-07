<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuItemCategory as Model;


class MenuItemCategoryController extends Controller
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
        $records = Model::orderBy('id','desc')->paginate(20)->withQueryString();

        return view('category.index', [
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
        return view('category.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|min:2|unique:menu_item_categories',
        ]);

        $title = $request->input('title');
        $record = new Model([
            'title' => $title,
            'slug' => str_replace([' ', '.', "'",'--'], '-', strtolower($title)),
            'status' => $request->input('status'),
        ]);
        $record->save();
        return redirect()->action([MenuItemCategoryController::class, 'index'])->with('success', 'Record has been inserted.');
    }

    public function show($id)
    {
        $record = Model::find($id);
        return view('category.show',compact('record'));
    }

    public function edit($id)
    {
        $record = Model::find($id);
        return view('category.edit',compact('record'));
    }

    public function update($id, Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|min:2|unique:menu_item_categories,title,'. $id,
        ]);
        $record = Model::find($id);
        $record->update($request->all());

        return redirect()->action([MenuItemCategoryController::class, 'index'])->with('success', 'Record has been updated.');
    }

    public function destroy($id)
    {
        $record = Model::find($id);
        $record->delete();
        return redirect()->action([MenuItemCategoryController::class, 'index'])->with('success', 'Record has been deleted.');

    }
}
