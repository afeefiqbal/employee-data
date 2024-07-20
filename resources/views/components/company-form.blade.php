<div>
    
    <form method="POST" enctype="multipart/form-data" action="{{ $company ? route('companies.update', $company->id) : route('companies.store') }}">
        @csrf
        @if($company)
            @method('PUT')
        @endif

        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $company->name ?? '') }}" required>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $company->email ?? '') }}" required>
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="logo">Logo:</label>
            <input type="file" name="logo" id="logo" class="form-control">
            @if($company && $company->logo)
                <img src="{{ asset('storage/' . $company->logo) }}" alt="Logo" width="100">
            @endif
            @error('logo')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="website">Website:</label>
            <input type="url" name="website" id="website" class="form-control" value="{{ old('website', $company->website ?? '') }}">
            @error('website')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">{{ $company ? 'Update' : 'Create' }}</button>
    </form>
</div>
