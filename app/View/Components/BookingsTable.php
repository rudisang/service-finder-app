<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Booking;

class BookingsTable extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        $bookings = Booking::all();
        return view('components.bookings-table')->with('bookings',$bookings);
    }
}
