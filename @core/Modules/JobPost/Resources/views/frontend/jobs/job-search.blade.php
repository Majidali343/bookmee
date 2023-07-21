
<script>
    (function($){
        "use strict";

        $(document).ready(function(){

            $(document).on('change','#search_by_category_job',function(e){
                e.preventDefault();
                $('#search_job_list_form').trigger('submit');
            })

            $(document).on('change','#search_by_subcategory_job',function(e){
                e.preventDefault();
                $('#search_job_list_form').trigger('submit');
            })

            $(document).on('change','#search_by_child_category_job',function(e){
                e.preventDefault();
                $('#search_job_list_form').trigger('submit');
            })

            $(document).on('change','#search_by_country_job',function(e){
                e.preventDefault();
                $('#search_job_list_form').trigger('submit');
            })

            $(document).on('change','#search_by_city_job',function(e){
                e.preventDefault();
                $('#search_job_list_form').trigger('submit');
            })

            $(document).on('change','#search_by_job_ad',function(e){
                e.preventDefault();
                $('#search_job_list_form').trigger('submit');
            })

            $(document).on('change','#search_by_sorting_job',function(e){
                e.preventDefault();
                $('#search_job_list_form').trigger('submit');
            })

            // Job search by text
            var oldSearchQ = '';
            $(document).on('keyup','#search_by_query',function(e){
                e.preventDefault();
                let qVal = $(this).val().trim();

                if(oldSearchQ !== qVal){
                    setTimeout(function (){
                        oldSearchQ = qVal.trim();
                        if(qVal.length > 2){
                            $('#search_job_list_form').trigger('submit');
                        }
                    },2000);
                }
            })

        });
    })(jQuery);
</script>

