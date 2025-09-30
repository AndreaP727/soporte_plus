

<?php $__env->startSection('title', 'Dashboard Admin'); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <!-- Sidebar -->
    <div class="col-md-3">
        <div class="list-group">
            <a href="<?php echo e(route('admin.tickets.index')); ?>" class="list-group-item list-group-item-action">📋 Tickets</a>
            <a href="<?php echo e(route('admin.dashboard')); ?>" class="list-group-item list-group-item-action active">📊 Estadísticas</a>
            <a href="<?php echo e(route('admin.reportes.csv')); ?>" class="list-group-item list-group-item-action">⬇️ Exportar CSV</a>
            <a href="<?php echo e(route('admin.reportes.pdf')); ?>" class="list-group-item list-group-item-action">⬇️ Exportar PDF</a>
            <a href="<?php echo e(route('admin.reportes.excel')); ?>" class="list-group-item list-group-item-action">⬇️ Exportar Excel</a>
        </div>
    </div>

    <!-- Contenido principal -->
    <div class="col-md-9">
        <h2>Estadísticas del sistema</h2>

        <div class="row mt-4">
            <div class="col-md-3">
                <div class="card text-bg-primary text-center">
                    <div class="card-body">
                        <h4><?php echo e($totalTickets); ?></h4>
                        <p>Total Tickets</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-bg-warning text-center">
                    <div class="card-body">
                        <h4><?php echo e($abiertos); ?></h4>
                        <p>Abiertos</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-bg-success text-center">
                    <div class="card-body">
                        <h4><?php echo e($cerrados); ?></h4>
                        <p>Cerrados</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-bg-info text-center">
                    <div class="card-body">
                        <h4><?php echo e(round($tiempoResolucion,1) ?? 'N/A'); ?></h4>
                        <p>Horas promedio</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\soporte_proyecto\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>