@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Categories</div>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                        @forelse ($categories as $ind => $category)
                            <tr id="category-{{ $category->id }}">
                                <td>{{ $ind + 1 }}</td>
                                <td>{{ $category->name }}</td>
                                <td>
                                    @can('view', $category)
                                        @include('categories.includes.show')
                                    @endcan

                                    @can('update', $category)
                                        @include('categories.includes.edit')
                                    @endcan

                                    @can('delete', $category)
                                        @include('categories.includes.delete')
                                        @include('categories.includes.ajax_delete')
                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td style="text-align: center" colspan="3">No category found.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>

                    <div class="pagination justify-content-center">
                        {{ $categories->links() }}
                    </div>

                    @can('create', Category::class)
                        @include('categories.includes.add')
                    @endcan
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
