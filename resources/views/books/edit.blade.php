@extends('layouts.app')

@section('title', 'Edit Book')

@section('content')
<div class="container">
    <h1>Edit Book</h1>
    <form id="editBookForm" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <input type="hidden" name="book_id" value="{{ $book->id }}">
        
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" value="{{ $book->title }}" required>
        </div>
        
        <div class="form-group">
            <label for="author">Author</label>
            <input type="text" name="author" class="form-control" value="{{ $book->author }}" required>
        </div>

        <div class="form-group">
            <label for="category_id">Category</label>
            <select name="category_id" class="form-control" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $category->id == $book->category_id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="image">Image</label>
            @if($book->image)
                <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->title }}" style="max-width: 100px;">
            @endif
            <input type="file" name="image" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>

    <script>
$(document).ready(function() {
    // Setup CSRF token for all AJAX requests
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#editBookForm').on('submit', function(event) {
        event.preventDefault(); // Prevent the form from submitting normally

        var formData = new FormData(this);
        var bookId = $('input[name="book_id"]').val();

        $.ajax({
            url: '/books/' + bookId,
            type: 'PUT',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                alert(response.success);
                window.location.href = '{{ route('books.index') }}';
            },
            error: function(xhr) {
                var errors = xhr.responseJSON.errors;
                if (errors) {
                    var errorMessages = [];
                    for (var key in errors) {
                        if (errors.hasOwnProperty(key)) {
                            errorMessages.push(errors[key].join(', '));
                        }
                    }
                    alert('Error: ' + errorMessages.join('\n'));
                } else {
                    alert('Error occurred while updating the book.');
                }
                console.error('Error:', xhr.responseText);
            }
        });
    });
});
</script>

@endsection
