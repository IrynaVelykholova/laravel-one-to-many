@extends("layouts.app")

@section("content")
    <div class="container">
        <h3>{{ $project->title }}</h3>
        <img src="{{ asset('storage/' . $project->image) }}" alt="">
        <p>{{ $project->type->type }}</p>

        <p>{{ $project->description }}</p>
        <button type="button" class="btn btn-warning btn-aggiungi mb-3"><a href="{{ route('admin.projects.edit', $project->slug) }}">Modifica</a></button>

        <form action="{{ route('admin.projects.destroy', $project->slug) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Elimina</button>
        </form>
    </div>
@endsection