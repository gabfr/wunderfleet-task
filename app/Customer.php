<?php

namespace App;

use App\Events\CustomerWasCreated;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $primaryKey = 'id';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'firstName',
        'lastName',
        'telephone',
        'street',
        'streetNumber',
        'zipcode',
        'city',
        'accountOwner',
        'iban',
        'remotePaymentDataId',
    ];

    protected $dispatchesEvents = [
        CustomerWasCreated::class
    ];
}
