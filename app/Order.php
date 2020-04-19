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
     * Set status to Pending
     *
     * @return void
     */
    public function setPending() {
        $this->attributes['status'] = 'pending';
        self::save();
    }

    /**
     * Set status to Success
     *
     * @return void
     */
    public function setSuccess() {
        $this->attributes['status'] = 'success';
        self::save();
    }

    /**
     * Set status to Failed
     *
     * @return void
    */
    public function setFailed() {
        $this->attributes['status'] = 'failed';
        self::save();
    }

    /**
    * Set status to Expired
    *
    * @return void
    */
    public function setExpired() {
        $this->attributes['status'] = 'expired';
        self::save();
    }

    public function user() {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

}
