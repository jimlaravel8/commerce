<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;

use App\models\Billingaddress;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BillingaddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $billingaddress = Billingaddress::firstOrCreate(
            ['user_id' => Auth::id()],
            [
                'name' => $request->name,
                'country' => $request->country,
                'street_address' => $request->street_address,
                'town' => $request->town,
                'county' => $request->county,
                'postal_code' => $request->postal_code,
                'phone' => $request->phone,
                'email' => $request->email,
            ]
        );
        // $billingaddress = new Billingaddress;
        // $billingaddress->user_id = Auth::id();
        // $billingaddress->name = $request->name;
        // $billingaddress->street_address = $request->street_address;
        // $billingaddress->town = $request->town;
        // $billingaddress->county = $request->county;
        // $billingaddress->postal_code = $request->postal_code;
        // $billingaddress->phone = $request->phone;
        // $billingaddress->email = $request->email;
        // $billingaddress->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\models\Billingaddress  $billingaddress
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Auth::user()->billing;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\Billingaddress  $billingaddress
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // return Auth::id();
        $billingaddress = User::find(Auth::id())->billing;
        // return $billingaddress;
        if ($billingaddress) {
            $billingaddress = Billingaddress::where('user_id', $id)->first();
        } else {
            $billingaddress =new  Billingaddress;

        }

        // $user = Auth::user();
        // $user->attach()->billing();


        $billingaddress->user_id = $id;
        $billingaddress->name = $request->name;
        $billingaddress->street_address = $request->street_address;
        $billingaddress->town = $request->town;
        $billingaddress->county = $request->county;
        $billingaddress->country = $request->country;
        $billingaddress->postal_code = $request->postal_code;
        $billingaddress->phone = $request->phone;
        $billingaddress->email = $request->email;
        $billingaddress->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\Billingaddress  $billingaddress
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Billingaddress::find($id)->delete();
    }
}
