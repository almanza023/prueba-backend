<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Favorito;
use Illuminate\Http\Request;

class FavoritoController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(empty($request->id_usuario) || empty($request->ref_api)){
            return response()->json([
                'status'=>'error',
                'data'=>'Existen campos vaciós',

            ]);
        }
        $favorito=Favorito::create([
            'id_usuario'=>$request->id_usuario,
            'ref_api'=>$request->ref_api,
            'name'=>$request->name,
        ]);
        $data=[
                'status'=>'success',
                'data'=>'Datos registrados extisamente ',
        ];
       return  response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $favoritos=Favorito::getFavoritesByUser($id);
        $data=[
            'status'=>"success",
            'data'=>$favoritos,
         ];
        return  response()->json($data);
    }


}
