@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ isset($category) ? route('categories.update', $category->id) : route('categories.store') }}" method="POST">
            @csrf
            @if(isset($category))
                @method('PUT')
            @endif
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ isset($category) ? $category->name : '' }}" required>
            </div>
            <button type="submit" class="btn btn-primary mt-2">{{ isset($category) ? 'Update' : 'Create' }}</button>
        </form>
    </div>
@endsection
