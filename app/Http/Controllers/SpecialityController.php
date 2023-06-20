<?php

namespace App\Http\Controllers;

use App\Models\Speciality;
use Illuminate\Http\Request;

class SpecialityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Speciality::withCount('professions')->get();
        return response()->view('cms.specialities.index', ['specialities' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return response()->view('cms.specialities.create');
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
            'title_en' => 'required|string|min:3|max:25',
            'title_ar' => 'required|string|min:3|max:25',
            'active' => 'in:on'
        ]);

        $speciality = new Speciality();
        $speciality->title_en = $request->get('title_en');
        $speciality->title_ar = $request->get('title_ar');
        $speciality->active = $request->has('active') ? true : false;
        $isSaved = $speciality->save();

        return redirect()->back();
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
        $speciality = Speciality::findOrFail($id);
        return response()->view('cms.specialities.create', ['speciality' => $speciality]);
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
            'title_en' => 'required|string|min:3|max:25',
            'title_ar' => 'required|string|min:3|max:25',
            'active' => 'in:on'
        ]);

        $speciality =  Speciality::findOrFail($id);
        $speciality->title_en = $request->get('title_en');
        $speciality->title_ar = $request->get('title_ar');
        $speciality->active = $request->has('active') ? true : false;
        $isSaved = $speciality->save();

        return redirect()->route('specialities.index');
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
        $isDeleted = Speciality::destroy($id);
        if ($isDeleted) {
            return response()->json(['icon' => 'success', 'title' => 'Deleted successfully'], 200);
        } else {
            return response()->json(['icon' => 'error', 'title' => 'Failed to delete'], 400);
        }
    }
}
