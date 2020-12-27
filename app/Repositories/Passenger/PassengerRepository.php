<?php
namespace App\Repositories\Passenger;

use App\Models\Passenger;
use App\Repositories\Passenger\PassengerRepositoryInterface;
use App\Repositories\BaseRepository;

class PassengerRepository extends BaseRepository implements PassengerRepositoryInterface
{

    public function __construct(Passenger $model)
    {
        parent::__construct($model);
    }

    /**
     * get passengers with their bookings
     * @return array
     */
    public function getWithBookings(): array
    {
        return $this->model->with('bookings')->get()->toArray();
    }

    /**
     * Delete all the passengers
     * @return void
     */
    public function deleteAll(): void
    {
        $this->model->get()->each->delete();
    }
}
