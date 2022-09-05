<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catagory extends Model
{
    use HasFactory;

    public function section()
    {
        return $this->belongsTo('App\Models\Section','section_id')->select('id','name');
    }

    public function parentcatagory()
    {
        return $this->belongsTo('App\Models\Catagory','parent_id')->select('id','catagory_name');
    }

    public function subcatagories()
    {
        return $this->hasMany('App\Models\Catagory','parent_id')->where('status',0);
    }
}
