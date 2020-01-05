<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paste extends Model
{
    /**
     * В массиве указаны поля из БД разрешенные к массовому заполнению
     * @var array
     */
    protected $fillable = [
        'title',
        'paste',
        'expiration_time',
        'access',
    ];

    public static function index()
    {
        $allRecords = Paste::all();
        return $allRecords;
    }

    public static function showSingle($id)
    {
        $singlePaste = Paste::where('id',$id)->get();

        return $singlePaste;
    }

    public static function create(){
        $addString = new Paste;
        $addString->title = 'Title #'.time();
        $addString->paste = 'For example #'.time();
        $addString->expiration_time = '-1';
        $addString->access = '1';

        $addString->save();
    }
}
