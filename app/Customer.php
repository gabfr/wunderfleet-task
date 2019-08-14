<?php

namespace App;

use App\Events\CustomerWasCreated;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    /**
     * The primary key of this table
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * This variable indicates wether the primary key is incremental or not
     * @var bool
     */
    public $incrementing = false;

    /**
     * All the fields that are fillable inside this model/table
     * @var array
     */
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

    /**
     * Events to be dispatched when it occurs in this model
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => CustomerWasCreated::class,
    ];
}
