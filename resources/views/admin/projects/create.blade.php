@extends('layouts.app')

@section("content")

<div class="container">
    <h1>Nuovo Progetto</h1>

    <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
        @csrf()
        {{-- titolo --}}
        <div class="mb-3">
            <label class="form-label">Titolo</label><input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}">
            @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- immagine --}}
        <div class="mb-3">
            <label class="form-label">Immagine</label><input type="file" accept="image/*" class="form-control @error('image') is-invalid @enderror" name="image">
            @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- tipo --}}
        <div class="mb-3">
            <label class="form-label">Tipologia</label>
            <select class="form-select" name="type_id">
                @foreach ($types as $type)
                    <option value="{{ $type->id }}">{{$type->type}}</option>
                @endforeach
            </select>
        </div>

        {{-- descrizione --}}
        <div class="mb-3">
            <label class="form-label @error('description') is-invalid @enderror">Description</label>
                <textarea class="form-control" name="description">{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
        </div>
        
        <a class="btn btn-secondary" href="{{ route("admin.projects.index") }}">Annulla</a>
        <button class="btn btn-primary">Crea</button>
    </form>
</div>

@endsection