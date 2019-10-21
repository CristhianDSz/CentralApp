@if ($errors->any())
<div class="message is-danger">
    <div class="message-body">
        <ul>
            @foreach ($errors->all() as $error)
                <li class="is-size-7">{{$error}}</li>
            @endforeach
        </ul>
    </div>
</div>     
@endif