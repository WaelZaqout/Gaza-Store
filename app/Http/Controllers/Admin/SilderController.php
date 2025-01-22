<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Silder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SilderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $silders =Silder::latest('id')->paginate(10);
        return view('admin.silders.index',compact('silders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $silder =new Silder();

        return view('admin.silders.create',compact('silder'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){

        $request->validate([

            'name_en'=>'required',
            'name_ar'=>'required',
            'image'=>'required',
            'description_en'=>'required',
            'description_ar'=>'required',

        ]);

        $silder=Silder::create([
            'name'=> '',
            'description'=> '',

        ]);


        $img_name = rand() . time() . $request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path('images'), $img_name);


        $silder->image()->create([
            'path' => $img_name,
        ]);

        return redirect()
        ->route('admin.silders.index')
        ->with('msg','Silder added Successfully')
        ->with('type','Success');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Silder $silder)
    {
        return view('admin.silders.edit', compact('silder'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Silder $silder)
    {
        $request->validate([

            'name_en'=>'required',
            'name_ar'=>'required',

            'description_en'=>'required',
            'description_ar'=>'required',

        ]);
        // $data=$request->except('_token','image','gallery');

        $silder->update([
            'name'=> '',
            'description'=> '',


        ]);


        if($request->hasFile('image')){
            if($silder->image){
                File::delete(public_path( 'images/' .$silder->image->path));
            }
            $silder->image()->delete();

            $img_name = rand() . time() . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('images'), $img_name);

            $silder->image()->create([
                'path' => $img_name,
            ]);
        }


        return redirect()
        ->route('admin.silders.index')
        ->with('msg','Silder Updated Successfully')
        ->with('type','Success');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Silder $silder)
    {
        File::delete(public_path( 'images/' .$silder->image->path));


        $silder->image()->delete();
        $silder->delete();

        return redirect()
        ->route('admin.silders.index')
        ->with('msg','Silder deleted Successfully')
        ->with('type','info');
}

        function delete_img($id){
            $img =Image::find($id);
            File::delete(public_path( 'images/' .$img->path));

            return Image::destroy($id);

        }

        }
