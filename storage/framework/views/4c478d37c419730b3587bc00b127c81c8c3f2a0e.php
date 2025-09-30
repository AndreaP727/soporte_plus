<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro - SoportePlus</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="d-flex justify-content-center align-items-center vh-100 bg-light">

    <div class="card shadow-lg p-4" style="width: 400px;">
        <h2 class="text-center mb-4">Registro de Usuario</h2>

        
        <?php if(session('success')): ?>
            <div class="alert alert-success"><?php echo e(session('success')); ?></div>
        <?php endif; ?>

        
        <form method="POST" action="<?php echo e(route('register')); ?>">
            <?php echo csrf_field(); ?>

            
            <div class="mb-3">
                <label class="form-label">Nombre completo</label>
                <input type="text" name="nombre" class="form-control" value="<?php echo e(old('nombre')); ?>" required>
                <?php $__errorArgs = ['nombre'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            
            <div class="mb-3">
                <label class="form-label">Correo electrónico</label>
                <input type="email" name="correo" class="form-control" value="<?php echo e(old('correo')); ?>" required>
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

            
            <div class="mb-3">
                <label class="form-label">Rol</label>
                <select name="rol" class="form-select" required>
                    <option value="" disabled selected>Selecciona un rol</option>
                    <option value="tecnico" <?php echo e(old('rol') == 'tecnico' ? 'selected' : ''); ?>>Técnico</option>
                    <option value="cliente" <?php echo e(old('rol') == 'cliente' ? 'selected' : ''); ?>>Cliente</option>
                </select>
                <?php $__errorArgs = ['rol'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            
            <button type="submit" class="btn btn-primary w-100">Registrarse</button>
        </form>

        
        <div class="mt-3 text-center">
            <a href="<?php echo e(route('login')); ?>">¿Ya tienes cuenta? Inicia sesión</a>
        </div>
    </div>

</body>
</html><?php /**PATH C:\xampp\htdocs\soporte_proyecto\resources\views/auth/register.blade.php ENDPATH**/ ?>