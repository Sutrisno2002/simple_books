@extends('layouts.tabel')
@section('content')
<table class="display" id="basic-key-table">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>   
            <th>Edit</th>
            <th>Del</th>
        </tr>
    </thead>
    <tbody>
        @php
        $no = 1;
        @endphp
        @foreach ($categories as $categories)
        <tr>
            <td>{{$no++}}</td>
            <td> {{ $categories->name}}</td>
            
            <td><div style="cursor: pointer" id='{{ $categories->id}}' onclick='UbahData(this.id);'
                title='Edit {{ $categories->name}}'><i class="fa fa-edit"></i></div>
        </td>
            <td><div style="cursor: pointer" id='{{ $categories->id}}' onclick='HapusData(this.id);' data-toggle='tooltip' data-placement='left' title='Delete {{ $categories->name}}'><i class="fa fa-eraser"></i></div></td>
        </tr>
        @endforeach
    </tbody>

</table>
@endsection
