<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión - SoportePlus</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="d-flex justify-content-center align-items-center vh-100 bg-light">

    <div class="card shadow-lg p-4" style="width: 400px;">
        <h2 class="text-center mb-4">Iniciar Sesión</h2>

        <!-- Mensajes de éxito o error -->
        <?php if(session('success')): ?>
            <div class="alert alert-success"><?php echo e(session('success')); ?></div>
        <?php endif; ?>

        <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <?php echo e($errors->first()); ?>

            </div>
        <?php endif; ?>

        <!-- Formulario de login -->
        <form method="POST" action="<?php echo e(route('loginUser')); ?>">
            <?php echo csrf_field(); ?>

            <!-- Campo oculto para el rol si viene de ?rol= -->
            <?php if(isset($rol) || request('rol')): ?>
                <input type="hidden" name="rol" value="<?php echo e($rol ?? request('rol')); ?>">
            <?php endif; ?>

            <div class="mb-3">
                <label class="form-label">Correo electrónico</label>
                <input type="email" name="correo" class="form-control" required>
                <?php $__errorArgs = ['correo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="mb-3">
                <label class="form-label">Contraseña</label>
                <input type="password" name="contrasena" class="form-control" required>
                <?php $__errorArgs = ['contrasena'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- Mostrar rol en modo lectura -->
            <?php if(isset($rol) || request('rol')): ?>
                <div class="mb-3">
                    <label class="form-label">Rol seleccionado</label>
                    <input type="text" class="form-control" value="<?php echo e(ucfirst($rol ?? request('rol'))); ?>" disabled>
                </div>
            <?php endif; ?>

            <button type="submit" class="btn btn-primary w-100">Ingresar</button>
        </form>

        <div class="mt-3 text-center">
            <a href="<?php echo e(route('home')); ?>">¿No tienes cuenta? Regístrate</a>
        </div>
    </div>

</body>
</html>
<?php /**PATH C:\xampp\htdocs\soporte_proyecto\resources\views/auth/login.blade.php ENDPATH**/ ?>