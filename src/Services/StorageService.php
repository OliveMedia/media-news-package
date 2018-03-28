<?php
namespace OliveMedia\OliveMediaNews\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Config;

define('base_path', Config::get('media-news-package.base_aws_storage_path'));

class StorageService
{
    public static function store($file, $path = null, $access = 'public')
    {
        try {
            if (Config::get("media-news-package.storage_media") == "local") {
                return self::storeToLocalFileSystem($file, $path, $access = 'public');
            } else {
                return self::storeToS3Bucket($file, $path = null, $access = 'public');
            }

        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public static function deleteFile($filename)
    {
        try {
            if (Config::get("media-news-package.storage_media") == "local") {
                return self::deleteFromLocalFile($filename);
            } else {
                return self::deleteFromS3Bucket($filename);
            }

        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public static function storeToLocalFileSystem($file, $pathToUpload = null, $access = 'public')
    {
        $path = base_path($pathToUpload);
        $uploadUrl = url($pathToUpload);

        $extension = $file->getClientOriginalExtension();

        $fileName = time() . str_random(10) . '.' . $extension;

        $fullPath = $path . '/' . $fileName;

        $file->move($path, $fileName);

        return [
            'url' => $fullPath
        ];
    }

    public static function deleteFromLocalFile($filename)
    {
        if( file_exists($filename) && !empty($filename) ) {

            return unlink($filename);
        }

        return false;
    }

    public static function storeToS3Bucket($file, $path = null, $access = 'public')
    {
        $path = base_path . $path;
        $extension = $file->getClientOriginalExtension();

        $new_path = $path . '/' . $file->hashName() . '.' . $extension;

        Storage::disk('s3')->put($new_path, File::get($file), $access);

        $url = Storage::disk('s3')->url($new_path);

        return [
            'key' => $new_path,
            'url' => $url
        ];
    }

    public static function deleteFromS3Bucket($filename)
    {
        $fileArray = (explode('/', $filename));
        $path = base_path . '/' . end($fileArray);

        if(Storage::disk('s3')->exists($path)) {
            return (Storage::disk('s3')->delete($path));
        }
    }

    public static function get($file_name)
    {
        try {
            return Storage::disk('s3')->temporaryUrl($file_name, now()->addMinutes(5));
        } catch (\Exception $e) {
            return '/image/not-found.png';
        }

    }

    public static function exists($file_name)
    {
        return Storage::disk('s3')->exists($file_name);
    }

    public static function uuid()
    {
        return Str::orderedUuid();
    }
}
