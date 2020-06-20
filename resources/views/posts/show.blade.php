@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $post->name }}</div>

                    <div class="p-3">
                        <p>Category: </p>
                        <a href="{{ route('categories.show', $post->category) }}">{{  $post->category->name }}</a>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
@endsection
