<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryPoint extends Model
{
    use HasFactory;

    public function getFullName()
    {
        return 'г. ' . $this->city . ". " . $this->address;
    }
}
