@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Posts</div>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Author</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                        @forelse ($posts as $ind => $post)
                            <tr id="post-{{ $post->id }}">
                                <td>{{ $ind + 1 }}</td>
                                <td>{{ $post->name }}</td>
                                <td><a href="{{ route('categories.show', $post->category) }}">{{ $post->category->name }}</a></td>
                                <td>{{ $post->author->name }}</td>

                                <td>
                                    @can('view', $post)
                                        @include('posts.includes.actions.show')
                                    @endcan

                                    @can('update', $post)
                                        @include('posts.includes.actions.edit')
                                    @endcan

                                    @can('delete', $post)
                                        @include('posts.includes.actions.delete')
                                        @include('posts.includes.actions.ajax_delete')
                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td style="text-align: center" colspan="3">No post found.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>

                    <div class="pagination justify-content-center">
                        {{ $posts->links() }}
                    </div>

                    @can('create', Post::class)
                        @include('posts.includes.actions.add')
                    @endcan
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
