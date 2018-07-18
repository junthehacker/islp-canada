<?php

namespace App\Http\Controllers;

use App\StringResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;

class StringResourceController extends Controller
{
    public function listPage(Request $request){
        return view('portal/content/list', [
            'string_resources' => StringResource::all()->sortBy('identifier')
        ]);
    }

    public function createPage(Request $request){
        return view('portal/content/create');
    }

    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            'identifier' => 'required|unique:string_resources|max:255',
            'content_en' => 'required',
            'content_fr' => 'required'
        ]);

        if($validator->fails()){
            return back()->with('error', $validator->errors()->first());
        } else {
            $resource = new StringResource();
            $resource->fill($request->all());
            $resource->save();
            return redirect('portal/content')->with('success', "Resource created.");
        }
    }

    public function deletePage(Request $request, $id){
        $string_resource = StringResource::find($id);
        if($string_resource){
            return view('portal/content/delete', [
                'string_resource' => $string_resource
            ]);
        } else {
            return App::abort(404);
        }
    }

    public function delete(Request $request, $id){
        $string_resource = StringResource::find($id);
        if($string_resource){
            $string_resource->delete();
            return redirect('portal/content')->with('success', "Resource deleted.");
        } else {
            return App::abort(404);
        }
    }
}
