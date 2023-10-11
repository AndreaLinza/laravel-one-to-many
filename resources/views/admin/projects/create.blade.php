@extends('layouts.app')

@section('title', 'Nuova Repo - Laravel')

@section('content')
    <div class="container">
        <h1>Nuova Repo</h1>

        {{-- Utilizziamo l'include del file blade upsert per poter utilizzare un form in più pagine --}}
        @include('admin.projects.forms.upsert', [
            // assegniamo all'action la rotta da seguire al form
            'action' => route('admin.projects.store'),
            //assegniamo il method per utilizzarlo nel form
            'method' => 'POST',
            'project' => null,
        ])
    </div>
@endsection
