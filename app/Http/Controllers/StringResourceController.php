<?php

namespace App\Http\Controllers;

use App\StringResource;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;

class StringResourceController extends Controller
{
    /**
     * Get resource listing page
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listPage(Request $request)
    {
        return view('portal/content/list', [
            'string_resources' => StringResource::all()->sortBy('identifier')
        ]);
    }

    /**
     * Get resource creation page
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createPage(Request $request)
    {
        return view('portal/content/create');
    }

    /**
     * Execute a resource creation request
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'identifier' => 'required|unique:string_resources|max:255',
            'content_en' => 'required',
            'content_fr' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->with('error', $validator->errors()->first());
        } else {
            $resource = new StringResource();
            $resource->fill($request->all());
            $resource->save();
            return redirect('portal/content')->with('success', "Resource created.");
        }
    }

    /**
     * Get resource deletion confirmation page
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function deletePage(Request $request, $id)
    {
        $string_resource = StringResource::find($id);
        if ($string_resource) {
            return view('portal/content/delete', [
                'string_resource' => $string_resource
            ]);
        } else {
            return App::abort(404);
        }
    }

    /**
     * Execute a resource deletion request
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request, $id)
    {
        $string_resource = StringResource::find($id);
        if ($string_resource) {
            $string_resource->delete();
            return redirect('portal/content')->with('success', "Resource deleted.");
        } else {
            return App::abort(404);
        }
    }

    /**
     * Get edit resource page
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editPage(Request $request, $id)
    {
        $string_resource = StringResource::find($id);
        if ($string_resource) {
            return view('portal/content/edit', [
                'string_resource' => $string_resource
            ]);
        } else {
            return App::abort(404);
        }
    }

    /**
     * Execute a resource update request
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $string_resource = StringResource::find($id);
        if ($string_resource) {
            $validator = Validator::make($request->all(), [
                'identifier' => ['required', 'max:255', Rule::unique('string_resources')->ignore($string_resource->id)],
                'content_en' => 'required',
                'content_fr' => 'required'
            ]);

            if ($validator->fails()) {
                return back()->with('error', $validator->errors()->first());
            } else {
                $string_resource->fill($request->all());
                $string_resource->save();
                return redirect('portal/content')->with('success', "Resource saved.");
            }
        } else {
            return App::abort(404);
        }
    }
}
