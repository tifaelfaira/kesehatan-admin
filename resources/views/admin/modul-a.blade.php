<a href="{{ route('modulA.create') }}" class="btn btn-success mb-3">
  <i class="fa-solid fa-plus"></i> Tambah Data
</a>

<a href="{{ route('modulA.edit', $item->id) }}" class="btn btn-warning btn-sm">
  <i class="fa-solid fa-pen"></i>
</a>

<form action="{{ route('modulA.destroy', $item->id) }}" method="POST" style="display:inline">
  @csrf
  @method('DELETE')
  <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">
    <i class="fa-solid fa-trash"></i>
  </button>
</form>
