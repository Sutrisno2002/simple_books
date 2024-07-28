@extends('layouts.app')

@section('title', 'Books')

@section('content')
<div class="container">
    <h1>Books</h1>

    <!-- Filter Form -->
    
    
    <hr>

    <!-- Book Form -->
    <form class="needs-validation" method="post" novalidate="" action="books"
    id="myForm" enctype="multipart/form-data">
        <input type="hidden" name="id" id="id">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

        <input type="hidden" name="inputan" id="inputan">

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="bookTitle" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="author">Author</label>
            <input type="text" name="author" id="bookAuthor" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="category_id">Category</label>
            <select name="category_id" id="bookCategory" class="form-control" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" name="image" id="bookImage" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>

    <hr>

    <!-- Books Table -->
    <div class="card-body">
        <div class="dt-ext table-responsive">
            <!--Tabel-->
            <form id="bookFilterForm">
                <div class="form-group">
                    <label for="category_filter">Filter by Category</label>
                    <select name="category_id" id="category_filter" class="form-control">
                        <option value="semua">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </form>
            <div id="DataTable"></div>
        </div>
    </div>
</div>

<script>
    LoadData();
    

    function LoadData() {
        $.ajax({
            type: 'GET',
            url: "/bookss",
            data: {
                "_token": "{{ csrf_token() }}"
            },
            success: function (result) {

                $('#DataTable').html(result);
            }
        });
    }

    $('#category_filter').on('change', function() {
        let categoryId = $(this).val();
        $.ajax({
            type: 'GET',
            url: "/booksFilter",
            data: {
                "category_id" : categoryId,
                "_token": "{{ csrf_token() }}"
            },
            success: function (result) {
                $('#DataTable').html(result);
            }
        });
    })

    function LoadData() {
        $.ajax({
            type: 'GET',
            url: "/bookss",
            data: {
                "_token": "{{ csrf_token() }}"
            },
            success: function (result) {

                $('#DataTable').html(result);
            }
        });
    }

    function UbahData(iddata) {
        $.ajax({
            type: 'GET',
            data: {
                "_token": "{{ csrf_token() }}"
            },
            url: "/bookView/" + iddata,
            success: function (data) {
                var inputan = "update";
                $.each(data, function (key, r_data) {
                    $('#id').val(iddata);
                    $('#bookTitle').val(r_data.title);
                    $('#bookAuthor').val(r_data.author);
                    $('#inputan').val(inputan);
                });
            }
        })
    };

    $(document).ready(function () {
        $('#inputan').val('input');
        $('#myForm').submit(function () {
            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),

            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
                success: function (result) {
                    document.getElementById("myForm").reset();
                    alert(result.success);
                    LoadData();
                }
            });
            return false;
        });
    });

    function HapusData(iddata) {
            var id = iddata;
            if (confirm("Apakan anda yakin akan menghapus data ini?")) {
            $.ajax({
                type: "DELETE",
                data: {
                    "id": id,
                    "_token": "{{ csrf_token() }}"
                },
                url: "/books",
                success: function () {
                    LoadData();
                }
            });
            }
    }

</script>
@endsection
