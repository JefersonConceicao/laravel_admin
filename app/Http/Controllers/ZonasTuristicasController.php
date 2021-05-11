<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ZonaTuristica; 
use App\Http\Requests\ZonaTuristicaRequest;

class ZonasTuristicasController extends Controller
{
    /**
     * @param string zona_turistica
     * @param string 'ativo | S ou N
     */

    public function index(Request $request){
        $zt = new ZonaTuristica;

        $view = view('zonas_turisticas.index')
            ->with('dataZT', $zt->getZT($request->all()));

        return request()->ajax() ? $view->renderSections()['content'] : $view;
    }

    public function create(){
        $zt = new ZonaTuristica;

        return view('zonas_turisticas.create')
            ->with('optionsZTPai', $zt->getListZT());
    }

    public function store(ZonaTuristicaRequest $request){
        $zt = new ZonaTuristica;

        $data = $zt->setZT($request->all());
        return response()->json($data);
    }

}
