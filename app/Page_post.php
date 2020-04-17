<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page_post extends Model
{
    public function page()
    {
        return $this->belongsTo('App\Page');
    }
}
