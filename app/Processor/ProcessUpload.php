<?php

namespace App\Processor;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Image;

class ProcessUpload
{
    public function __construct($imageContent, array $params = [], $model = null)
    {
        $column = ! empty($params['column']) ? $params['column'] : 'avatar';
        $width = ! empty($params['width']) ? $params['width'] : 200;
        $path = ! empty($params['path']) ? trim($params['path'], '/') : 'assets';

        $filename = Str::uuid();

        // Define the path by which we will store the new image
        $fullFilename = $path . '/' . $filename;

        // Make, crop, resize and encode the newly uploaded image
        $image = Image::make($imageContent);
        $imageOriginalWidth = $image->width();

        if ($imageOriginalWidth > $width) {
            $image->widen($width);
        }

        $image->encode('png');

        // Store image w/Amazon S3
        Storage::put($fullFilename, (string) $image, 'public');

        if (! empty($model->{$column})) {
            Storage::delete($model->{$column});
        }

        // Merge the filename to column to request
        request()->merge([$column => $fullFilename]);
    }
}
