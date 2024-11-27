@extends('layout')

@section('title') Users @endsection

@section('content')

<div class="container">
    <div class="d-flex justify-content-between align-items-center mt-5">
        <div class="d-flex align-items-center">
            <i class="material-icons">list</i>
            <h2 class="mb-0 ms-3">Users</h2>
        </div>
        <a href="{{ route('users.create') }}" class="btn btn-success d-flex align-items-center">
            <i class="material-icons me-2">add</i>
            Create
        </a>
    </div>
    <hr class="mt-3 mb-5">

    @if (session()->has('success'))
        <div class="alert alert-success mb-5 mt-5">{{ session()->get('success') }}</div>
    @elseif (session()->has('error'))
        <div class="alert alert-danger mb-5 mt-5">{{ session()->get('error') }}</div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>E-mail</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->first_name }}</td>
                    <td>{{ $user->last_name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <a href="{{ route('users.show', ['user' => $user->id]) }}" class="btn btn-primary">
                            <i class="material-icons" style="margin-right: 4px; vertical-align: middle;">visibility</i>
                            Details
                        </a>
                        <a href="{{ route('users.edit', ['user' => $user->id]) }}" class="btn btn-primary">
                            <i class="material-icons" style="margin-right: 4px; vertical-align: middle;">edit</i>
                            Edit
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="container mt-5 mb-5">
        {{ $users->links('components/pagination') }}
    </div>
</div>

@endsection