@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Kategori Donasi</h1>

    <form action="{{ route('categoriesCampaigns.update', $categoriesCampaign->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label for="name" class="form-label">Nama Kategori</label>
            <input type="text" name="name" id="name" value="{{ $categoriesCampaign->name }}" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>

</div>
@endsection
