@extends('layouts.app')

@section('title', 'Categories')

@section('content')
<div class="container">
    <h1>Categories</h1>
    <form class="needs-validation" method="post" novalidate="" action="categories"
    id="myForm" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        <input type="hidden" id="inputan" name="inputan">
        <input type="hidden" name="id" id="id">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
    <hr>
    <div class="card-body">
        <div class="dt-ext table-responsive">
            <!--Tabel-->
            <div id="DataTable"></div>
        </div>
    </div>
</div>
@endsection

@section('footer_scripts')

<script>

LoadData();
    

    function LoadData() {
        $.ajax({
            type: 'GET',
            url: "/categoriess",
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
            url: "/categoryView/" + iddata,
            success: function (data) {
                var inputan = "update";
                $.each(data, function (key, r_data) {
                    $('#id').val(iddata);
                    $('#name').val(r_data.name);
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
                url: "/categories",
                success: function () {
                    LoadData();
                }
            });
            }
    }

</script>
@endsection

