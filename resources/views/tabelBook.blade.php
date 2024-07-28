@extends('layouts.tabel')
@section('content')
<table class="display" id="basic-key-table">
    <thead>
        <tr>
            <th>No</th>
            <th>title</th>   
            <th>author</th>   
            <th>category</th>   
            <th>image</th>   
            <th>Edit</th>
            <th>Del</th>
        </tr>
    </thead>
    <tbody>
        @php
        $no = 1;
        @endphp
        @foreach ($books as $books)
        <tr>
            <td>{{$no++}}</td>
            <td> {{ $books->title}}</td>
            <td> {{ $books->author}}</td>
            <td> {{ $books->category->name}}</td>
            <td>
                        @if($books->image)
                            <img src="{{ asset('storage/' . $books->image) }}" width="50">
                        @endif
                    </td>

            <td><div style="cursor: pointer" id='{{ $books->id}}' onclick='UbahData(this.id);'
                title='Edit {{ $books->name}}'><i class="fa fa-edit"></i></div>
        </td>
            <td><div style="cursor: pointer" id='{{ $books->id}}' onclick='HapusData(this.id);' data-toggle='tooltip' data-placement='left' title='Delete {{ $books->name}}'><i class="fa fa-eraser"></i></div></td>
        </tr>
        @endforeach
    </tbody>

</table>
@endsection
