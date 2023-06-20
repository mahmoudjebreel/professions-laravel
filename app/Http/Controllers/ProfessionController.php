<?php

namespace App\Http\Controllers;

use App\Models\Profession;
use App\Models\Speciality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProfessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $professions = Profession::with('speciality')->get();
        return response()->view('cms.professions.index', ['professions' => $professions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // $specilities = Speciality::where('active', true)->get();
        $specilities = Speciality::get();
        return response()->view('cms.professions.create', ['specialities' => $specilities]);
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
        // $request->validate([
        //     'title_en' => 'required|string|min:3|max:30',
        //     'title_ar' => 'required|string|min:3|max:30',
        //     'speciality_id' => 'required|exists:specialities,id|numeric',
        // ]);

        $validator = Validator($request->all(), [
            'title_en' => 'required|string|min:3|max:30',
            'title_ar' => 'required|string|min:3|max:30',
            'speciality_id' => 'required|exists:specialities,id|numeric',
        ]);
        if (!$validator->fails()) {
            $profession = new Profession();
            $profession->title_en = $request->get('title_en');
            $profession->title_ar = $request->get('title_ar');
            $profession->speciality_id = $request->get('speciality_id');
            $isSaved = $profession->save();
            return response()->json(['message' => $isSaved ? 'Created successfully' : "Failed to create"], $isSaved ? 201 : 400);
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Profession  $profession
     * @return \Illuminate\Http\Response
     */
    public function show(Profession $profession)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Profession  $profession
     * @return \Illuminate\Http\Response
     */
    public function edit(Profession $profession)
    {
        //
        $specilities = Speciality::all();
        return response()->view('cms.professions.edit', ['profession' => $profession, 'specialities' => $specilities]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profession  $profession
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profession $profession)
    {
        //
        $validator = Validator($request->all(), [
            'title_en' => 'required|string|min:3|max:30',
            'title_ar' => 'required|string|min:3|max:30',
            'speciality_id' => 'required|exists:specialities,id|numeric',
        ]);
        if (!$validator->fails()) {
            $profession->title_en = $request->get('title_en');
            $profession->title_ar = $request->get('title_ar');
            $profession->speciality_id = $request->get('speciality_id');
            $isSaved = $profession->save();
            return response()->json(['message' => $isSaved ? 'Updated successfully' : "Failed to update"], $isSaved ? 200 : 400);
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profession  $profession
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profession $profession)
    {
        //
        $isDeleted = $profession->delete();
        return response()->json(['message' => $isDeleted ? "Deleted successfully" : "Failed to delete"], $isDeleted ? 200 : 400);
    }
}
