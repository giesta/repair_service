<?php


namespace App;


use Illuminate\Database\Eloquent\Model;


class Device extends Model
{
    /**
     * The attributes that are mass assignable.
     *	
     * @var array
     */
    protected $fillable = [
        'name', 'detail', 'series_number','price', 'registration_date', 'repaired', 'taken_back', 'owner_id', 'repairer_id'
    ];
    public function repairers(){
        return $this->belongsTo('App\User', 'repairer_id');
    }
}