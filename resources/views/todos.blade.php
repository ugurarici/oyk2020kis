@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Yapılacaklar</div>

                <div class="card-body">

                    <div class="list-group">
                        @foreach($todos as $todo)
                        <a href="{{ route('todos.toggle', $todo) }}" class="list-group-item list-group-item-action">
                            @if($todo->completed_at) ✅ <del>@endif
                            {{ $todo->text }}
                            @if($todo->completed_at)</del>@endif
                        </a>
                        @endforeach
                    </div>

                    <form class="form-inline mt-2" action="{{ route('todos.store') }}" method="post">
                        @csrf
                        <input type="text" name="todo" class="form-control mb-2 mr-sm-2">
                        <button type="submit" class="btn btn-primary mb-2">Ekle</button>
                        @error('todo')
                            <br>{{ $message }}
                        @enderror
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
