<h1>Kelola Kategori</h1>

<a href="{{ route('kategori.create') }}">Tambah Kategori</a>

@if(session('success'))
    <p style="color:green;">{{ session('success') }}</p>
@endif

<table border="1" cellpadding="8">
    <tr>
        <th>No</th>
        <th>Nama Kategori</th>
        <th>Deskripsi</th>
        <th>Aksi</th>
    </tr>
    @foreach($kategori as $index => $k)
    <tr>
        <td>{{ $index + 1 }}</td>
        <td>{{ $k->nama_kategori }}</td>
        <td>{{ $k->deskripsi }}</td>
        <td>
            <a href="{{ route('kategori.edit', $k->id) }}">Edit</a> |
            <form action="{{ route('kategori.destroy', $k->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Hapus kategori ini?')">Hapus</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

<a href="{{ route('admin.dashboard') }}">Kembali</a>