<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function add(Request $request){
        $this->validate($request,[
            'name' =>'required|min:2',
        ]);

        return Tag::create([
            'name' =>$request->name,
        ]);
    }
    public function get(Request $request){
        return Tag::orderBy($request->orderBy, $request->ordering)->paginate($request->itemPerPage);

    }
    public function edit(Request $request){
        $this->validate($request,[
            'name' =>'required|min:2',
            'id' => 'required|numeric',
        ]);

        return Tag::where('id', $request->id)->update([
            'name' =>$request->name
        ]);
    }
    public function getAll(){
        return Tag::orderBy('name', 'asc')->get();
    }
    public function delete(Request $request){
        $this->validate($request,[
            'id' => 'required|numeric',
        ]);

        return Tag::where('id', $request->id)->delete();
    }
}
