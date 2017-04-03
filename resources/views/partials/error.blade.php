@if($errors->any())
    <ul class="alert alert-danger" style="background-color: white;color: white;" >
        @foreach($errors->all() as $error)
            <li> {{ $error }} </li>
        @endforeach
    </ul>

    @endif