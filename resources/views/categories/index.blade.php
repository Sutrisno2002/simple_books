@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{ route('categories.create') }}" class="btn btn-primary">Add Category</a>
        <table class="table mt-4">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>
                            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
