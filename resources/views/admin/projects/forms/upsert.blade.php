<form action="{{ $action }}" method="POST" enctype="multipart/form-data"> {{-- questo è essenziale affinchè il nostro form possa ricevere il file sottoforma di file  --}}
    @csrf()
    @method($method)

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>

    @endif

    {{-- Title --}}

    <div class="mb-3">
        <label for="title">Titolo Repo</label>
        <input type="text" name="title" value="{{ old('title', $project?->title) }}"
            class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Inserisci il titolo">
        @error('title')
            <div class="invalid_feedback text-danger">{{ $message }}</div>
        @enderror
    </div>

    {{-- Description --}}

    <div class="mb-3">
        <label for="description">Descrizione</label>
        <textarea name="description" style="height: 200px" class="form-control @error('description') is-invalid @enderror"
            id="description" placeholder="Inserisci la descrizione">{{ old('description', $project?->description) }}</textarea>
        @error('description')
            <div class="invalid_feedback text-danger">{{ $message }}</div>
        @enderror
    </div>

    {{-- Thumb --}}

    <div class="mb-3">
        <label for="thumb">Immagine</label>
        <img src="{{asset('storage/' . $project?->thumb )}}" alt="thumbnail" class="img-thumbnail" style="width:100px; aspect-ratio:1/1">
        <input type="file" accept="image/*" name="thumb" {{--value="{{ old('thumb', $project?->thumb) }}"    nei type='file' il value non esiste           --}}
            class="form-control @error('thumb') is-invalid @enderror" id="thumb"
            placeholder="Inserisci il link dell'immagine">
        @error('thumb')
            <div class="invalid_feedback text-danger">{{$message}}{{-- L'immagine sembra essere troppo lunga, inserire un'immagine di max 5MB --}}</div>
        @enderror
    </div>

    {{-- Release  --}}

    <div class="mb-3">
        <label for="release">Data Rilascio</label>
        <input type="date" name="release" value="{{ old('release', $project?->release->format('Y-m-d')) }}"
            class="form-control @error('release') is-invalid @enderror" id="release"
            placeholder="Inserisci il titolo">
        @error('release')
            <div class="invalid_feedback text-danger">{{ $message }}</div>
        @enderror
    </div>

    {{-- Link --}}

    <div class="mb-3">
        <label for="link">Link</label>
        <input type="text" name="link" value="{{ old('link', $project?->link) }}"
            class="form-control @error('link') is-invalid @enderror" id="link"
            placeholder="Inserisci il link della repo">
        @error('link')
            <div class="invalid_feedback text-danger">{{ $message }}</div>
        @enderror
    </div>

    {{-- Language --}}

    <div class="mb-3">
        <label for="language">Linguaggi</label>
        <input type="text" name="language" value="{{ old('language', implode(', ', $project?->language ?? [])) }}"
            class="form-control @error('language') is-invalid @enderror" id="language"
            placeholder="Inserisci i linguaggi conosciuti">
        @error('language')
            <div class="invalid_feedback text-danger">{{ $message }}</div>
        @enderror
    </div>



    <button type="submit" class="btn btn-primary">Salva</button>
    <a class="btn btn-primary" href="{{ route('admin.projects.index') }}">Indietro</a>

</form>
