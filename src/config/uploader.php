<?php

return [

    // local - s3 - public
    'disk' => 'local' ,

    'directory' => 'files' ,


    //max Allow Size => Byte   1000byte = 1Kb  1000Kb = 1 Mb
    'maxAllowSize' => '10000000' ,

    'extensionAllow' => [ 'jpg' , 'png' , 'mp4' , 'pdf', 'rar' , 'zip' ]
] ;
