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
                <div class="card-header">Post<a href="{{ route('post.create') }}" class="btn btn-primary float-right text-white">Create New</a></div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <td>#</td>
                                    <td>Title</td>
                                    <td>Content</td>
                                    <td>Created</td>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($posts as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->title }}</td>
                                    <td>{{ $row->content }}</td>
                                    <td>{{ date('d/m/Y', strtotime($row->created_at)) }}</td>
                                    <td>
                                        <a class="divider" href="{{ route('post.view', $row->id) }}"><i class="fas fa-eye"></i></a>
                                        <a class="divider" href="{{ route('post.delete', $row->id) }}"><i class="fas fa-trash"></i></a>
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
