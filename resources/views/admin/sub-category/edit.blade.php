@extends('layouts.admin')

@section('title', 'Edit Subcategory')
@section('page-title', 'Edit Subcategory')

@section('content')
<section class="no-padding-top no-padding-bottom">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <div class="block">
                    <div class="title d-flex justify-content-between align-items-center">
                        <strong>Edit: {{ $subCategory->name }}</strong>
                        <div class="btn-group">
                            <a href="{{ route('admin.sub-category.show', $subCategory->id) }}" class="btn btn-outline-info">
                                <i class="fa fa-eye"></i> View
                            </a>
                            <a href="{{ route('admin.sub-category.index') }}" class="btn btn-outline-primary">
                                <i class="fa fa-arrow-left"></i> Back to List
                            </a>
                        </div>
                    </div>
                    
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

                    <form action="{{ route('admin.sub-category.update', $subCategory->id) }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group row">
                            <label class="col-sm-3 form-control-label">
                                <strong>Subcategory Name <span class="text-danger">*</span></strong>
                            </label>
                            <div class="col-sm-9">
                                <input id="name" 
                                       name="name" 
                                       type="text" 
                                       class="form-control @error('name') is-invalid @enderror"
                                       value="{{ old('name', $subCategory->name) }}"
                                       placeholder="Enter subcategory name"
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
                                                {{ old('music_category_id', $subCategory->music_category_id) == $category->id ? 'selected' : '' }}>
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
                                <strong>Current Image</strong>
                            </label>
                            <div class="col-sm-9">
                                @if($subCategory->image)
                                    <img src="{{ asset('storage/' . $subCategory->image) }}" 
                                         alt="{{ $subCategory->name }}"
                                         class="img-thumbnail mb-2"
                                         style="max-width: 150px; max-height: 150px;">
                                @else
                                    <p class="text-muted">No image uploaded</p>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 form-control-label">
                                <strong>New Image</strong>
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
                                    <i class="fa fa-info-circle"></i> Leave empty to keep current image
                                </small>
                            </div>
                        </div>

                        <div class="line"></div>

                        <div class="form-group row">
                            <div class="col-sm-9 ml-auto">
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-save"></i> Update Subcategory
                                </button>
                                <button type="reset" class="btn btn-outline-warning">
                                    <i class="fa fa-undo"></i> Reset Changes
                                </button>
                                <a href="{{ route('admin.sub-category.index') }}" class="btn btn-outline-secondary">
                                    <i class="fa fa-times"></i> Cancel
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
