<?php
namespace Dolati\Uploader ;
use Illuminate\Support\Facades\Facade;

class UploaderFacade extends Facade {

    protected static function getFacadeAccessor(): string
    {
        // return the service that we bind in register method in UploaderServiceProvider
        return 'uploader';
    }
}
