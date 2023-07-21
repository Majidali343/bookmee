<!-- Start datatable js -->
<script src="<?php echo e(asset('assets/backend/js/jquery.dataTables.js')); ?>"></script>
<script src="<?php echo e(asset('assets/backend/js/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/backend/js/dataTables.bootstrap4.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/backend/js/dataTables.responsive.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/backend/js/responsive.bootstrap.min.js')); ?>"></script>
<?php if(!isset($nojs)): ?>
<script>
     (function($){
        "use strict";
        $(document).ready(function() {
            $('.table-wrap > table').DataTable( {
                "order": [[ 1, "desc" ]],
                'columnDefs' : [{
                    'targets' : 'no-sort',
                    "orderable" : false
                }]
            } );
        } );

    })(jQuery)
</script>
<?php endif; ?><?php /**PATH /var/www/vhosts/dazzling-edison.217-174-244-122.plesk.page/httpdocs/@core/resources/views/components/datatable/js.blade.php ENDPATH**/ ?>