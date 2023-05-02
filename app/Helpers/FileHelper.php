<?php


namespace App\Helpers;

use Illuminate\Support\Facades\Storage;


class FileHelper
{
    public static function upload($request, $keyRequest, $customPath)
    {
        if ($request->hasFile($keyRequest)) {
            $photo = $request->file($keyRequest);
            $path = $photo->storeAs(
                $customPath, time() . $photo->getClientOriginalName()
            );
            return $path;
        }
    }

    public static function delete($image)
    {
        if (Storage::delete($image)) {
            return true;
        }
        return false;
    }
}
