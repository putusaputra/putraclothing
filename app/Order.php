<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $primaryKey = "order_id";
    
    // set primary key to string
    public $incrementing = false;
    protected $keyType = "string";
    /**
     * Set payment_status to Pending
     *
     * @return void
     */
    public function setPending() {
        $this->attributes['payment_status'] = 'pending';
        self::save();
    }

    /**
     * Set payment_status to Success
     *
     * @return void
     */
    public function setSuccess() {
        $this->attributes['payment_status'] = 'success';
        self::save();
    }

    /**
     * Set payment_status to Failed
     *
     * @return void
    */
    public function setFailed() {
        $this->attributes['payment_status'] = 'failed';
        self::save();
    }

    /**
    * Set payment_status to Expired
    *
    * @return void
    */
    public function setExpired() {
        $this->attributes['payment_status'] = 'expired';
        self::save();
    }

    public function user() {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

}
