<?php

return [

    // local - s3 - public
    'disk' => 'local' ,

    'directory' => 'files' ,


    //max Allow Size => Byte
    'maxAllowSize' => '10000000' ,

    'extensionAllow' => [ 'jpg' , 'png' , 'mp4' , 'pdf', 'rar' , 'zip' ]
] ;
