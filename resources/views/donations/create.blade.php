@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Donasi untuk : {{ $campaign->title }}</h1>
    <form action="{{ route('donations.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id">

        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
        <input type="hidden" name="campaign_id" value="{{ $campaign->id }}">
        <input type="hidden" name="status_id" value="1">
        <div class="mb-3">
            <label for="amount" class="form-label">Jumlah Donasi </label>
            <input type="number" name="amount" class="form-control" id="amount" required>
        </div>
        <div class="mb-3">
            <label for="proof_image" class="form-label">Bukti Donasi</label>
            <input type="file" name="proof_image" class="form-control" id="proof_image" required>
        </div>
        <button type="submit" class="btn btn-primary">Kirim Donasi</button>
    </form>
</div>
@endsection
