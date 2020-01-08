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
        'hash',
    ];

    /**
     * Отдает список всех записей
     * @return Paste[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function listAllRecords()
    {
        $allRecords = Paste::all();
        return $allRecords;
    }

    /**
     * Отдает 1 запись по hash
     * @param $hash
     * @return mixed
     */
    public static function show($hash)
    {
        $singlePaste = Paste::where('hash', $hash)->get();

        return $singlePaste;
    }

    /**
     * Создание рандомной записи в бд (для заполнения БД пастами)
     */
    public static function create(){
        $addString = new Paste;
        $realTime = time();
        $addString->title = 'Title #' . $realTime;
        $addString->paste = 'For example #' . $realTime;
        $addString->expiration_time = '-1';
        $addString->access = '1';
        $addString->hash = mb_strcut(hash('md5', $realTime), strlen($realTime) - 8, 8);

        $addString->save();
    }

    /**
     * Возвращает 10 последних публичных записей
     * @return mixed
     */
    public static function getTenLastPublicPastes()
    {
        $p = Paste::where('access', 1)
            ->orderBy('id', 'desc')
            ->take(10)
            ->get();

        return $p;
    }
}
