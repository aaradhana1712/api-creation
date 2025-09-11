@extends('layouts.admin')

@section('title', 'Add Music Category')
@section('page-title', 'Add New Music Category')

@section('content')
<section class="no-padding-top no-padding-bottom">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <div class="block">
                    <div class="title d-flex justify-content-between align-items-center">
                        <strong>Create Music Category</strong>
                        <a href="{{ route('admin.music-categories.index') }}" class="btn btn-outline-primary">
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
                    <form action="{{ route('admin.music-categories.store') }}" method="POST" class="form-horizontal">
                        @csrf
                        
                        <div class="form-group row">
                            <label class="col-sm-3 form-control-label">
                                <strong>Category Name <span class="text-danger">*</span></strong>
                            </label>
                            <div class="col-sm-9">
                                <input id="music_category" 
                                       name="music_category" 
                                       type="text" 
                                       class="form-control @error('music_category') is-invalid @enderror"
                                       value="{{ old('music_category') }}"
                                       placeholder="Enter music category name (e.g., Rock, Pop, Jazz)"
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
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-save"></i> Submit & Save Category
                                </button>
                                <button type="reset" class="btn btn-outline-secondary">
                                    <i class="fa fa-undo"></i> Reset
                                </button>
                                <a href="{{ route('admin.music-categories.index') }}" class="btn btn-outline-danger">
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
                        <h6><i class="fa fa-lightbulb-o text-warning"></i> Tips for Category Names:</h6>
                        <ul class="list-unstyled">
                            <li><i class="fa fa-check text-success"></i> Use clear, descriptive names</li>
                            <li><i class="fa fa-check text-success"></i> Keep it short and memorable</li>
                            <li><i class="fa fa-check text-success"></i> Avoid special characters</li>
                            <li><i class="fa fa-check text-success"></i> Examples: Rock, Pop, Jazz, Classical</li>
                        </ul>
                        
                        <hr>
                        
                        <h6><i class="fa fa-info-circle text-info"></i> What happens next?</h6>
                        <p class="text-muted small">
                            After creating the category, you'll be redirected to the categories list where you can:
                        </p>
                        <ul class="list-unstyled small text-muted">
                            <li><i class="fa fa-eye"></i> View category details</li>
                            <li><i class="fa fa-edit"></i> Edit category name</li>
                            <li><i class="fa fa-trash"></i> Delete if not in use</li>
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
    // Auto focus on category input
    $('#music_category').focus();
    
    // Character counter
    $('#music_category').on('input', function() {
        var maxLength = 255;
        var currentLength = $(this).val().length;
        var remaining = maxLength - currentLength;
        
        // Visual feedback for character limit
        if (remaining < 20) {
            $(this).addClass('border-warning');
        } else {
            $(this).removeClass('border-warning');
        }
        
        if (remaining < 0) {
            $(this).addClass('border-danger');
        } else {
            $(this).removeClass('border-danger');
        }
    });
    
    // Form submission loading state
    $('form').on('submit', function() {
        var submitBtn = $(this).find('button[type="submit"]');
        submitBtn.html('<i class="fa fa-spinner fa-spin"></i> Saving...').prop('disabled', true);
    });
    
    // Reset button confirmation
    $('button[type="reset"]').on('click', function(e) {
        if (!confirm('Are you sure you want to reset all fields?')) {
            e.preventDefault();
        }
    });
});
</script>
@endpush