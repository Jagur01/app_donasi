@extends('layouts.app')

{{-- halaman edit user --}}

@section('content')
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

                    <div class="card-body">
                        <form action="{{ route('user.update', $user->id) }}" method="POST">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control">
                            </div>
                            {{-- <div class="form-group">
                                <label for="role">Role</label>
                                <select name="roles_id" id="role" class="form-control">
                                    <option value="1" {{ $user->roles_id == 1 ? 'selected' : '' }}>Admin</option>
                                    <option value="2" {{ $user->roles_id == 2 ? 'selected' : '' }}>User</option>
                                </select>
                            </div> --}}

                            <button type="submit" class="btn btn-success btn-lg my-3">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection