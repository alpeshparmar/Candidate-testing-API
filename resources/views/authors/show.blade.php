@extends('layouts.app')

@section('title', 'Author Details')

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Author Details</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('authors.index') }}">Authors</a></li>
                        <li class="breadcrumb-item active">Author Details</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ $authorDetails['first_name'] }} {{ $authorDetails['last_name'] }}</h3>
                        <div class="card-tools">
                            <a href="{{ route('books.create', ['authorId' => $authorDetails['id']]) }}" class="btn btn-primary btn-sm">
                                Add Book
                            </a>
                        </div>
                    </div>
                    <div class="card-body">

                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        <h4>Author Information</h4>
                        <p><strong>ID:</strong> {{ $authorDetails['id'] }}</p>
                        <p><strong>First Name:</strong> {{ $authorDetails['first_name'] }}</p>
                        <p><strong>Last Name:</strong> {{ $authorDetails['last_name'] }}</p>
                        <p><strong>Birthday:</strong> {{ \Carbon\Carbon::parse($authorDetails['birthday'])->format('Y-m-d') }}</p>
                        <p><strong>Gender:</strong> {{ ucfirst($authorDetails['gender']) }}</p>
                        <p><strong>Place of Birth:</strong> {{ $authorDetails['place_of_birth'] }}</p>

                        <h4>Books</h4>
                        @if(!empty($authorDetails['books']))
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Release Date</th>
                                        <th>Description</th>
                                        <th>ISBN</th>
                                        <th>Format</th>
                                        <th>Number of Pages</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($authorDetails['books'] as $book)
                                        <tr>
                                            <td>{{ $book['id'] }}</td>
                                            <td>{{ $book['title'] }}</td>
                                            <td>{{ \Carbon\Carbon::parse($book['release_date'])->format('Y-m-d') }}</td>
                                            <td>{{ $book['description'] }}</td>
                                            <td>{{ $book['isbn'] }}</td>
                                            <td>{{ $book['format'] }}</td>
                                            <td>{{ $book['number_of_pages'] }}</td>
                                            <td>
                                                <form action="{{ route('books.destroy', $book['id']) }}" method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this book?');">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p>No books available for this author.</p>
                        @endif
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
