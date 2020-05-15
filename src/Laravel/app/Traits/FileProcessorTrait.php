<?php

namespace App\Http\Traits;

use App\Exceptions\FileProcessorException;

trait FileProcessorTrait
{

    public function saveAttachment($file, $storagePath, $maxFileSize = 2)
    {
        $size = (int)$file->getSize() * 0.00000095367432; // in Mb.
        $size = number_format((float)$size, 2, '.', '');

        if ($size > $maxFileSize) { // 2MB
            throw new FileProcessorException("File exceeds max limit of {$maxFileSize}MB");

        }
        if (preg_match('@image/(png|jpeg|gif|svg\+xml)@', $file->getMimeType())) {
            return $file->storePublicly("public/$storagePath");
        } elseif (preg_match('@video/(mp4|mov)@', $file->getMimeType())) {
            return $file->storePublicly("public/$storagePath");
        } else {
            throw new FileProcessorException("Not a valid file");
        }
    }

}
