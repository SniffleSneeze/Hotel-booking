<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $booking = Booking::with(['room.roomType', 'users:name'])->paginate(10);

        return view('bookings.index')
            ->with('bookings', $booking);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {
        $user = DB::table('users')->get()->pluck('name', 'id')->prepend('none');
        $rooms = DB::table('rooms')->get()->pluck('number', 'id');

        return view('bookings.create')
            ->with('users', $user)
            ->with('booking', (new Booking()))
            ->with('rooms', $rooms);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        /*$id = DB::table('bookings')->insertGetId([
            'room_id' => $request->input('room_id'),
            'start' => $request->input('start'),
            'end' => $request->input('end'),
            'is_reservation' => $request->input('is_reservation', false),
            'is_paid' => $request->input('is_paid', false),
            'notes' => $request->input('notes'),
        ]);*/

        $booking = Booking::create($request->input());

        /*DB::table('bookings_users')->insert([
            'booking_id' => $booking->id,
            'user_id' => $request->input('user_id'),
        ]);*/

        $booking->user()->attach($request->input('user_id'));

        return redirect()->action([BookingController::class, 'index']);
    }

    /**
     * Display the specified resource.
     *
     * @param Booking $booking
     * @return Application|Factory|View
     */
    public function show(Booking $booking)
    {
        return view('bookings.show', ['booking' => $booking]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Booking $booking
     * @return Application|Factory|View|Response
     */
    public function edit(Booking $booking)
    {
        $user = DB::table('users')->get()->pluck('name', 'id')->prepend('none');
        $rooms = DB::table('rooms')->get()->pluck('number', 'id');
        $bookingUser = DB::table('bookings_users')->where('booking_id', $booking->id)->first();

        return view('bookings.edit')
            ->with('users', $user)
            ->with('rooms', $rooms)
            ->with('booking', $booking)
            ->with('bookingUser', $bookingUser);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param Booking $booking
     * @return RedirectResponse
     */
    public function update(Request $request, Booking $booking)
    {
        /*DB::table('bookings')
            ->where('id', $booking->id)
            ->update([
            'room_id' => $request->input('room_id'),
            'start' => $request->input('start'),
            'end' => $request->input('end'),
            'is_reservation' => $request->input('is_reservation', false),
            'is_paid' => $request->input('is_paid', false),
            'notes' => $request->input('notes'),
        ]);*/

        $booking->fill($request->input());
        $booking->save();

        /*DB::table('bookings_users')
            ->where('booking_id', $booking->id)
            ->update([
            'user_id' => $request->input('user_id'),
        ]);*/

        $booking->users()->sync([$request->input('user_id')]);

        return redirect()->action([BookingController::class, 'index']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Booking $booking
     * @return RedirectResponse
     */
    public function destroy(Booking $booking)
    {
        /*DB::table('bookings_users')->where('booking_id', $booking->id)->delete();*/
        $booking->users()->detach();
        /*DB::table('bookings')->where('id', $booking->id)->delete();*/
        $booking->delete();

        return redirect()->action([BookingController::class, 'index']);

    }
}
