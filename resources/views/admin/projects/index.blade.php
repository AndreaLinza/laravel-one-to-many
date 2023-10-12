@extends('layouts.app')

@section('title', 'Laravel - Index')

@section('content')
    <div class="container">

        <h1>Prova</h1>
        <div class="card p-5">

            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 border p-4 rounded shadow-lg mt-3 g-4">
                @foreach ($projects as $project)
                    <div class="col">
                        <a class="nav-link" href="{{ route('admin.projects.show', $project->slug) }}">
                            <div class="card h-100">
                                <img src="{{ asset('storage/'. $project->thumb) }}" class="card-img-top h-100" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $project->title }}</h5>
                                    <p class="card-text">{{ $project->short_description }}</p>
                                    <p class="badge"  style="background-color: rgb({{$project->type->color}})">{{$project->type?->name}}</p>
                                    <p class="card-text">{{--{{ implode(', ', $project->language) }}--}}</p>
                                    <a href="{{ $project->link }}" class="">Link</a>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="py-5">
            <a class="btn btn-outline-success" style="margin-left:50%; transform:translateX(-50%)"
                href="{{ route('admin.projects.create') }}">
                Add Repo
            </a>
        </div>
    </div>
@endsection
