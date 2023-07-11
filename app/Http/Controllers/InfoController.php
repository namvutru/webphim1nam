<?php

namespace App\Http\Controllers;

use App\Models\Info;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\In;

class InfoController extends Controller
{
    //
    public function create(){
        $info = Info::where('id',1)->first();
        return view ('admincp.info.form',compact('info'));
    }
    public function update(Request $request, $id){
        $info = Info::find($id);
        $data = $request->all();
        $info->title = $data['title'];
        $info->description = $data['description'];

        $get_image = $request->file('logo');
        if($get_image){
            unlink('uploads/logo/'.$info->logo);
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,9999).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('uploads/logo/',$new_image);
//            File::copy($path.$new_image,$path_gallery.$new_image);
            $info->logo = $new_image;

        }
        $info->save();
        return redirect()->back();
    }
}
