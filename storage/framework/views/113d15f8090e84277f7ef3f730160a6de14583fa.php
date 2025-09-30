

<?php $__env->startSection('title', 'Detalle Ticket'); ?>

<?php $__env->startSection('content'); ?>
<h1 class="mb-4">Ticket #<?php echo e($ticket->id); ?></h1>

<!-- Información principal -->
<div class="mb-3">
    <strong>Asunto:</strong> <?php echo e($ticket->asunto); ?> <br>
    <strong>Categoría:</strong> <?php echo e($ticket->categoria); ?> <br>
    <strong>Prioridad:</strong> <?php echo e(ucfirst($ticket->prioridad)); ?> <br>
    <strong>Estado:</strong> <?php echo e(ucfirst(str_replace('_',' ',$ticket->estado))); ?> <br>
    <strong>Descripción:</strong> <?php echo e($ticket->descripcion); ?>

</div>

<!-- Adjuntos -->
<div class="mb-3">
    <h5>📎 Archivos Adjuntos</h5>
    <?php $__empty_1 = true; $__currentLoopData = $ticket->adjuntos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $adjunto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <a href="<?php echo e(asset('storage/'.$adjunto->archivo_url)); ?>" target="_blank" class="d-block">
            📂 <?php echo e(basename($adjunto->archivo_url)); ?>

        </a>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <p>No hay adjuntos.</p>
    <?php endif; ?>
</div>

<hr>

<!-- Conversación -->
<h4>💬 Conversación</h4>
<div class="mb-3">
    <?php $__empty_1 = true; $__currentLoopData = $ticket->comentarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comentario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="border p-2 mb-2 rounded <?php if($comentario->usuario->rol === 'tecnico'): ?> bg-light <?php endif; ?>">
            <strong><?php echo e($comentario->usuario->nombre); ?> (<?php echo e(ucfirst($comentario->usuario->rol)); ?>):</strong>
            <p class="mb-1"><?php echo e($comentario->mensaje); ?></p>
            <small class="text-muted"><?php echo e($comentario->created_at->format('d/m/Y H:i')); ?></small>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <p>No hay comentarios aún.</p>
    <?php endif; ?>
</div>

<!-- Formulario para responder -->
<form method="POST" action="<?php echo e(route('cliente.tickets.comentar', $ticket->id)); ?>">
    <?php echo csrf_field(); ?>
    <div class="mb-3">
        <textarea name="mensaje" class="form-control" placeholder="Escribe tu respuesta..." required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Enviar Comentario</button>
    <a href="<?php echo e(route('cliente.tickets.index')); ?>" class="btn btn-secondary">Volver</a>
</form>

<hr>

<!-- Calificación de satisfacción -->
<?php if($ticket->estado == 'resuelto' && !$ticket->satisfaccion): ?>
    <h4 class="mt-4">⭐ Califica el servicio</h4>
    <form method="POST" action="<?php echo e(route('cliente.tickets.calificar', $ticket->id)); ?>">
        <?php echo csrf_field(); ?>
        <div class="mb-3">
            <select name="satisfaccion" class="form-select w-25" required>
                <option value="">Selecciona...</option>
                <option value="1">⭐ Malo</option>
                <option value="2">⭐⭐ Regular</option>
                <option value="3">⭐⭐⭐ Aceptable</option>
                <option value="4">⭐⭐⭐⭐ Bueno</option>
                <option value="5">⭐⭐⭐⭐⭐ Excelente</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Enviar Calificación</button>
    </form>
<?php elseif($ticket->satisfaccion): ?>
    <h4 class="mt-4">⭐ Tu Calificación</h4>
    <p class="fs-5"><?php echo e($ticket->satisfaccion); ?> / 5 estrellas</p>
<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\soporte_proyecto\resources\views/cliente/tickets/show.blade.php ENDPATH**/ ?>