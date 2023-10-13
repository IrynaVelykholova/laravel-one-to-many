@extends("layouts.app")

@section("content")
    <div class="container">
        <h3 class="mt-5 mb-3">Progetti</h3>

        <button type="button" class="btn btn-primary btn-aggiungi mb-3"><a href="{{ route('admin.projects.create') }}">Aggiungi</a></button>

        <div class="row">
            @foreach ($projects as $project)
                <div class="col-4">
                    <a href="{{ route('admin.projects.show', $project->slug)}}">
                        <div class="card">
                            <h3>{{ $project->title }}</h3>
                            <img src={{ asset('storage/' . $project->image) }} alt="">
                        </div>
                    </a>
                </div>
            @endforeach

        </div>
    </div>


@endsection