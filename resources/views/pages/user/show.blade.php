@extends('layouts.admin.app')

@section('title', 'Detail User')

@section('content')
<div class="container">

    <h4 class="mb-3 fw-bold text-primary">
        <i class="bi bi-person-circle"></i> Detail User
    </h4>

    <div class="card shadow-sm">
        <div class="card-body text-center">

            <img src="{{ $user->profile_photo_url }}"
                 class="rounded-circle mb-3"
                 style="width:200px;height:200px;object-fit:cover;">

            <table class="table table-borderless text-start w-50 mx-auto">
                <tr>
                    <th>Nama</th>
                    <td>{{ $user->name }}</td>
                </tr>
                <tr>
                    <th>Username</th>
                    <td>{{ $user->username }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $user->email }}</td>
                </tr>
                <tr>
                    <th>Role</th>
                    <td>{{ ucfirst(str_replace('_',' ', $user->role)) }}</td>
                </tr>
            </table>

            <a href="{{ route('user.index') }}"
               class="btn btn-secondary mt-3">
                Kembali
            </a>

        </div>
    </div>

</div>
@endsection
