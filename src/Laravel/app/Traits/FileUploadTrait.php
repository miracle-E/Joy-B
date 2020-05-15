<?php

namespace App\Traits;

use App\Category;
use App\Media;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Exceptions\FileProcessorException;

trait FileUploadTrait
{
    public function saveAttachment($file, $storagePath, $maxFileSize = 200)
    {
        $size = (int)$file->getSize() * 0.00000095367432; // in Mb.
        $size = number_format((float)$size, 2, '.', '');

        if ($size > $maxFileSize) { // 2MB
            return null;
        }
        if (preg_match('@image/(png|jpeg|gif|svg\+xml)@', $file->getMimeType())) {
            return $file->storePublicly("public/$storagePath");
        } elseif (preg_match('@video/(mp4|mov)@', $file->getMimeType())) {
            return $file->storePublicly("public/$storagePath");
        } else {
            return null;
        }
    }
}
  