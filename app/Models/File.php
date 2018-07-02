<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = ['file_url', 'user_id'];
    public $table = "files";

    public static function getFile($fileUrl, $userId)
    {
        return $file = File::where('file_url', '=', $fileUrl)
            ->where('user_id', '=', $userId)->get()->toArray();
    }

    public static function store($fileUrl, $userId)
    {
        $file = self::getFile($fileUrl, $userId);
        if (!empty($file)) {
            return null;
        }
        $file = new File();
        $file->file_url = $fileUrl;
        $file->user_id = $userId;
        $file->save();
        return $file->toArray();
    }

    public function userData()
    {
        return $this->belongsTo('User', 'user_id', 'id');
    }

    public static function remove($id)
    {
        if (empty($id)) {
            return null;
        }

        $file = File::find($id);
        $file->delete();
        return $file;
    }

    public static function removeAllByUser($userId)
    {
        if (empty($usserId)) {
            return null;
        }

        $file = File::where('user_id', '=', $userId);
        $file->delete();
        return $file;
    }

    public static function getFilesByUser($userId)
    {
        if (empty($userId)) {
            return null;
        }

        return File::where('user_id', '=', $userId)->get();
    }
}
