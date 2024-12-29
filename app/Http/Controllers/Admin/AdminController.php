<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\notifications;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    function index(){
        return view('admin.index');
    }
    
    function profile(){

        $admin =Auth::user();
        return view('admin.profile',compact('admin'));

    }
    function profile_data(Request $request){

      $request->validate([
        'name'=>'required',
        'current_password'=>'required_with:password',
        'password'=>'nullable|min:8|confirmed',
      ]);

      /** @var User $admin */
      $admin=Auth::user();


      $data=[
        'name'=>$request->name,
      ];
      if($request->has('password')){
        $data['password']= bcrypt($request->password);
      }
      $admin->update($data);


    if($request->hasFile('image')){
        if($admin->image){
            File::delete(public_path('image/'.$admin->image->path));
            $admin->image()->delete();
        }
        $img_name=rand().time().$request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path('images'),$img_name);
   //**لاختيار صورة واحدة */
        $admin->image()->create([
            'path'=>$img_name
        ]);
    }



      return redirect()->back()->with('msg','Profile update successfuly');
    }
    function check_password(Request $request){

        return Hash::check($request->password ,Auth::user()->password);
    }
    function orders(){
        if(request()->has('id')){
            $id =request()->id;
            Auth::user()->notifications->find($id)->markAsRead();
        }

        return 'Ordere page';
    }
    function notifications(){
        Auth::user()->notifications->markAsRead();
        return view('admin.notifications');


    }
}
