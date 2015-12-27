<?php

namespace App\Models;

use System\Model\BaseModel;
use System\Model\Model;

class Rental extends BaseModel implements Model
{
    protected $table = 'rentals';

    /**
     * @return array
     */
    public function current()
    {
        return self::fetchAll($this->query(
            'SELECT *, rentals.created_at as rented_at, rentals.id as rental_id FROM rentals, dvds, users WHERE rentals.user_id = users.id AND rentals.dvd_id = dvds.id AND returned = 0', []
        ));
    }

    /**
     * @return array
     */
    public function returned()
    {
        return self::fetchAll($this->query(
            'SELECT *, rentals.created_at as rented_at, rentals.id as rental_id FROM rentals, dvds, users WHERE rentals.user_id = users.id AND rentals.dvd_id = dvds.id AND returned = 1', []
        ));
    }

    /**
     * @param $rentalId
     * @return void
     */
    public function returnDvd($rentalId)
    {
        $rental = $this->getById($rentalId);

        if (!empty($rental)) {
            $this->query('UPDATE ' . $this->getTable() . ' SET returned = 1 WHERE id = ? LIMIT 1', [$rentalId]);
            $this->query('UPDATE dvds SET rented = 0 WHERE id = ? LIMIT 1', [$rental->dvd_id]);
        }

    }
}