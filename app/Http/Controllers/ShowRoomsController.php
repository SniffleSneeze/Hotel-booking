<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use App\Models\Room;

class ShowRoomsController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return Application|Factory|\Illuminate\Contracts\View\View
     */
    public function __invoke(Request $request, $roomType = null): View
    {
        /*if (isset($roomType)) {
            $rooms = Room::where('room_type_id', '=', $roomType)->get();
        } else {
            $rooms = Room::get();
        }*/

        $rooms = Room::byType($roomType)->get();

        return view('rooms.index', ['rooms' => $rooms]);
    }
}
