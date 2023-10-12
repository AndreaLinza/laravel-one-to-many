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

    <div class="row row-cols-3">
        {{-- Thumb --}}

        <div class="mb-3">
            <label for="thumb">Immagine</label>
            {{-- @dump($project->thumb) --}}

            @if ($project?->thumb === null)
                <img src="{{ asset('storage/' . $project?->thumb) }}" alt="thumbnail" class="img-thumbnail mb-2 d-none"
                    style="width:100px; aspect-ratio:1/1">
            @else
                <img src="{{ asset('storage/' . $project?->thumb) }}" alt="thumbnail" class="img-thumbnail mb-2"
                    style="width:100px; aspect-ratio:1/1">
            @endif

            <input type="file" accept="image/*" name="thumb" {{-- value="{{ old('thumb', $project?->thumb) }}"    nei type='file' il value non esiste --}}
                class="form-control @error('thumb') is-invalid @enderror" id="thumb"
                placeholder="Inserisci il link dell'immagine">
            @error('thumb')
                <div class="invalid_feedback text-danger">{{ $message }}{{-- L'immagine sembra essere troppo lunga, inserire un'immagine di max 5MB --}}</div>
            @enderror
        </div>


        {{-- Type --}}
        <div class="mb-3 pt-2">
            <label class="mb-2" for="type_id">Tipologia</label>
            <select name="type_id" {{-- value="{{ old('type', $project?->type) }}"    nei type='file' il value non esiste  --}} class="form-select @error('type_id') is-invalid @enderror"
                id="type_id">
                <option value="null">Seleziona tipologia</option>
                @foreach ($types as $type)
                    <option value="{{ $type->id }}" {{ $project?->type_id === $type->id ? 'selected' : '' }}>
                        {{ $type->name }}</option>
                @endforeach
            </select>
            @error('type_id')
                <div class="invalid_feedback text-danger">{{ $message }}{{-- L'immagine sembra essere troppo lunga, inserire un'immagine di max 5MB --}}</div>
            @enderror
        </div>


        {{-- Release  --}}

        <div class="mb-3 pt-2">
            <label class="mb-2" for="release">Data Rilascio</label>
            <input type="date" name="release" value="{{ old('release', $project?->release->format('Y-m-d')) }}"
                class="form-control @error('release') is-invalid @enderror" id="release"
                placeholder="Inserisci il titolo">
            @error('release')
                <div class="invalid_feedback text-danger">{{ $message }}</div>
            @enderror
        </div>
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
