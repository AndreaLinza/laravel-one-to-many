@extends('layouts.app')

@section('title', 'Repo - Show')

@section('content')

    <div class="container">


        <div class="card p-5 shadow">

            <h1>{{ $project->title }}</h1>
            <img class="" src="{{ asset('storage/'. $project->thumb) }}" alt="">
            <div class="card-body">


                <p class="card-text">{{ $project->description }}</p>
                <p>{{$project->type?->name}}</p>
                <a class="card-text" href="{{ url($project->link) }}">{{ $project->link }}</a><br>
                <small class="card-text">{{ $project->release->format('d/m/y') }}</small>
            </div>
            <div class="d-flex m-auto">
                <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary h-75 m-3">Indietro</a>
                <a href="{{ route('admin.projects.edit', $project->slug) }}" class="btn btn-primary m-3 h-75">Edit</a>
            </div>
        </div>

    </div>
@endsection
