<form style="display: inline-block" action="{{ route('posts.destroy', $post) }}" method="post">
    @method('DELETE')
    @csrf

    <button type="submit" class="btn btn-outline-danger">Delete</button>
</form>