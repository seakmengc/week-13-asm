@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit {{ $category->name }}</div>

                    <form action="{{ route('categories.update', $category) }}" class="p-3 pb-5" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Name *</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') ?? $category->name }}" required>
                            <p class="text-danger">@error('name') {{ $errors->first('name') }} @enderror</p>
                        </div>
                        


                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
