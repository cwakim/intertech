<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'posts';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['page_id', 'title', 'image', 'body'];

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

    public function page()
    {
        return $this->belongsTo('App\Page', 'page_id', 'id');
    }

}
