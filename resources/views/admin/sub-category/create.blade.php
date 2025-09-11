@extends('layouts.admin')

@section('title', 'Add Subcategory')
@section('page-title', 'Add New Subcategory')

@section('content')
<section class="no-padding-top no-padding-bottom">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <div class="block">
                    <div class="title d-flex justify-content-between align-items-center">
                        <strong>Create Subcategory</strong>
                        <a href="{{ route('admin.sub-category.index') }}" class="btn btn-outline-primary">
                            <i class="fa fa-arrow-left"></i> Back to List
                        </a>
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

                    <!-- Create Form -->
                    <form action="{{ route('admin.sub-category.store') }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="form-group row">
                            <label class="col-sm-3 form-control-label">
                                <strong>Subcategory Name <span class="text-danger">*</span></strong>
                            </label>
                            <div class="col-sm-9">
                                <input id="name" 
                                       name="name" 
                                       type="text" 
                                       class="form-control @error('name') is-invalid @enderror"
                                       value="{{ old('name') }}"
                                       placeholder="Enter subcategory name (e.g., Rock Ballads, Pop Hits)"
                                       maxlength="255"
                                       required>
                                @error('name')
                                    <div class="invalid-feedback">
                                        <i class="fa fa-exclamation-circle"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 form-control-label">
                                <strong>Music Category <span class="text-danger">*</span></strong>
                            </label>
                            <div class="col-sm-9">
                                <select name="music_category_id" 
        class="form-control @error('music_category_id') is-invalid @enderror" 
        required>
    <option value="">Select a music category</option>
    @foreach($categories as $category)
        <option value="{{ $category->id }}" 
                {{ old('music_category_id') == $category->id ? 'selected' : '' }}>
            {{ $category->music_category }}
        </option>
    @endforeach
</select>

                                @error('music_category_id')
                                    <div class="invalid-feedback">
                                        <i class="fa fa-exclamation-circle"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 form-control-label">
                                <strong>Image</strong>
                            </label>
                            <div class="col-sm-9">
                                <input type="file" 
                                       name="image" 
                                       class="form-control-file @error('image') is-invalid @enderror"
                                       accept="image/*">
                                @error('image')
                                    <div class="invalid-feedback">
                                        <i class="fa fa-exclamation-circle"></i> {{ $message }}
                                    </div>
                                @enderror
                                <small class="form-text text-muted">
                                    <i class="fa fa-info-circle"></i> Accepted formats: JPEG, PNG, JPG, GIF. Max size: 2MB
                                </small>
                            </div>
                        </div>

                        <div class="line"></div>

                        <div class="form-group row">
                            <div class="col-sm-9 ml-auto">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-save"></i> Submit & Save Subcategory
                                </button>
                                <button type="reset" class="btn btn-outline-secondary">
                                    <i class="fa fa-undo"></i> Reset
                                </button>
                                <a href="{{ route('admin.sub-category.index') }}" class="btn btn-outline-danger">
                                    <i class="fa fa-times"></i> Cancel
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Help Section -->
            <div class="col-lg-4">
                <div class="block">
                    <div class="title"><strong>Help & Guidelines</strong></div>
                    <div class="block-body">
                        <h6><i class="fa fa-lightbulb-o text-warning"></i> Tips for Subcategory:</h6>
                        <ul class="list-unstyled">
                            <li><i class="fa fa-check text-success"></i> Choose descriptive names</li>
                            <li><i class="fa fa-check text-success"></i> Select appropriate category</li>
                            <li><i class="fa fa-check text-success"></i> Add relevant image if available</li>
                            <li><i class="fa fa-check text-success"></i> Examples: Rock Ballads, Jazz Fusion</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('#name').focus();
    
    $('form').on('submit', function() {
        var submitBtn = $(this).find('button[type="submit"]');
        submitBtn.html('<i class="fa fa-spinner fa-spin"></i> Saving...').prop('disabled', true);
    });
});
</script>
@endpush