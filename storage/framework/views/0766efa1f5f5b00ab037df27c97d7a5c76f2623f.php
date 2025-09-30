

<?php $__env->startSection('title', 'Asignar Técnico'); ?>

<?php $__env->startSection('content'); ?>
<h1 class="mb-4">Asignar Técnico al Ticket #<?php echo e($ticket->id); ?></h1>

<!-- Datos del Ticket -->
<div class="card mb-4">
    <div class="card-body">
        <p><strong>Asunto:</strong> <?php echo e($ticket->asunto); ?></p>
        <p><strong>Cliente:</strong> <?php echo e($ticket->cliente->nombre); ?></p>
        <p><strong>Estado actual:</strong> 
            <span class="badge 
                <?php if($ticket->estado == 'nuevo'): ?> bg-primary 
                <?php elseif($ticket->estado == 'en_proceso'): ?> bg-warning text-dark
                <?php elseif($ticket->estado == 'en_espera'): ?> bg-info
                <?php elseif($ticket->estado == 'resuelto'): ?> bg-success
                <?php elseif($ticket->estado == 'cerrado'): ?> bg-secondary
                <?php endif; ?>">
                <?php echo e(ucfirst(str_replace('_',' ',$ticket->estado))); ?>

            </span>
        </p>
    </div>
</div>

<!-- Formulario -->
<div class="card p-4">
    <form method="POST" action="<?php echo e(route('admin.tickets.asignar', $ticket->id)); ?>">
        <?php echo csrf_field(); ?>

        <div class="mb-3">
            <label class="form-label">Seleccionar Técnico</label>
            <select name="id_tecnico" class="form-select <?php $__errorArgs = ['id_tecnico'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                <option value="">-- Selecciona --</option>
                <?php $__currentLoopData = $tecnicos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tecnico): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($tecnico->id); ?>"><?php echo e($tecnico->nombre); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <?php $__errorArgs = ['id_tecnico'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="invalid-feedback"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <button type="submit" class="btn btn-success">Asignar</button>
        <a href="<?php echo e(route('admin.tickets.index')); ?>" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\soporte_proyecto\resources\views/admin/tickets/asignar.blade.php ENDPATH**/ ?>