<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RolesController extends Controller
{
    public function index()
    {

        $roles = Roles::all();

        return \response()->json($roles);
    }

    public function show($id)
    {

        $roles = Roles::find($id);
        if (!$roles) {
            return \response()->json("no existe rol");
        }
        return \response()->json($roles);
    }

    public function store(Request $request)

    {
        $validator = Validator::make($request->all(), [
            "nombre" => "required|unique:roles,nombre",

        ]);

        if ($validator->fails()) {
            return \response()->json($validator->errors(), 401);
        }

        $newRol = new Roles();
        $newRol->nombre = $request->nombre;
        $newRol->save();

        return \response()->json($newRol);
    }

    public function udpate(Request $request, $id)

    {
        $rol = Roles::find($id);
        if ($request->has("nombre")) {
            $rol->nombre = $request->nombre;
        }


        $rol->save();

        return \response()->json($rol);
    }

    public function destroy($id)
    {

        $roles = Roles::find($id);
        if (!$roles) {
            return \response()->json("no existe rol");
        }
        $roles->delete();
        return \response()->json('eliminado correctamente');
    }
}
