<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {

        if(empty($request->name) || empty($request->email) || empty($request->password)){
            return response()->json([
                'status'=>'error',
                'data'=>'Existen campos vaciós',

            ]);
        }
        $usuario=User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ]);
        $data=[
                'status'=>'success',
                'data'=>'Datos registrados exitosamente',
        ];
       return  response()->json($data);
    }

    public function login(){
        $credentials = request(['email', 'password']);
        if (Auth::attempt($credentials)) {
            $user=Auth::user();
            $data=[
                'status'=>'success',
                'user_id'=>$user->id
            ];
            return response()->json($data);

        }else{
            $data=[
                'status'=>'error',
                'data'=>'Mensaje Error'
            ];
            return  response()->json($data);
        }


    }

    public function logout(Request $request){


        Auth::logout();
        $data=[
            'status'=>'success',
            'data'=>'Exitoso'
        ];
        return response()->json($data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if(empty($request->id) || empty($request->name) || empty($request->email)
             || empty($request->birthdate) || empty($request->city) ){
            return response()->json([
                'status'=>'error',
                'data'=>'Existen campos vaciós',
            ]);
        }
        $usuario=User::find($request->id);
        $usuario->name=$request->name;
        $usuario->email=$request->email;
        $usuario->birthdate=$request->birthdate;
        $usuario->city=$request->city;
        $usuario->save();
        $data=[
            'status'=>'success',
            'data'=>'Datos actualizados exitosamente'
        ];
        return response()->json($data);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $usuario=User::find($id);
        $data=[
            'status'=>'success',
            'data'=>$usuario,
         ];
        return  response()->json($data);
    }
}
