@if($errors->any())
    <div class="alert alert-danger mt-4">
        <ul class="list-none">
            <button type="button btn-sm" class="close" data-dismiss="alert">×</button>
            @foreach($errors->all() as $error)
                <li> {{$error}}</li> 
            @endforeach
        </ul>
    </div>
@endif