@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Home</li>
              </ol>
            </nav>
            @if(!empty($message))
              <div class="alert alert-success"> {{ $message }}</div>
            @endif
            <div class="card">
                <div class="card-header">User <a href="{{ route('user.create') }}" class="btn btn-primary float-right text-white">Create New</a></div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <td>#</td>
                                    <td>Name</td>
                                    <td>Email</td>
                                    <td>Type</td>
                                    <td>Created</td>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->name }}</td>
                                    <td>{{ $row->email }}</td>
                                    <td>{{ ($row->isAdmin == 1) ? 'Admin' : 'User' }}</td>
                                    <td>{{ date('d/m/Y', strtotime($row->created_at)) }}</td>
                                    <td>
                                        <a class="divider" href="{{ route('user.view', $row->id) }}"><i class="fas fa-eye"></i></a>
                                        @if ($row->isAdmin != 1)
                                        <a class="divider" href="{{ route('user.delete', $row->id) }}"><i class="fas fa-trash"></i></a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
