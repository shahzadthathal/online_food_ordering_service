<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuItem as Model;
use App\Models\Menu;
use App\Models\MenuItemCategory;

class MenuItemController extends Controller
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
        $records = Model::orderBy('id','desc')->paginate(3)->withQueryString();

        return view('menuitem.index', [
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
        $menus = Menu::where('status',1)->get();
        $categories = MenuItemCategory::where('status',1)->get();

        return view('menuitem.create',compact('menus','categories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|min:2|unique:menu_items',
            'menu_id'=>'required',
            'categories' => 'required|array',
            'image'=>'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        $categories   = $request->input('categories');
        $name = 'no-image.png';
        try{
            $file = $request->file('image');
            $name = time().'-'.$file->getClientOriginalName();
            //Upload to 'public' folder
            $file->move(public_path(), $name);
        }catch(\Throwable $e){}

        $title = $request->input('title');
        $record = new Model([
            'title' => $title,
            'slug' => str_replace([' ', '.', "'",'--'], '-', strtolower($title)),
            'status' => $request->input('status'),
            'menu_id'=>$request->input('menu_id'),
            'image' => $name,
        ]);
        $record->save();
        $record->categories()->attach($categories);

        return redirect()->action([MenuItemController::class, 'index'])->with('success', 'Record has been inserted.');
    }

    public function show($id)
    {
        $record = Model::find($id);
        return view('menuitem.show',compact('record'));
    }

    public function edit($id)
    {
        $record = Model::with(['categories','menu'])->find($id);
        $menus = Menu::where('status',1)->get();
        $categories = MenuItemCategory::where('status',1)->get();

        $selectedCatsArr = [];
        foreach($record->categories as $item){
            array_push($selectedCatsArr,$item->id);
        }
        $record->selectedCatsArr = $selectedCatsArr;
        return view('menuitem.edit',compact('record','menus','categories'));
    }

    public function update($id, Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|min:2|unique:menu_items,title,'. $id,
            'menu_id'=>'required',
            'categories' => 'required|array',
            'image'=>'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        $post = $request->all();
        $categories   = $request->input('categories');
        try{
            $file = $request->file('image');
            $name = time().'-'.$file->getClientOriginalName();
            //Upload to 'public' folder
            $file->move(public_path(), $name);
            $post['image'] = $name;
        }catch(\Throwable $e){}

        $record = Model::find($id);
        $record->update($post);

        return redirect()->action([MenuItemController::class, 'index'])->with('success', 'Record has been updated.');
    }

    public function destroy($id)
    {
        $record = Model::find($id);
        $record->delete();
        return redirect()->action([MenuItemController::class, 'index'])->with('success', 'Record has been deleted.');

    }
}
