@extends('layouts.app')

@section('title', 'Create Book')

@section('content')
<div class="container">
    <h1>Create Book</h1>
    <form id="bookForm" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- Fields -->
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="author">Author</label>
            <input type="text" name="author" id="author" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="category_id">Category</label>
            <select name="category_id" id="category_id" class="form-control" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <div id="successMessage"></div>
</div>

<script>
$(document).ready(function() {
    $('#bookForm').on('submit', function(e) {
        e.preventDefault(); // Prevent the default form submission

        var formData = new FormData(this); // Create a FormData object

        $.ajax({
            url: '{{ route('books.store') }}',
            type: 'POST',
            data: formData,
            contentType: false, // Tell jQuery not to set contentType
            processData: false, // Tell jQuery not to process data
            success: function(response) {
                $('#successMessage').html('<p>' + response.success + '</p>'); // Show success message
                $('#bookForm')[0].reset(); // Reset the form
            },
            error: function(xhr) {
                var errors = xhr.responseJSON.errors;
                var errorHtml = '<ul>';
                $.each(errors, function(key, value) {
                    errorHtml += '<li>' + value + '</li>';
                });
                errorHtml += '</ul>';
                $('#successMessage').html('<p>There were errors:</p>' + errorHtml);
            }
        });
    });
});
</script>
@endsection
