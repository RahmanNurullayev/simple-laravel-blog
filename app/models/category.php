<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    public function articleCount(){
    return $this->hasMany('App\models\Article','category_id','id')->where('status',1)->count(); 
}                           //baglanilacaq model //kat id  // yazi id
}