@extends('layouts.admin')

@section('title', 'Subcategories')
@section('page-title', 'Subcategories')

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

                <!-- Add New Subcategory Button -->
                <div class="block margin-bottom-sm">
                    <div class="title d-flex justify-content-between align-items-center">
                        <strong>All Subcategories</strong>
                        <a href="{{ route('admin.sub-category.create') }}" class="btn btn-primary">
                            <i class="fa fa-plus"></i> Add New Subcategory
                        </a>
                    </div>
                </div>

                <!-- Subcategories Table -->
                <div class="block">
                    <div class="table-responsive">
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Subcategory Name</th>
                                    <th>Music Category</th>
                                    <th>Created Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($subcategories as $subcategory)
                                    <tr>
                                        <td><strong>{{ $subcategory->id }}</strong></td>
                                        <td>
                                            @if($subcategory->image)
                                                <img src="{{ asset('storage/' . $subcategory->image) }}" 
                                                     alt="{{ $subcategory->name }}"
                                                     class="img-thumbnail"
                                                     style="width: 50px; height: 50px; object-fit: cover;">
                                            @else
                                                <div class="bg-secondary d-flex align-items-center justify-content-center" 
                                                     style="width: 50px; height: 50px; border-radius: 5px;">
                                                    <i class="fa fa-image text-white"></i>
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            <i class="fa fa-list text-info"></i> 
                                            <strong>{{ $subcategory->name }}</strong>
                                        </td>
                                        <td>
                                            <span class="badge badge-info">
                                                {{ $subcategory->musicCategory->music_category }}
                                            </span>
                                        </td>
                                        <td>{{ $subcategory->created_at->format('d M Y, H:i') }}</td>
                                        <td>
                                            <div class="btn-group btn-group-sm" role="group">
                                                <a href="{{ route('admin.sub-category.show', $subcategory->id) }}" 
                                                   class="btn btn-info btn-sm" title="View">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.sub-category.edit', $subcategory->id) }}" 
                                                   class="btn btn-warning btn-sm" title="Edit">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <button type="button" class="btn btn-danger btn-sm" 
                                                        onclick="deleteSubcategory({{ $subcategory->id }}, '{{ $subcategory->name }}')"
                                                        title="Delete">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4">
                                            <div class="py-4">
                                                <i class="fa fa-list fa-3x text-muted mb-3"></i>
                                                <h5 class="text-muted">No Subcategories Found</h5>
                                                <p class="text-muted">Create your first subcategory to get started.</p>
                                                <a href="{{ route('admin.sub-category.create') }}" class="btn btn-primary">
                                                    <i class="fa fa-plus"></i> Add First Subcategory
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
                <p>Are you sure you want to delete this subcategory?</p>
                <h5 class="text-danger" id="subcategoryNameToDelete"></h5>
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
function deleteSubcategory(subcategoryId, subcategoryName) {
    document.getElementById('subcategoryNameToDelete').textContent = subcategoryName;
    document.getElementById('deleteForm').action = '/admin/sub-category/' + subcategoryId;
    $('#deleteModal').modal('show');
}
</script>
@endpush

