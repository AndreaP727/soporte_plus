

<?php $__env->startSection('title', 'Actualizar Ticket'); ?>

<?php $__env->startSection('content'); ?>
<h1 class="mb-4">Ticket #<?php echo e($ticket->id); ?></h1>

<div class="mb-3">
    <strong>Cliente:</strong> <?php echo e($ticket->cliente->nombre); ?> <br>
    <strong>Asunto:</strong> <?php echo e($ticket->asunto); ?> <br>
    <strong>Descripción:</strong> <?php echo e($ticket->descripcion); ?>

</div>

<div class="mb-3">
    <strong>Estado actual:</strong>
    <span class="badge 
        <?php if($ticket->estado == 'nuevo'): ?> bg-primary 
        <?php elseif($ticket->estado == 'en_proceso'): ?> bg-warning text-dark
        <?php elseif($ticket->estado == 'en_espera'): ?> bg-info
        <?php elseif($ticket->estado == 'resuelto'): ?> bg-success
        <?php elseif($ticket->estado == 'cerrado'): ?> bg-secondary
        <?php endif; ?>">
        <?php echo e(ucfirst(str_replace('_',' ',$ticket->estado))); ?>

    </span>
</div>

<div class="mb-3">
    <h5>Adjuntos del cliente:</h5>
    <?php $__empty_1 = true; $__currentLoopData = $ticket->adjuntos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $adjunto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <a href="<?php echo e(asset('storage/'.$adjunto->archivo_url)); ?>" target="_blank" class="d-block">
            📎 <?php echo e(basename($adjunto->archivo_url)); ?>

        </a>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <p>No hay adjuntos.</p>
    <?php endif; ?>
</div>

<form method="POST" action="<?php echo e(route('tecnico.tickets.update', $ticket->id)); ?>">
    <?php echo csrf_field(); ?>
    <div class="mb-3">
        <label class="form-label">Cambiar Estado</label>
        <select name="estado" class="form-select" required>
            <option value="en_proceso" <?php echo e($ticket->estado == 'en_proceso' ? 'selected' : ''); ?>>En Proceso</option>
            <option value="en_espera" <?php echo e($ticket->estado == 'en_espera' ? 'selected' : ''); ?>>En Espera</option>
            <option value="resuelto" <?php echo e($ticket->estado == 'resuelto' ? 'selected' : ''); ?>>Resuelto</option>
            <option value="cerrado" <?php echo e($ticket->estado == 'cerrado' ? 'selected' : ''); ?>>Cerrado</option>
        </select>
    </div>
    <button type="submit" class="btn btn-success">Actualizar Estado</button>
</form>

<hr>

<h4>Comentarios</h4>
<div class="mb-3">
    <?php $__empty_1 = true; $__currentLoopData = $ticket->comentarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comentario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="border p-2 mb-2 <?php echo e($comentario->usuario->rol == 'tecnico' ? 'bg-light' : ''); ?>">
            <strong><?php echo e($comentario->usuario->nombre); ?> (<?php echo e(ucfirst($comentario->usuario->rol)); ?>):</strong> 
            <?php echo e($comentario->mensaje); ?>

            <br>
            <small class="text-muted"><?php echo e($comentario->created_at->format('d/m/Y H:i')); ?></small>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <p>No hay comentarios aún.</p>
    <?php endif; ?>
</div>

<form method="POST" action="<?php echo e(route('tecnico.tickets.comentar', $ticket->id)); ?>">
    <?php echo csrf_field(); ?>
    <div class="mb-3">
        <textarea name="mensaje" class="form-control" placeholder="Escribe un comentario..." required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Agregar Comentario</button>
</form>

<a href="<?php echo e(route('tecnico.tickets.index')); ?>" class="btn btn-secondary mt-3">Volver</a>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\soporte_proyecto\resources\views/tecnico/tickets/edit.blade.php ENDPATH**/ ?>