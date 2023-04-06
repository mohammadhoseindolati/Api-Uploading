<?php

namespace Dolati\Uploader\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Dolati\Uploader\Traits\ApiResponser;

class BaseController extends Controller {

    use ApiResponser;

    protected $uploadError ;
    protected $defaults ;


    public function handle(Request $request, $fieldName, $settings = [])
    {
        $settings = array_merge($this->defaults, $settings);

        $uploadedFile = $request->file($fieldName);

        if ($this->uploadValidate($uploadedFile, $settings)) {
            return $this->storeFile($uploadedFile, $settings);
        }

        return false;
    }

    protected function initializeDefaults(){

        $this->defaults = [

            'disk' => config('uploader.disk') ,

            'directory' => config('uploader.directory') ,

            'maxAllowSize' => config('uploader.maxAllowSize') ,

            'extensionAllow' => config('uploader.extensionAllow')

        ] ;
    }

    protected function uploadValidate(UploadedFile $uploadedFile, $settings)
    {
        if (!$uploadedFile->isValid()) {
            $this->uploadError = $uploadedFile->getErrorMessage();
            return false;
        }

        if (!in_array($this->getExtension($uploadedFile), $this->defaults['extensionAllow'])) {
            $this->uploadError = "Extension {$this->getExtension($uploadedFile)} is not allowed";
            return false;
        }

        if ($this->getFileSize($uploadedFile) > $settings['maxAllowSize']) {
            $this->uploadError = "An upload file cannot exceed {$settings['maxAllowSize']} bytes";
            return false;
        }

        return true;
    }

    protected function getExtension(UploadedFile $uploadedFile)
    {
        return strtolower($uploadedFile->getClientOriginalExtension());
    }

    protected function getFileSize(UploadedFile $uploadedFile)
    {
        return $uploadedFile->getSize();
    }

    protected function storeFile(UploadedFile $uploadedFile, $settings)
    {
        $subDirectory = $this->generatePath($uploadedFile);

        $storeLocation = $settings['directory'].DIRECTORY_SEPARATOR.$subDirectory;

        $path = $uploadedFile->store($storeLocation, $settings['disk']);

        $url = Storage::disk($settings['disk'])->url($path);

        return [
            'filename' => $this->getOriginName($uploadedFile),
            'path' => $path,
            'url' => $url,
            'disk' => $settings['disk']
        ];
    }

    protected function generatePath(UploadedFile $uploadedFile)
    {
        $originName = $this->getOriginName($uploadedFile);
        $uniqueString = uniqid(rand(), true)."_".$originName."_".getmypid()."_".gethostname()."_".time();
        return md5($uniqueString);
    }

    protected function getOriginName(UploadedFile $uploadedFile)
    {
        return $uploadedFile->getClientOriginalName();
    }
}
