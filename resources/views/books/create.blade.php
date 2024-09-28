@extends('layouts.app')

@section('title', 'Add New Book')

@section('content')

<div class="container">
    <h1>Add New Book</h1>

    <form action="{{ route('books.store') }}" method="POST">
        @csrf
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <!-- Hidden input for author_id -->
        <input type="hidden" name="author_id" value="{{ $authorId }}">

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>

        <div class="form-group">
            <label for="release_date">Release Date</label>
            <input type="datetime-local" class="form-control" id="release_date" name="release_date" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" required></textarea>
        </div>

        <div class="form-group">
            <label for="isbn">ISBN</label>
            <input type="text" class="form-control" id="isbn" name="isbn" required>
        </div>

        <div class="form-group">
            <label for="format">Format</label>
            <input type="text" class="form-control" id="format" name="format" required>
        </div>

        <div class="form-group">
            <label for="number_of_pages">Number of Pages</label>
            <input type="number" class="form-control" id="number_of_pages" name="number_of_pages" required>
        </div>

        <button type="submit" class="btn btn-primary">Add Book</button>
    </form>
</div>

@endsection
