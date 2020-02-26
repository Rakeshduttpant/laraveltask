<?php

namespace App\Http\Controllers;

use App\Groups;
use App\Resource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;

class ResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $resources = Resource::with(['group'])->paginate(10);
            return view('resource.index', compact('resources'));
        } catch (\Exception $e) {
            session()->flash('flash_error', 'Something went wrong');
            return Redirect::back();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $groups = Groups::with([])->get();
            return view('resource.create', compact('groups'));
        } catch (\Exception $e) {
            session()->flash('flash_error', 'Something went wrong');
            return Redirect::back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'name' => 'required|string|unique:resources',
                'group' => 'required|exists:groups,id',
                "description" => "nullable|string"
            ]);
            $resources = new Resource();
            $resources->name = $request->name;
            $resources->group_id = $request->group;
            $resources->description = $request->description;
            $resources->save();
            session()->flash('flash_success', 'Added Successfully.');
            return Redirect::back();
        } catch (ValidationException $exception) {
            return Redirect::back()->withErrors($exception->errors())->withInput();
        } catch (Exception $e) {
            session()->flash('flash_error', 'Something went wrong');
            return $e->getMessage();
            return Redirect::back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Resource  $resource
     * @return \Illuminate\Http\Response
     */
    public function show(Resource $resource)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Resource  $resource
     * @return \Illuminate\Http\Response
     */
    public function edit(Resource $resource)
    {
        try {
            $grou = Groups::with([])->get();
            return view('resource.edit')->with(['groups' => $resource, 'op' => $grou]);
        } catch (\Exception $e) {
            session()->flash('flash_error', 'Something went wrong');
            return Redirect::back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Resource  $resource
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Resource $resource)
    {

        try {
            $this->validate($request, [
                'name' => 'required|string|unique:resources,name,' . $resource->id,
                'group' => 'required|exists:groups,id',
                "description" => "nullable|string"
            ]);
            $resource->name = $request->name;
            $resource->group_id = $request->group;
            $resource->description = $request->description;
            $resource->save();
            session()->flash('flash_success', 'Updated Successfully.');
            return Redirect::route('resources.index');
        } catch (ValidationException $exception) {
            return Redirect::back()->withErrors($exception->errors())->withInput();
        } catch (Exception $e) {
            session()->flash('flash_error', 'Something went wrong');
            return $e->getMessage();
            return Redirect::back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Resource  $resource
     * @return \Illuminate\Http\Response
     */
    public function destroy(Resource $resource)
    {
        try {
            $resource->delete();
            session()->flash('flash_success', 'Deleted Successfully.');
            return Redirect::back();
        } catch (\Exception $e) {
            session()->flash('flash_error', 'Something went wrong');
            return Redirect::back();
        }
    }
}
