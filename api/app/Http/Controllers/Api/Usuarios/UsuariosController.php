<?php

namespace App\Http\Controllers\Api\Usuarios;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Usuario\Usuario;

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Usuario::where('ch_excluido', '0')->orderBy('sr_id', 'ASC')->get();
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $usuario = new Usuario;

        $usuario->vc_nome = $request->vc_nome ;
        $usuario->vc_login = $request->vc_login;
        $usuario->vc_email = $request->vc_email ;
        $usuario->vc_senha =$request->vc_senha;

        $usuario->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //return Usuario::find($id);
        return Usuario::where('sr_id', $id)->where('ch_excluido', '0')->get();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Usuario $usuario, Request $request)
    {
        $usuario->vc_nome = $request->vc_nome ;
        $usuario->vc_email = $request->vc_email;

        $usuario->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $usuario = Usuario::find($id);
        $usuario->ch_excluido = '1';
        $usuario->save();

        
     
    }
}
