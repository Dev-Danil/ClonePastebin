<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use App\Paste;

class PastesController extends Controller
{
    /**
     * Просмотреть список всех записей (всех Паст)
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        $pastes = Paste::listAllRecords();
        $tenPastes = Paste::getTenLastPublicPastes();
        return view('list', compact('pastes', 'tenPastes'));
    }

    /**
     * Отдает определенную Пасту
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $paste = Paste::show($id);
        $tenPastes = Paste::getTenLastPublicPastes();
        if ($this->isAvailable($paste)) {
            return view('single', compact('paste', 'tenPastes'));
        } else {
            return view('stub', compact('tenPastes'));
        }
    }


    /**
     * Создание рандомной записи в бд (для заполнения БД пастами)
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(){
        Paste::create();
        $tenPastes = Paste::getTenLastPublicPastes();
        return view('welcome', compact('tenPastes'));
    }

    /**
     * Отобразить на экране страничку с формой
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add(){
        $tenPastes = Paste::getTenLastPublicPastes();
        return view('add', compact('tenPastes'));
    }

    /**
     * Схранение информации о новой строке
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request){
        //валидация принимаемых полей
        $this->validate($request,[
            'title' => 'required|max:255|string',
            'paste' => 'required',
            'expiration_time' => 'required',
            'access' => 'required'
        ]);

        $data = $request->all();

        $paste = new Paste();
        $paste->fill($data);    //заполнение модели информацией (массивом $data)
        $paste->save();     //сохранение модели

        return redirect('/');
    }

    /**
     * Проверка на право показа Пасты(по критериям: жизнь Пасты и access=public)
     * @param $paste
     * @return bool
     */
    public function isAvailable($paste)
    {
        foreach ($paste as $p) {
            $created = $p->created_at;
            $flag = false;
            switch ($p->expiration_time) {
                case -1:
                    $flag = true;
                    break;
                case 0.17:
                    $created->modify("+ 10 minute");
                    break;
                case 1:
                    $created->modify("+ 1 Hour");
                    break;
                case 24:
                    $created->modify("+ 1 Day");
                    break;
                case 168:
                    $created->modify("+ 1 Week");
                    break;
                case 730:
                    $created->modify("+ 1 Month");
                    break;
            }
        }

        $created = strtotime($created);
        $dateNow = strtotime(date("Y-m-d H:i:s"));

        if ($dateNow < $created || $flag) {
            return true;
        }

        return false;
    }
}
