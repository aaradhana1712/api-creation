@extends('layouts.admin')

@section('title', 'Subcategory Details')
@section('page-title', 'Subcategory Details')

@section('content')
<section class="no-padding-top no-padding-bottom">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <div class="block">
                    <div class="title d-flex justify-content-between align-items-center">
                        <strong>{{ $subcategory->name }}</strong>
                        <div class="btn-group">
                            <a href="{{ route('admin.sub-category.edit', $subcategory->id) }}" class="btn btn-warning">
                                <i class="fa fa-edit"></i> Edit
                            </a>
                            <a href="{{ route('admin.sub-category.index') }}" class="btn btn-primary">
                                <i class="fa fa-arrow-left"></i> Back to List
                            </a>
                        </div>
                    </div>

                    <table class="table table-bordered">
                        <tr>
                            <th width="200">ID</th>
                            <td><span class="badge badge-primary">{{ $subcategory->id }}</span></td>
                        </tr>
                        <tr>
                            <th>Subcategory Name</th>
                            <td><strong>{{ $subcategory->name }}</strong></td>
                        </tr>
                        <tr>
                            <th>Music Category</th>
                            <td>
                                <span class="badge badge-info">
                                    {{ $subcategory->musicCategory->music_category }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Image</th>
                            <td>
                                @if($subcategory->image)
                                    <img src="{{ asset('storage/' . $subcategory->image) }}" 
                                         alt="{{ $subcategory->name }}"
                                         class="img-thumbnail"
                                         style="max-width: 200px; max-height: 200px;">
                                @else
                                    <span class="text-muted">No image uploaded</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Created At</th>
                            <td>{{ $subcategory->created_at->format('d M Y h:i A') }}</td>
                        </tr>
                        <tr>
                            <th>Updated At</th>
                            <td>{{ $subcategory->updated_at->format('d M Y h:i A') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection