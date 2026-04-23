<form action="{{ $url }}" method="POST" onsubmit="return confirm('Yakin hapus data?')">
    @csrf
    @method('DELETE')

    <button type="submit"
        class="inline-flex items-center gap-1 px-3 py-1.5 bg-red-500 hover:bg-red-600 text-white text-xs rounded-md shadow-md">
        🗑 Delete
    </button>
</form>