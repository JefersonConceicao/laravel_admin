<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    /**
     * Prepara os dados do usuário
     *
     * @param Request query string filtro nome | active | setor
     * @return View usuarios.index
     */
    public function index(Request $request)
    {
        $user = new User;
        $data = $user->getUsers($request->all());
        
        return view('usuarios.index')
            ->with('dados', $data);
    }

    /**
     * Retorna view create
     *
     * @return View usuarios.create
     */
    public function create()
    {
        return view('usuarios.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
