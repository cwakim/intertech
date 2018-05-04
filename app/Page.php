<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'pages';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['domain_id', 'link', 'language', 'location', 'location_name', 'category', 'area', 'frequency', 'next_visit_time', 'last_visit_time'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['next_visit_time', 'last_visit_time'];

    public function domain()
    {
        return $this->belongsTo('App\Domain', 'domain_id', 'id');
    }

    public function posts()
    {
        return $this->hasMany('App\Post', 'page_id', 'id');
    }

}
