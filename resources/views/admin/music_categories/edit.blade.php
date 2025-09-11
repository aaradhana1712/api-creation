@extends('layouts.admin')

@section('title', 'Edit Music Category')
@section('page-title', 'Edit Music Category')

@section('content')
<section class="no-padding-top no-padding-bottom">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <div class="block">
                    <div class="title d-flex justify-content-between align-items-center">
                        <strong>Edit Category: {{ $category->music_category }}</strong>
                        <div class="btn-group">
                            <a href="{{ route('admin.music-categories.show', $category->id) }}" class="btn btn-outline-info">
                                <i class="fa fa-eye"></i> View
                            </a>
                            <a href="{{ route('admin.music-categories.index') }}" class="btn btn-outline-primary">
                                <i class="fa fa-arrow-left"></i> Back to List
                            </a>
                        </div>
                    </div>
                    
                    <!-- Display Validation Errors -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong><i class="fa fa-exclamation-triangle"></i> Please fix the following errors:</strong>
                            <ul class="mb-0 mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Edit Form -->
                    <form action="{{ route('admin.music-categories.update', $category->id) }}" method="POST" class="form-horizontal">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group row">
                            <label class="col-sm-3 form-control-label">
                                <strong>Category Name <span class="text-danger">*</span></strong>
                            </label>
                            <div class="col-sm-9">
                                <input id="music_category" 
                                       name="music_category" 
                                       type="text" 
                                       class="form-control @error('music_category') is-invalid @enderror"
                                       value="{{ old('music_category', $category->music_category) }}"
                                       placeholder="Enter music category name"
                                       maxlength="255"
                                       required>
                                @error('music_category')
                                    <div class="invalid-feedback">
                                        <i class="fa fa-exclamation-circle"></i> {{ $message }}
                                    </div>
                                @enderror
                                <small class="form-text text-muted">
                                    <i class="fa fa-info-circle"></i> Maximum 255 characters allowed
                                </small>
                            </div>
                        </div>

                        <div class="line"></div>

                        <div class="form-group row">
                            <div class="col-sm-9 ml-auto">
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-save"></i> Update Category
                                </button>
                                <button type="reset" class="btn btn-outline-warning">
                                    <i class="fa fa-undo"></i> Reset Changes
                                </button>
                                <a href="{{ route('admin.music-categories.show', $category->id) }}" class="btn btn-outline-info">
                                    <i class="fa fa-eye"></i> View Details
                                </a>
                                <a href="{{ route('admin.music-categories.index') }}" class="btn btn-outline-secondary">
                                    <i class="fa fa-times"></i> Cancel
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Category Info -->
            <div class="col-lg-4">
                <div class="block">
                    <div class="title"><strong>Category Information</strong></div>
                    <div class="block-body">
                        <table class="table table-sm">
                            <tr>
                                <td><strong>ID:</strong></td>
                                <td><span class="badge badge-primary">{{ $category->id }}</span></td>
                            </tr>
                            <tr>
                                <td><strong>Created:</strong></td>
                                <td>{{ $category->created_at->format('d M Y, h:i A') }}</td>
                            </tr>
                            <tr>
                                <td><strong>Last Updated:</strong></td>
                                <td>{{ $category->updated_at->format('d M Y, h:i A') }}</td>
                            </tr>
                            <tr>
                                <td><strong>Time Ago:</strong></td>
                                <td class="text-muted">{{ $category->updated_at->diffForHumans() }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="block">
                    <div class="title"><strong>Quick Actions</strong></div>
                    <div class="block-body text-center">
                        <div class="btn-group-vertical btn-block">
                            <a href="{{ route('admin.music-categories.show', $category->id) }}" class="btn btn-info">
                                <i class="fa fa-eye"></i> View Full Details
                            </a>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">
                                <i class="fa fa-trash"></i> Delete Category
                            </button>
                            <a href="{{ route('admin.music-categories.create') }}" class="btn btn-success">
                                <i class="fa fa-plus"></i> Add New Category
                            </a>
                        </div>
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
                <h5 class="text-danger">"{{ $category->music_category }}"</h5>
                <p class="text-muted"><strong>Warning:</strong> This action cannot be undone!</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <form action="{{ route('admin.music-categories.destroy', $category->id) }}" method="POST" style="display: inline;">
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
$(document).ready(function() {
    // Auto focus and select text
    $('#music_category').focus().select();
    
    // Form submission loading state
    $('form').on('submit', function() {
        var submitBtn = $(this).find('button[type="submit"]');
        var originalText = submitBtn.html();
        submitBtn.html('<i class="fa fa-spinner fa-spin"></i> Updating...').prop('disabled', true);
    });
    
    // Reset confirmation
    $('button[type="reset"]').on('click', function(e) {
        if (!confirm('Are you sure you want to reset all changes?')) {
            e.preventDefault();
        }
    });
});
</script>
@endpush