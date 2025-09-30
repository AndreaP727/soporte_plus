

<?php $__env->startSection('title', 'Gestión de Usuarios'); ?>

<?php $__env->startSection('content'); ?>
<h1 class="mb-4">Gestión de Usuarios</h1>

<?php if(session('success')): ?>
    <div class="alert alert-success"><?php echo e(session('success')); ?></div>
<?php endif; ?>
<?php if($errors->any()): ?>
    <div class="alert alert-danger"><?php echo e($errors->first()); ?></div>
<?php endif; ?>

<!-- Crear nuevo usuario -->
<div class="card mb-4">
    <div class="card-header">Crear Usuario</div>
    <div class="card-body">
        <form method="POST" action="<?php echo e(route('admin.usuarios.store')); ?>">
            <?php echo csrf_field(); ?>
            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" name="nombre" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Correo</label>
                <input type="email" name="correo" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Contraseña</label>
                <input type="password" name="contrasena" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Rol</label>
                <select name="rol" class="form-select" required>
                    <option value="admin">Administrador</option>
                    <option value="tecnico">Técnico</option>
                    <option value="cliente">Cliente</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Crear</button>
        </form>
    </div>
</div>

<!-- Listado de usuarios -->
<div class="card">
    <div class="card-header">Usuarios Registrados</div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Rol</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $usuarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $usuario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($usuario->id); ?></td>
                        <td><?php echo e($usuario->nombre); ?></td>
                        <td><?php echo e($usuario->correo); ?></td>
                        <td><?php echo e(ucfirst($usuario->rol)); ?></td>
                        <td>
                            <?php if($usuario->rol !== 'admin'): ?>
                                <form action="<?php echo e(route('admin.usuarios.destroy', $usuario->id)); ?>" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar este usuario?');">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                </form>
                            <?php else: ?>
                                <span class="badge bg-secondary">Protegido</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="5" class="text-center">No hay usuarios registrados</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\soporte_proyecto\resources\views/admin/usuarios/index.blade.php ENDPATH**/ ?>