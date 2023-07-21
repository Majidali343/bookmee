<!-- Start datatable js -->
<script src="<?php echo e(asset('assets/backend/js/jquery.dataTables.js')); ?>"></script>
<script src="<?php echo e(asset('assets/backend/js/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/backend/js/dataTables.bootstrap4.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/backend/js/dataTables.responsive.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/backend/js/responsive.bootstrap.min.js')); ?>"></script>
<?php if(!isset($only_js)): ?>
    <script>
        (function($){
            "use strict";
            $('.table-wrap > table').DataTable( {
                "order": [[ 2, "desc" ]],
                'columnDefs' : [{
                    'targets' : 'no-sort',
                    'orderable' : false
                }]
            } );

        })(jQuery);
    </script>
<?php endif; ?><?php /**PATH /var/www/vhosts/dazzling-edison.217-174-244-122.plesk.page/httpdocs/@core/resources/views/backend/partials/datatable/script-enqueue.blade.php ENDPATH**/ ?>