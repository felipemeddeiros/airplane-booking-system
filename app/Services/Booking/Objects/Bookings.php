<?php

namespace App\Services\Booking\Objects;

use App\Services\Booking\Objects\Row;
use App\Services\Booking\Rules\RulesFiveSeats;
use App\Services\Booking\Rules\RulesFourSeats;
use App\Services\Booking\Rules\RulesOneSeat;
use App\Services\Booking\Rules\RulesSevenSeats;
use App\Services\Booking\Rules\RulesSixSeats;
use App\Services\Booking\Rules\RulesThreeSeats;
use App\Services\Booking\Rules\RulesTwoSeats;

class Bookings
{
    use RulesOneSeat, RulesTwoSeats, RulesThreeSeats, RulesFourSeats, RulesFiveSeats, RulesSixSeats,
        RulesSevenSeats;

    /**
     * First Object Row
     * @var Row
     */
    protected $row;

    /**
     * Books made per passenger
     * @var array
     */
    protected $passengerBooked = [];

    /**
     * The chairs configuration
     * @var array
     */
    private $chairs = [
        'A' => 1, 'B' => 2, 'C' => 3, 'F' => 6, 'E' => 5, 'D' => 4,
    ];

    public function __construct(array $aircraft)
    {
        $this->row = new Row(1, $this->chairs, $aircraft['rows'], $aircraft['bookings']);
    }

    /**
     * doing the bookings
     * @param  int    $quantityOfSeats
     * @return array
     */
    public function book(int $quantityOfSeats): array
    {
        $this->passengerBooked = [];

        $i = 0;
        do {

            $this->goThrough($this->row, $quantityOfSeats);
            $i++;

        } while ($i < $quantityOfSeats && sizeof($this->passengerBooked) < $quantityOfSeats);

        return $this->passengerBooked;
    }

    /**
     * go through the rows to book the seats according to the number of seats requested
     * @param  Row  $row
     * @param  int  $seatsRequested
     * @return void
     */
    private function goThrough(Row $row, int $seatsRequested): void
    {
        switch ($seatsRequested) {
            case 1:
                $this->findAseatOnWindow($row->seats, $row->nextRow);
                break;
            case 2:
                $this->findTwoSeats($row->seats, $row->nextRow);
                break;
            case 3:
                $this->findThreeSeats($row->seats, $row->nextRow);
                break;
            case 4:
                $this->findFourSeats($row->seats, $row->nextRow);
                break;
            case 5:
                $this->findFiveSeats($row->seats, $row->nextRow);
                break;
            case 6:
                $this->findSixSeats($row->seats, $row->nextRow);
                break;
            case 7:
                $this->findSevenSeats($row->seats, $row->nextRow);
                break;
        }
    }

    /**
     * Marking the seats as occupied
     * @param  array  $seats
     * @return void
     */
    private function occupy(array $seats): void
    {
        foreach ($seats as $seat) {
            $seat->occupied          = true;
            $this->passengerBooked[] = $seat;
        }
    }
}
