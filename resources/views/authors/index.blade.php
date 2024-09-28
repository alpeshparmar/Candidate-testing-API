@extends('layouts.app')

@section('title', 'Authors')

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Authors List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Authors</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">List of Authors</h3>
                        <div class="card-tools">
                            {{-- <a  class="btn btn-primary btn-sm">Add Author</a> --}}
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif
                        <table id="authorsTable" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Birthday</th>
                                    <th>Gender</th>
                                    <th>Place of Birth</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($authors['items'] as $author)
                                    <tr>
                                        <td>{{ $author['id'] }}</td>
                                        <td>{{ $author['first_name'] }}</td>
                                        <td>{{ $author['last_name'] }}</td>
                                        <td>{{ \Carbon\Carbon::parse($author['birthday'])->format('Y-m-d') }}</td>
                                        <td>{{ ucfirst($author['gender']) }}</td>
                                        <td>{{ $author['place_of_birth'] }}</td>
                                        <td>
                                            <a href="{{ route('authors.show', $author['id']) }}" class="btn btn-info btn-sm">View</a>
                                            <form action="{{ route('authors.destroy', $author['id']) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Are you sure you want to delete this author?');"
                                                    @if($author['is_book_available']) disabled @endif>
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Birthday</th>
                                    <th>Gender</th>
                                    <th>Place of Birth</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>

@endsection
