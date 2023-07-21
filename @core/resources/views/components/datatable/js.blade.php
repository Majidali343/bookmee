<!-- Start datatable js -->
<script src="{{asset('assets/backend/js/jquery.dataTables.js')}}"></script>
<script src="{{asset('assets/backend/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/backend/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/backend/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/backend/js/responsive.bootstrap.min.js')}}"></script>
@if(!isset($nojs))
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
@endif