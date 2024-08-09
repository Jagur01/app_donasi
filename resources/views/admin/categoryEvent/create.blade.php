@extends('layouts.app')

@section('content')

    {{-- halaman tambah CategoryEvent --}}
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Kategori Event</h1>
            </div>

            <div class="section-body">
                <div class="card">
                    <div class="card-header mb-2">
                        <h4><i class="fa-solid fa-enter-check"></i>Kategori Event</h4>
                    </div>

                    <div class="card-body py-3 ">
                        <form action="{{ route('categoryEvent.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">Nama Kategori</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Nama Kategori">
                            </div>
                            <button type="submit" class="btn btn-success btn-lg mt-3">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>


@endsection