@extends('layouts.app')

@section('content')
    {{-- halaman edit categoryEvent --}}
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Kategori Event</h1>
            </div>

            <div class="section-body">
                <div class="card">
                    <div class="card-header">
                        <h4><i class="fa-solid fa-enter-check"></i>Kategori Event</h4>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('categoryEvent.update', $categoryEvent->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">Nama Kategori</label>
                                <input type="text" class="form-control" name="name" id="name" value="{{ $categoryEvent->name }}" placeholder="Nama Kategori">
                            </div>
                            <button type="submit" class="btn btn-success btn-lg mt-3">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection