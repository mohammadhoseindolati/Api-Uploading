<?php

namespace  Dolati\Uploader\Traits;


trait ApiResponser {

    public function successResponse($data , $code , $message = null){

        return response()->json([
            'result' => 'Success' ,
            'data' => $data ,
            'message' => $message
        ] , $code);

    }


    public function errorResponse($message , $code){

        return response()->json([
            'result' => 'Error' ,
            'message' => $message
        ] , $code);

    }
}
