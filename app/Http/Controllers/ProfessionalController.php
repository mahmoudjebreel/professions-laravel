<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Profession;
use App\Models\Professional;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfessionalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $professionals = Professional::with('user')->get();
        return response()->view('cms.professionals.index', ['professionals' => $professionals]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $cities = City::all();
        $professions = Profession::where('active', true)->get();
        return response()->view('cms.professionals.create', ['cities' => $cities, 'professions' => $professions]);
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
        $validator = Validator($request->all(), [
            'city_id' => 'required|numeric|exists:cities,id',
            'first_name' => 'required|string|min:3|max:35',
            'last_name' => 'required|string|min:3|max:35',
            'mobile' => 'required|numeric',
            'birth_date' => 'required|date',
            'gender' => 'required|string|max:1|in:M,F',

            'email' => 'required|email|unique:professionals,email',
            'id_number' => 'required|numeric|digits:10|unique:professionals,id_number',
            'bio' => 'required|string|min:10|max:95',
            'experience_years' => 'required|integer',
            'address' => 'nullable|string',
            'profession_id' => 'required|numeric|exists:professions,id',
        ]);

        if (!$validator->fails()) {
            $professional = new Professional();
            $professional->email = $request->get('email');
            $professional->id_number = $request->get('id_number');
            $professional->bio = $request->get('bio');
            $professional->experience_years = $request->get('experience_years');
            $professional->address = $request->get('address');
            $professional->profession_id = $request->get('profession_id');
            $professional->password = Hash::make("password");
            $isSaved = $professional->save();
            if ($isSaved) {
                $user = new User();
                $user->first_name = $request->get('first_name');
                $user->last_name = $request->get('last_name');
                $user->mobile = $request->get('mobile');
                $user->birth_date = $request->get('birth_date');
                $user->gender = $request->get('gender');
                $user->city_id = $request->get('city_id');
                $user->actor()->associate($professional);
                $isSaved = $user->save();
                return response()->json(['message' => $isSaved ? "Saved successfully" : "Failed to save"], $isSaved ? 201 : 400);
            } else {
                return response()->json(['message' => "Failed to save"], 400);
            }
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Professional  $professional
     * @return \Illuminate\Http\Response
     */
    public function show(Professional $professional)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Professional  $professional
     * @return \Illuminate\Http\Response
     */
    public function edit(Professional $professional)
    {
        //
        $cities = City::all();
        $professions = Profession::where('active', true)->get();
        return response()->view('cms.professionals.edit', ['professional' => $professional, 'cities' => $cities, 'professions' => $professions]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Professional  $professional
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Professional $professional)
    {
        //
        $validator = Validator($request->all(), [
            'city_id' => 'required|numeric|exists:cities,id',
            'first_name' => 'required|string|min:3|max:35',
            'last_name' => 'required|string|min:3|max:35',
            'mobile' => 'required|numeric',
            'birth_date' => 'required|date',
            'gender' => 'required|string|max:1|in:M,F',

            'email' => 'required|email|unique:professionals,email,' . $professional->id,
            'id_number' => 'required|numeric|digits:10|unique:professionals,id_number,' . $professional->id,
            'bio' => 'required|string|min:10|max:95',
            'experience_years' => 'required|integer',
            'address' => 'nullable|string',
            'profession_id' => 'required|numeric|exists:professions,id',
        ]);

        if (!$validator->fails()) {
            $professional->email = $request->get('email');
            $professional->id_number = $request->get('id_number');
            $professional->bio = $request->get('bio');
            $professional->experience_years = $request->get('experience_years');
            $professional->address = $request->get('address');
            $professional->profession_id = $request->get('profession_id');
            $professional->password = Hash::make("password");
            $isSaved = $professional->save();
            if ($isSaved) {
                $user = $professional->user;
                $user->first_name = $request->get('first_name');
                $user->last_name = $request->get('last_name');
                $user->mobile = $request->get('mobile');
                $user->birth_date = $request->get('birth_date');
                $user->gender = $request->get('gender');
                $user->city_id = $request->get('city_id');
                $isSaved = $user->save();
                return response()->json(['message' => $isSaved ? "Saved successfully" : "Failed to save"], $isSaved ? 201 : 400);
            } else {
                return response()->json(['message' => "Failed to save"], 400);
            }
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Professional  $professional
     * @return \Illuminate\Http\Response
     */
    public function destroy(Professional $professional)
    {
        //
        $professional->user()->delete();
        $isDeleted = $professional->delete();
        return response()->json(['message' => $isDeleted ? "Deleted successfully" : "Failed to delete"], $isDeleted ? 200 : 400);
    }
}
