@extends('layouts.admin')

@section('title', 'Music Categories')
@section('page-title', 'Music Categories')

@section('content')
<section class="no-padding-top no-padding-bottom">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <!-- Success Message -->
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong><i class="fa fa-check"></i> Success!</strong> {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif

                <!-- Add New Category Button -->
                <div class="block margin-bottom-sm">
                    <div class="title d-flex justify-content-between align-items-center">
                        <strong>All Music Categories</strong>
                        <a href="{{ route('admin.music-categories.create') }}" class="btn btn-primary">
                            <i class="fa fa-plus"></i> Add New Category
                        </a>
                    </div>
                </div>

                <!-- Categories Table -->
                <div class="block">
                    <div class="table-responsive">
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Category Name</th>
                                    <th>Created Date</th>
                                    <th>Last Updated</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($categories as $category)
                                    <tr>
                                        <td><strong>{{ $category->id }}</strong></td>
                                        <td>
                                            <i class="fa fa-music text-primary"></i> 
                                            <strong>{{ $category->music_category }}</strong>
                                        </td>
                                        <td>{{ $category->created_at->format('d M Y, H:i') }}</td>
                                        <td>{{ $category->updated_at->diffForHumans() }}</td>
                                        <td>
                                            <div class="btn-group btn-group-sm" role="group">
                                                <a href="{{ route('admin.music-categories.show', $category->id) }}" 
                                                   class="btn btn-info btn-sm" title="View">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <!-- View Button -->
                                                <a href="{{ route('admin.music-categories.show', $category->id) }}" 
                                                     class="btn btn-info btn-sm" title="View">
                                                      <i class="fa fa-eye"></i> View
                                                </a>
                                                <a href="{{ route('admin.music-categories.edit', $category->id) }}" 
                                                   class="btn btn-warning btn-sm" title="Edit">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <button type="button" class="btn btn-danger btn-sm" 
                                                        onclick="deleteCategory({{ $category->id }}, '{{ $category->music_category }}')"
                                                        title="Delete">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-4">
                                            <div class="py-4">
                                                <i class="fa fa-music fa-3x text-muted mb-3"></i>
                                                <h5 class="text-muted">No Music Categories Found</h5>
                                                <p class="text-muted">Create your first music category to get started.</p>
                                                <a href="{{ route('admin.music-categories.create') }}" class="btn btn-primary">
                                                    <i class="fa fa-plus"></i> Add First Category
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">
                    <i class="fa fa-exclamation-triangle text-danger"></i> Confirm Delete
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this music category?</p>
                <h5 class="text-danger" id="categoryNameToDelete"></h5>
                <p class="text-muted"><strong>Warning:</strong> This action cannot be undone!</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fa fa-trash"></i> Yes, Delete It!
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function deleteCategory(categoryId, categoryName) {
    document.getElementById('categoryNameToDelete').textContent = categoryName;
    document.getElementById('deleteForm').action = '/admin/music-categories/' + categoryId;
    $('#deleteModal').modal('show');
}
</script>
@endpush