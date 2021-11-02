<?php

namespace App\Http\Controllers;

use App\Models\RoomType;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RoomTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('roomTypes.index')->with('roomTypes', RoomType::paginate());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param RoomType $roomType
     * @return Response
     */
    public function show(RoomType $roomType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param RoomType $roomType
     * @return Application|Factory|View
     */
    public function edit(RoomType $roomType)
    {
        return view('roomTypes.edit')->with('roomType', $roomType);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param RoomType $roomType
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, RoomType $roomType)
    {
        $roomType->picture = $request->file('picture')->store('public');
        $roomType->save();
        return redirect()->action([RoomTypeController::class, 'index']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param RoomType $roomType
     * @return Response
     */
    public function destroy(RoomType $roomType)
    {
        //
    }
}
