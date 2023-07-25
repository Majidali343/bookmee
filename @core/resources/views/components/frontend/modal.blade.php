@php
    use App\ServiceCity;
    $all_cities = ServiceCity::where('status', 1)->get();
@endphp


<style>
    .containe {
        padding: 6px 26px;
        font-family: 'Poppins';
        font-size: 16px;
        background: white;
        text-align: left;
        display: block;
        width: 27.5pc;
    }

    .outer {
        height: 300px;
        overflow-x: hidden;
        overflow-y: scroll;
    }
</style>

<input type="text" value={{ Session::get('cityid') }} name='checker' hidden>

<div class="modal" id='myModal' tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Select A City</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="outer">

                    @foreach ($all_cities as $cities)
                        <button class='containe' data-city-id="{{ $cities->id }}"> {{ $cities->service_city }}
                        </button>
                    @endforeach

                </div>



            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id='selecting' data-dismiss="modal">Select City</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@section('scripts')
    <script src="{{ asset('assets/backend/js/sweetalert2.js') }}"></script>
    <script>
        (function($) {
            "use strict";

            $(document).ready(function() {
                var checkerValue = $('input[name="checker"]').val();

                if (checkerValue) {

                } else {

                    $("#myModal").modal('show');
                }
            });
            var cityId;

            $(".containe").click(function() {
                // Get the city ID from the custom attribute data-city-id of the clicked button
                cityId = $(this).data("city-id");

            });


            $("#selecting").click(function() {

                if (cityId) {


                    $.ajax({
                        url: "{{ route('storeData') }}",
                        type: "POST",
                        data: {
                            '_token': '{{ csrf_token() }}',
                            'data': cityId
                        },
                        success: function(response) {
                            console.log(response.message);
                            window.location.href = window.location.href;
                        }


                    });

                }
            });







        })(jQuery);
    </script>
@endsection
