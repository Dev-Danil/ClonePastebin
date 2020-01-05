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
        $pastes = App\Paste::index();
        return view('list', compact('pastes'));
    }


    public function showSingle($id){
        $paste = App\Paste::showSingle($id);
        return view('single', compact('paste'));
    }


    /**
     * Создание рандомной записи в бд (для заполнения БД пастами)
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(){
        $pastes = App\Paste::create();
        return view('welcome', compact('pastes'));
    }

    /**
     * Отобразить на экране страничку с формой
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add(){
        return view('add');
    }

    /**
     * Схранение информации о новой строке
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request){
//        dump($request->all());//вывод массива передаваемых данных
        //валидация: поля обязательны к заполению
        $this->validate($request,[
            'title' => 'required|max:255',
            'paste' => 'required',
            'expiration_time' => 'required',
            'access' => 'required'
        ]);

        $data = $request->all();

//        dump($data);
        $paste = new Paste();
        $paste->fill($data);    //заполнение модели информацией (массивом $data)
        $paste->save();

//        dump($paste);

        return redirect('/');
    }
}
