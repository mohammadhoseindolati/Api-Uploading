<?php

namespace  Dolati\Uploader\Controllers;

use Dolati\Uploader\Requests\StoreFileValidation;
use Dolati\Uploader\Model\Uploader;
use Illuminate\Http\Request;

class UploaderController extends BaseController
{

    public function store(StoreFileValidation $request){

        $this->initializeDefaults();

        $result = $this->handle($request , 'image' , [] );

        if($result){

            return $this->successResponse($result , "200") ;

        }else{

            return $this->errorResponse($this->uploadError , "400" );
        }
    }
}
