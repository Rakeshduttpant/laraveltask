<?php

namespace App\Http\Controllers;

use App\Groups;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Redirect;

class GroupsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $groups = Groups::with([])->paginate(10);
            return view('groups.index', compact('groups'));
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
        return view('groups.create');
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
                "name" => "required|string|unique:groups",
                "description" => "nullable|string"
            ]);
            $groups = new Groups();
            $groups->name = $request->name;
            $groups->description = $request->description;
            $groups->save();
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
     * @param  \App\Groups  $groups
     * @return \Illuminate\Http\Response
     */
    public function show(Groups $groups)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Groups  $groups
     * @return \Illuminate\Http\Response
     */
    public function edit(Groups $group)
    {
        try {
            return view('groups.edit', compact('group'));
        } catch (\Exception $e) {
            session()->flash('flash_error', 'Something went wrong');
            return Redirect::back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Groups  $groups
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Groups $group)
    {
        try {
            $this->validate($request, [
                "name" => "required|string|unique:groups,name," . $group->id,
                "description" => "nullable|string"
            ]);
            $group->name = $request->name;
            $group->description = $request->description;
            $group->save();
            session()->flash('flash_success', 'Updated Successfully.');
            return Redirect::route('groups.index');
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
     * @param  \App\Groups  $groups
     * @return \Illuminate\Http\Response
     */
    public function destroy(Groups $group)
    {
        try {
            $group->delete();
            session()->flash('flash_success', 'Deleted Successfully.');
            return Redirect::back();
        } catch (\Exception $e) {
            session()->flash('flash_error', 'Something went wrong');
            return Redirect::back();
        }
    }
}
