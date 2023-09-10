<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class authController extends Controller
{
    public function userProfile()
    {

        $usuario = Auth::guard('sanctum')->user();

        return \response()->json($usuario);
    }

    public function registro(Request $request)

    {
        $validator = Validator::make($request->all(), [
            "nombre" => "required",
            "correo" => "required|email",
            "password" => "required",
        ]);

        if ($validator->fails()) {
            return \response()->json($validator->errors(), 401);
        }

        $newUsuario = new User();
        $newUsuario->nombre = $request->nombre;
        $newUsuario->correo = $request->correo;
        $newUsuario->password = Hash::make($request->password);
        $newUsuario->save();

        return \response()->json($newUsuario);
    }

    public function udpate(Request $request, $id)

    {
        $usuario = User::find($id);
        if ($request->has("nombre")) {
            $usuario->nombre = $request->nombre;
        }
        if ($request->has("correo")) {
            $usuario->correo = $request->correo;
        }
        if ($request->has("password")) {
            $usuario->password = Hash::make($request->password);
        }

        $usuario->save();

        return \response()->json($usuario);
    }

    public function login(Request $request)

    {
        $validator = Validator::make($request->all(), [

            "correo" => "required|email",
            "password" => "required",
        ]);

        if ($validator->fails()) {
            return \response()->json($validator->errors(), 401);
        }

        if (Auth::attempt(['correo' => $request->correo, 'password' => $request->password])) {
            $usuario = Auth::user();
            $token = $usuario->createToken('token')->plainTextToken;
            return \response()->json([

                "usuario" => $usuario,
                "token" => $token,
            ]);
        } else {
            return \response()->json([

                "message" => "crednciuales invalidas",

            ]);
        }
    }

    public function logout()

    {
        $usuario = Auth::guard('sanctum')->user();
        $usuario->tokens()->delete();


        return \response()->json([

            "message" => "cerrado session correcto",

        ]);
    }
}
