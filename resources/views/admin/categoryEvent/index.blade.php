@extends('layouts.app')

@section('content')
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

                    <div class="card-body ">
                        <form action="{{ route('categoryEvent.index') }}" method="GET">
                            <div class="form-group">
                                <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <a href="{{ route('categoryEvent.create') }}" class="btn btn-primary" style="padding-top: 10px;"><i class="fa fa-plus-circle"></i> TAMBAH</a>
                                        </div>
                                    <input type="text" class="form-control" name="q"
                                           placeholder="cari berdasarkan judul agenda">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> CARI
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                            
                        <div class="table-responsive mt-3">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col" style="text-align: center;width: 6%">NO.</th>
                                        <th scope="col">NAMA</th>
                                        <th scope="col" style="width: 15%;text-align: center">AKSI</th>
                                    </tr
                                </thead>
                                <tbody>
                                    @foreach ($categoryEvents as $no => $categoryEvent)
                                        <tr>
                                            <th scope="row" style="text-align: center">{{ ($categoryEvents->currentPage() - 1) * $categoryEvents->perPage() + $no + 1 }}</th>
                                            <td>{{ $categoryEvent->name }}</td>
                                            <td class="text-center">
                                                    <a href="{{ route('categoryEvent.edit', $categoryEvent->id) }}"
                                                        class="btn btn-sm btn-warning">
                                                        <i class="fa fa-pencil-alt"></i>
                                                    </a>
                                                    <form action="{{ route('categoryEvent.destroy', $categoryEvent->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection