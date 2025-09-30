<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class WebAuthController extends Controller
{
    // Mostrar formulario de registro
    public function showRegister()
    {
        return view('auth.register');
    }

    // Guardar nuevo usuario  
    public function register(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'correo' => 'required|email|unique:usuarios,correo',
            'contrasena' => 'required|min:6',
            'rol' => 'required|in:tecnico,cliente', // 🚫 admin no se puede crear desde registro
        ]);

        $data['contrasena'] = Hash::make($data['contrasena']);
        Usuario::create($data);

        return redirect()->route('login')
                         ->with('success', 'Usuario registrado correctamente. Ahora puedes iniciar sesión.');
    }

    // Mostrar formulario de login
    // Mostrar formulario de login
public function showLogin(Request $request)
{
    $rol = $request->query('rol'); // Captura ?rol=cliente, ?rol=tecnico, etc.
    return view('auth.login', compact('rol'));
}
    // Procesar login con validación de rol
    public function loginUser(Request $request)
    {
$credentials = $request->validate([
    'correo' => 'required|email',
    'contrasena' => 'required',
]);
        $user = Usuario::where('correo', $credentials['correo'])->first();

        if ($user && Hash::check($credentials['contrasena'], $user->contrasena)) {
            // Validar si el rol solicitado coincide con el del usuario
            if ($request->filled('rol') && $user->rol !== $request->rol) {
    return back()->withErrors(['correo' => 'No tienes permisos como ' . ucfirst($request->rol)]);
}

            // Guardar datos en sesión
            session([
                'usuario_id' => $user->id,
                'nombre' => $user->nombre,
                'rol' => $user->rol
            ]);

            // 🔎 Debug temporal para confirmar la sesión
            // dd(session()->all());

            // Redirigir según el rol
           if ($user->rol === 'cliente') {
    return redirect()->route('cliente.tickets.index');
} elseif ($user->rol === 'tecnico') {
    return redirect()->route('tecnico.tickets.index');
} else {
    return redirect()->route('admin.tickets.index');
}
        }

        return back()->withErrors(['correo' => 'Credenciales inválidas']);
    }

    // Cerrar sesión
    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect()->route('login')->with('success', 'Sesión cerrada correctamente.');
    }
}