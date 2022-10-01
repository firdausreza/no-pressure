<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorepinRequest;
use App\Http\Requests\UpdatepinRequest;
use App\Models\Pin;
use Illuminate\Support\Facades\Redirect;

class PinController extends Controller
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
     * @param  \App\Http\Requests\StorepinRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StorepinRequest $request)
    {
        //
        foreach($request->all() as $key => $value) {
            $pin = new Pin();
            $pin->user_id = $value['user_id'];
            $pin->title = $value['title'];
            $pin->description = $value['description'];
            $pin->save();
        }
        return Redirect::to('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pin  $Pin
     * @return \Illuminate\Http\Response
     */
    public function show(Pin $Pin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pin  $Pin
     * @return \Illuminate\Http\Response
     */
    public function edit(Pin $Pin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatepinRequest  $request
     * @param  \App\Models\Pin  $Pin
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatepinRequest $request, Pin $Pin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pin  $Pin
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(mixed $id)
    {
        //
        $pin = Pin::query()->find($id);
        $pin->delete();
        return Redirect::to('/');
    }
}
