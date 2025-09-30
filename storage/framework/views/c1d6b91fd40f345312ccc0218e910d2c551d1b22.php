

<?php $__env->startSection('title', 'Crear Ticket'); ?>

<?php $__env->startSection('content'); ?>
<h1 class="mb-4">Crear Ticket</h1>

<form action="<?php echo e(route('cliente.tickets.store')); ?>" method="POST" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>

    <div class="mb-3">
        <label class="form-label">Asunto</label>
        <input type="text" name="asunto" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Categoría</label>
        <input type="text" name="categoria" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Prioridad</label>
        <select name="prioridad" class="form-select">
            <option value="baja">Baja</option>
            <option value="media">Media</option>
            <option value="alta">Alta</option>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Descripción</label>
        <textarea name="descripcion" class="form-control"></textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Adjunto</label>
        <input type="file" name="adjunto" class="form-control">
    </div>

    <button type="submit" class="btn btn-success">Crear</button>
    <a href="<?php echo e(route('cliente.tickets.index')); ?>" class="btn btn-secondary">Volver</a>
</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\soporte_proyecto\resources\views/cliente/tickets/create.blade.php ENDPATH**/ ?>