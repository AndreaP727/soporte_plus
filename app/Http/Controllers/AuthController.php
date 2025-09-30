<?php
namespace App\Http\Controllers;


use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
public function register(Request $request)
{
$data = $request->validate([
'nombre'=>'required|string',
'correo'=>'required|email|unique:usuarios,correo',
'contrasena'=>'required|min:6',
'rol'=>'nullable|in:cliente,tecnico,admin'
]);
$data['contrasena'] = Hash::make($data['contrasena']);
$user = Usuario::create($data);
return response()->json(['user'=>$user],201);
}


public function login(Request $request)
{
$creds = $request->validate(['correo'=>'required|email','contrasena'=>'required']);
$user = Usuario::where('correo',$creds['correo'])->first();
if (!$user || !Hash::check($creds['contrasena'],$user->contrasena)) {
return response()->json(['message'=>'Credenciales inválidas'],401);
}
// token simple (no sanctum) - para ejemplo dev
$token = bin2hex(random_bytes(40));
// en un proyecto real usar Laravel Sanctum/Passport
return response()->json(['user'=>$user,'token'=>$token]);
}
}