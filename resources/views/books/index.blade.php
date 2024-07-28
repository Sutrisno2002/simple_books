@extends('layouts.app')

@section('title', 'Books')

@section('content')
<div class="container">
    <h1>Books</h1>
    <a href="{{ route('books.create') }}" class="btn btn-primary">Add Books</a>

    <div class="form-group">
        <label for="categoryFilter">Filter by Category:</label>
        <select id="categoryFilter" class="form-control">
            <option value="">All Categories</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
    <div id="booksContainer">
        @include('books.books-list', ['books' => $books])
    </div>
</div>

<!-- Edit Book Modal -->
<div class="modal fade" id="editBookModal" tabindex="-1" aria-labelledby="editBookModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editBookModalLabel">Edit Book</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editBookForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="editBookId" name="book_id">
                    <div class="form-group">
                        <label for="editTitle">Title</label>
                        <input type="text" id="editTitle" name="title" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="editAuthor">Author</label>
                        <input type="text" id="editAuthor" name="author" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="editCategory">Category</label>
                        <select id="editCategory" name="category_id" class="form-control" required>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
               
                    <div class="form-group">
                        <label for="editImage">Image</label>
                        <input type="file" id="editImage" name="image" class="form-control">
                        <img id="currentImage" src="" alt="" style="max-width: 100px;">
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#categoryFilter').on('change', function() {
        var categoryId = $(this).val();
        $.ajax({
            url: '{{ route('books.filter') }}',
            type: 'GET',
            data: { category_id: categoryId },
            success: function(response) {
                $('#booksContainer').html(response.html);
            },
            error: function(xhr) {
                alert('Error occurred while fetching books.');
                console.error('Error:', xhr.responseText);
            }
        });
    });

    // Open edit modal
    $(document).on('click', '.edit-btn', function() {
        var bookId = $(this).data('id');
        $.ajax({
            url: '/books/' + bookId + '/edit',
            type: 'GET',
            success: function(response) {
                $('#editBookId').val(response.book.id);
                $('#editTitle').val(response.book.title);
                $('#editAuthor').val(response.book.author);
                $('#editCategory').val(response.book.category_id);
              
                $('#currentImage').attr('src', response.book.image_url);
                $('#editBookModal').modal('show');
            },
            error: function(xhr) {
                alert('Error occurred while fetching book details.');
                console.error('Error:', xhr.responseText);
            }
        });
    });

    // Submit edit form
    $('#editBookForm').on('submit', function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        var bookId = $('#editBookId').val();
        $.ajax({
            url: '/books/' + bookId,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                $('#editBookModal').modal('hide');
                alert('Book updated successfully.');
                location.reload();
            },
            error: function(xhr) {
                alert('Error occurred while updating book.');
                console.error('Error:', xhr.responseText);
            }
        });
    });
});
</script>
@endsection
