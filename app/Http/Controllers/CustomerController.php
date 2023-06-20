<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $customers = Customer::all();
        return response()->view('cms.customers.index', ['customers' => $customers]);
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
        return response()->view('cms.customers.create', ['cities' => $cities]);
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
            'email' => 'required|email|unique:customers,email',
            'birth_date' => 'required|date',
            'gender' => 'required|string|max:1|in:M,F',
        ]);

        if (!$validator->fails()) {
            $admin = new Customer();
            $admin->email = $request->get('email');
            $admin->password = Hash::make("password");
            $isSaved = $admin->save();
            if ($isSaved) {
                $user = new User();
                $user->first_name = $request->get('first_name');
                $user->last_name = $request->get('last_name');
                $user->mobile = $request->get('mobile');
                $user->birth_date = $request->get('birth_date');
                $user->gender = $request->get('gender');
                $user->city_id = $request->get('city_id');
                $user->actor()->associate($admin);
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
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
        $cities = City::all();
        return response()->view('cms.customers.edit', ['customer' => $customer, 'cities' => $cities]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        //
        $validator = Validator($request->all(), [
            'city_id' => 'required|numeric|exists:cities,id',
            'first_name' => 'required|string|min:3|max:35',
            'last_name' => 'required|string|min:3|max:35',
            'mobile' => 'required|numeric',
            'email' => 'required|email|unique:customers,email,' . $customer->id,
            'birth_date' => 'required|date',
            'gender' => 'required|string|max:1|in:M,F',
        ]);

        if (!$validator->fails()) {
            $customer->email = $request->get('email');
            $customer->password = Hash::make("password");
            $isSaved = $customer->save();
            if ($isSaved) {
                $user = $customer->user;
                $user->first_name = $request->get('first_name');
                $user->last_name = $request->get('last_name');
                $user->mobile = $request->get('mobile');
                $user->birth_date = $request->get('birth_date');
                $user->gender = $request->get('gender');
                $user->city_id = $request->get('city_id');
                $user->actor()->associate($customer);
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
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
        $customer->user()->delete();
        $isDeleted = $customer->delete();
        return response()->json(['message' => $isDeleted ? "Deleted successfully" : "Failed to delete"], $isDeleted ? 200 : 400);
    }
}
