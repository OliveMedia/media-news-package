<?php
namespace OliveMedia\OliveMediaNews\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Config;

define('base_path', 'connectedrms');

class StorageService
{
    public static function store($file, $path = null, $access = 'public')
    {
        try {
            if (Config::get("OliveMediaNews.storage_media") == "local") {
                return self::storeToLocalFileSystem($file, $path, $access = 'public');
            } else {
                return self::storeToS3Bucket($file, $path = null, $access = 'public');
            }

        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public static function storeToLocalFileSystem($file, $path = null, $access = 'public')
    {
        $path = public_path($path);
        $extension = $file->getClientOriginalExtension();

        $fileName = time() . str_random(10) . '.' . $extension;

        $fullPath = $path . '/' . $fileName;

        $file->move($path, $fileName);

        return [
            'url' => $fullPath
        ];
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
