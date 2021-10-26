<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ShowRoomsController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return Application|Factory|\Illuminate\Contracts\View\View
     */
    public function __invoke(Request $request): View
    {
        $rooms = DB::table('rooms')->get();

        if($request->query('id') !== null) {
            $rooms = $rooms->where('room_type_id', $request->query('id'));
        }
        return view('rooms.index', ['rooms' => $rooms]);
    }
}
