<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $cities = City::all();
        return response()->view('cms.cities.index', ['cities' => $cities]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return response()->view('cms.cities.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name_en' => 'required|string|min:3|max:20',
            'name_ar' => 'required|string|min:3|max:20',
        ]);

        $city = new City();
        $city->name_en = $request->get('name_en');
        $city->name_ar = $request->get('name_ar');
        $isSaved = $city->save();
        if ($isSaved) {
            return response()->json(['icon' => 'success', 'title' => 'Create successfully'], 200);
        } else {
            return response()->json(['icon' => 'error', 'title' => 'Failed to create city'], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $city = City::findOrFail($id);
        return response()->view('cms.cities.edit', ['city' => $city]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'name_en' => 'required|string|min:3|max:20',
            'name_ar' => 'required|string|min:3|max:20',
        ]);

        $city =  City::findOrFail($id);
        $city->name_en = $request->get('name_en');
        $city->name_ar = $request->get('name_ar');
        $isSaved = $city->save();
        if ($isSaved) {
            return response()->json(['icon' => 'success', 'title' => 'Create successfully'], 200);
        } else {
            return response()->json(['icon' => 'error', 'title' => 'Failed to create city'], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $isDeleted = City::destroy($id);
        if ($isDeleted) {
            return response()->json(['icon' => 'success', 'title' => 'City deleted successfully']);
        } else {
            return response()->json(['icon' => 'error', 'title' => 'Failed to delete city']);
        }
    }
}
