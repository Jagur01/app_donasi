@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Daftar Kategori Donasi</h1>
        <a href="{{ route('categoriesCampaigns.create') }}" class="btn btn-primary mb-3"
            style="background-color: #6777ef; color: white;">Tambah Kategori</a>

        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center" style="width: 50px;">No</th>
                                <th class="text-center">Nama Kategori</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categoriesCampaigns as $index => $category)
                                <tr>
                                    <td class="text-center" style="width: 50px;">{{ $index + 1 }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('categoriesCampaigns.edit', $category->id) }}"
                                            class="btn btn-warning btn-sm mx-1">Edit</a>
                                        <form action="{{ route('categoriesCampaigns.destroy', $category->id) }}"
                                            method="POST" class="delete-form d-inline mx-1"
                                            data-title="{{ $category->name }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
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

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.querySelectorAll(".delete-form").forEach(form => {
            form.addEventListener("submit", function(event) {
                event.preventDefault();

                let categoryTitle = form.getAttribute("data-title");

                Swal.fire({
                    title: "Yakin ingin menghapus?",
                    text: `Kategori "${categoryTitle}" akan dihapus!`,
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Ya, Hapus!",
                    cancelButtonText: "Batal"
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endsection
