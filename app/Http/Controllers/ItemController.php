<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::all();
        $categories = Category::all();
        return view('item/index', compact('items', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('item/create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $item = new Item;

        $validatedData = request()->validate([
            'name' => 'required|unique:items,item_name',
            'price' => 'required|numeric|between:0,999.99',
            'image' => 'nullable|mimes:jpg, png, jpeg'
        ]);
        
        $item->item_name = $validatedData['name'];
        $item->item_price = $validatedData['price'];
        $item->cat_id = request('category');

        if($request->hasFile('image')){
            $file = $validatedData['image'];
            $extension = $file->getClientOriginalExtension();

            $name = $validatedData['name'];
            $name = str_replace(' ', '', $name);

            $filename = time() . '-' . $name . '.' . $extension;


            $file->move(public_path('images'), $filename);

            $item->item_image = $filename;
        }

        $item->save();

        return redirect('item');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        $categories = Category::all();
        return view('item/edit', compact('item', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        $validatedData = request()->validate([
            'name' => 'required',
            'price' => 'required|numeric|between:0,999.99',
            'image' => 'nullable|mimes:jpg, png, jpeg'
        ]);
        
        $item->avail = request('avail');
        $item->item_name = $validatedData['name'];
        $item->item_price = $validatedData['price'];
        $item->cat_id = request('category');
        
        if($request->hasFile('image')){
            
            $file = $validatedData['image'];

            //if new filename not same with old filename
            if(($file->getClientOriginalName()) != $item->item_image){
                
                //delete old image if exist
                if (($item->item_image) != null){
                    $old_image = 'images/' . $item->item_image;
                    if(File::exists($old_image)){
                        File::delete($old_image);
                    }
                }
                
                //new image
                $extension = $file->getClientOriginalExtension();

                $name = $validatedData['name'];
                $name = str_replace(' ', '', $name);

                $filename = time() . '-' . $name . '.' . $extension;


                $file->move(public_path('images'), $filename);

                $item->item_image = $filename;
            }
        }

        if(request('delete') == 1){
            $old_image = 'images/' . $item->item_image;
                if(File::exists($old_image)){
                    File::delete($old_image);
                }
            $item->item_image = null;
        }

        
        $item->save();

        
        return redirect('item');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        if (($item->item_image) != null){
            $path = 'images/' . $item->item_image;
            if(File::exists($path)){
                File::delete($path);
            }
        }
        
        $item->delete();
        return redirect('item');
    }
}
