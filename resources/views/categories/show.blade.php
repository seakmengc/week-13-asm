@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $category->name }}</div>

                    <h5 class="pl-2 pt-3">Posts:</h5>
                    <ul>
                        @forelse($category->posts as $ind => $post)
                            <li><a href="{{ route('posts.show', $post) }}">{{ $post->name }}</a></li>
                        @empty
                            <li>No post yet in this category.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
