<form style="display: inline-block" action="{{ route('categories.destroy', $category) }}" method="post">
	@method('DELETE')
	@csrf

	<button type="submit" class="btn btn-outline-danger">Delete</button>
</form>