<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    // Listar usuarios
    public function index()
    {
        $usuarios = Usuario::all();
        return view('admin.usuarios.index', compact('usuarios'));
    }

    // Crear nuevo usuario
    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'correo' => 'required|email|unique:usuarios,correo',
            'contrasena' => 'required|min:6',
            'rol' => 'required|in:admin,tecnico,cliente',
        ]);

        // Encriptar contraseña
        $data['contrasena'] = Hash::make($data['contrasena']);

        Usuario::create($data);

        return redirect()->route('admin.usuarios.index')->with('success', 'Usuario creado correctamente');
    }

    // Eliminar usuario (menos admin)
    public function destroy($id)
    {
        $usuario = Usuario::findOrFail($id);

        if ($usuario->rol === 'admin') {
            return redirect()->back()->withErrors('El administrador no puede ser eliminado');
        }

        $usuario->delete();
        return redirect()->route('admin.usuarios.index')->with('success', 'Usuario eliminado correctamente');
    }
}