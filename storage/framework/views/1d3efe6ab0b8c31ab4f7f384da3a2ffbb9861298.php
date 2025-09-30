

<?php $__env->startSection('title', 'Mis Tickets'); ?>

<?php $__env->startSection('content'); ?>
<h1 class="mb-4">Mis Tickets Asignados</h1>

<?php if(session('success')): ?>
    <div class="alert alert-success"><?php echo e(session('success')); ?></div>
<?php endif; ?>

<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Asunto</th>
            <th>Cliente</th>
            <th>Estado</th>
            <th>Acción</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($ticket->id); ?></td>
                <td><?php echo e($ticket->asunto); ?></td>
                <td><?php echo e($ticket->cliente->nombre); ?></td>
                <td>
                    <span class="badge 
                        <?php if($ticket->estado == 'nuevo'): ?> bg-primary 
                        <?php elseif($ticket->estado == 'en_proceso'): ?> bg-warning text-dark
                        <?php elseif($ticket->estado == 'en_espera'): ?> bg-info
                        <?php elseif($ticket->estado == 'resuelto'): ?> bg-success
                        <?php elseif($ticket->estado == 'cerrado'): ?> bg-secondary
                        <?php endif; ?>">
                        <?php echo e(ucfirst(str_replace('_',' ',$ticket->estado))); ?>

                    </span>
                </td>
                <td>
                    <a href="<?php echo e(route('tecnico.tickets.edit', $ticket->id)); ?>" class="btn btn-sm btn-primary">
                        Ver / Cambiar Estado
                    </a>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\soporte_proyecto\resources\views/tecnico/tickets/index.blade.php ENDPATH**/ ?>