@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Music Category Details</h2>

    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <td>{{ $category->id }}</td>
        </tr>
        <tr>
            <th>Category Name</th>
            <td>{{ $category->music_category }}</td>
        </tr>
        <tr>
            <th>Created At</th>
            <td>{{ $category->created_at->format('d M Y h:i A') }}</td>
        </tr>
        <tr>
            <th>Updated At</th>
            <td>{{ $category->updated_at->format('d M Y h:i A') }}</td>
        </tr>
    </table>

    <a href="{{ route('admin.music-categories.index') }}" class="btn btn-secondary">Back</a>
    <a href="{{ route('admin.music-categories.edit', $category->id) }}" class="btn btn-warning">Edit</a>
    <form action="{{ route('admin.music-categories.destroy', $category->id) }}" method="POST" class="d-inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger"
                onclick="return confirm('Are you sure you want to delete this category?')">
            Delete
        </button>
    </form>
</div>
@endsection
