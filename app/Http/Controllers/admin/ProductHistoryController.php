<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

use App\models\ProductHistory;
use App\User;
use Illuminate\Http\Request;

class ProductHistoryController extends Controller
{
    public function logged_user()
    {
        $user = new User();
        return  $user->logged_user();
    }
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\models\ProductHistory  $productHistory
     * @return \Illuminate\Http\Response
     */
    public function show(ProductHistory $productHistory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\models\ProductHistory  $productHistory
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductHistory $productHistory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\ProductHistory  $productHistory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductHistory $productHistory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\ProductHistory  $productHistory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductHistory $productHistory)
    {
        //
    }
}
