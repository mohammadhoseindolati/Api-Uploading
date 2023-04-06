<?php

namespace Dolati\Uploader\Model;

use Illuminate\Database\Eloquent\Model;

class Uploader extends Model {

    protected $table = "uploader" ;
    protected $guarded = [] ;
    protected $hidden = [
        'id' , 'updated_at'
    ] ;
}
