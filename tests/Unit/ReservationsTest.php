<?php

namespace Tests\Unit;

use App\Models\Aircraft;
use App\Models\Passenger;
use App\Models\Reservation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReservationsTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed');
    }

    /** @test */
    public function a_reservation_can_be_done()
    {
        $aircraft = Aircraft::factory()->create();
        $passenger = Passenger::factory()->create();

        $seats = ['A', 'B', 'C', 'D' , 'E', 'F'];
        $rowSeat = $seats[array_rand($seats)];
        $rowNumber = rand(1,26);
        $aircraft->booking($passenger, $rowNumber, $rowSeat);

        $this->assertCount(1, Reservation::all());
        $reservation = Reservation::first();
        $this->assertEquals($aircraft->id, $reservation->aircraft_id);
        $this->assertEquals($passenger->id, $reservation->passenger_id);
        $this->assertEquals($rowNumber, $reservation->row_number);
        $this->assertEquals($rowSeat, $reservation->row_seat);
    }
}
