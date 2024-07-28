<form id="bookForm" method="POST" enctype="multipart/form-data">
    @csrf
    <!-- Other fields here -->
    <div class="form-group">
        <label for="image">Image</label>
        <input type="file" name="image" id="image" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

<div id="successMessage"></div>

<script>
$(document).ready(function() {
    $('#bookForm').on('submit', function(e) {
        e.preventDefault(); // Mencegah pengiriman formulir default

        var formData = new FormData(this); // Mengambil data formulir termasuk file

        $.ajax({
            url: '{{ route('books.store') }}',
            type: 'POST',
            data: formData,
            contentType: false, // Tidak mengatur konten tipe karena FormData menangani ini
            processData: false, // Tidak memproses data sebelum dikirim
            success: function(response) {
                $('#successMessage').html('<p>' + response.success + '</p>'); // Menampilkan pesan sukses
                $('#bookForm')[0].reset(); // Reset formulir
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
