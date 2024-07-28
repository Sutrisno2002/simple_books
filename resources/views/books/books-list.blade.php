<table class="table table-bordered">
    <thead>
        <tr>
            <th>Title</th>
            <th>Author</th>
            <th>Category</th>
            <th>Image</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse($books as $book)
        <tr>
            <td>{{ $book->title }}</td>
            <td>{{ $book->author }}</td>
            <td>{{ $book->category->name }}</td>

            <td>
                @if($book->image)
                    <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->title }}" style="max-width: 100px;">
                @endif
            </td>
            <td>
                <a href="{{ route('books.edit', $book->id) }}" class="btn btn-warning">Edit</a>
                <button class="btn btn-danger delete-btn" data-id="{{ $book->id }}">Delete</button>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="8">No books found.</td>
        </tr>
        @endforelse
    </tbody>
</table>

<script>
$(document).on('click', '.delete-btn', function() {
    var bookId = $(this).data('id');

    $.ajax({
        url: '/books/' + bookId,
        type: 'DELETE',
        data: {
            _token: '{{ csrf_token() }}'
        },
        success: function(response) {
            alert(response.success);
            location.reload(); // Reload page after delete
        },
        error: function(xhr) {
            alert('Error occurred while deleting.');
        }
    });
});
</script>
