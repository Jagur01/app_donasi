@extends('layouts.app')

@section('content')
{{-- buatkan halaman READ data user --}}
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>User</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4><i class="fa-solid fa-user"></i>User</h4>
                </div>

                <div class="card-body ">
                    <div class="input-group-prepend">
                        <a href="{{ route('user.create') }}" class="btn btn-primary" style="padding-top: 10px;"><i
                                class="fa fa-plus-circle"></i> TAMBAH USER</a>
                        <form method="GET" action="{{ route('user.index') }}" class="my-3">
                            <div class="row mb-3">
                                <div class="col">
                                    <input type="text" name="keyword" id="search" class="form-control"
                                        value="{{ request('keyword') }}" placeholder="Cari User">
                                </div>
                                <div class="col">
                                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-search"></i> &nbsp;Cari</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="table-responsive mt-3">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col" style="text-align: center;width: 6%">NO.</th>
                                    <th scope="col">NAMA</th>
                                    <th scope="col">EMAIL</th>
                                    <th scope="col" style="width: 15%;text-align: center">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $no => $user)
                                    <tr>
                                        <th scope="row" style="text-align: center">{{ ($users->currentPage() - 1) * $users->perPage() + $no + 1 }}</th>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('user.edit', $user->id) }}"
                                                class="btn btn-sm btn-warning">
                                                <i class="fa fa-pencil-alt"></i>
                                            </a>
                                            <form action="{{ route('user.destroy', $user->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>



@endsection