

<?php $__env->startSection('title', 'Mis Tickets'); ?>

<?php $__env->startSection('content'); ?>
<h1 class="mb-4">Mis Tickets</h1>

<a href="<?php echo e(route('cliente.tickets.create')); ?>" class="btn btn-primary mb-3">Crear Ticket</a>

<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Asunto</th>
            <th>Categoría</th>
            <th>Prioridad</th>
            <th>Estado</th>
            <th>Fecha</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td>
    <a href="<?php echo e(route('cliente.tickets.show', $ticket->id)); ?>">
        <?php echo e($ticket->id); ?>

    </a>
</td>
                <td><?php echo e($ticket->asunto); ?></td>
                <td><?php echo e($ticket->categoria); ?></td>
                <td><?php echo e(ucfirst($ticket->prioridad)); ?></td>
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
                <td><?php echo e($ticket->created_at->format('d/m/Y H:i')); ?></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\soporte_proyecto\resources\views/cliente/tickets/index.blade.php ENDPATH**/ ?>