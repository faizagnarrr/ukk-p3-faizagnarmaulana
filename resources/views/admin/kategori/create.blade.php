<h1>Tambah Kategori</h1>

<form action="{{ route('kategori.store') }}" method="POST">
    @csrf
    <label>Nama Kategori:</label><br>
    <input type="text" name="nama_kategori" required><br><br>

    <label>Deskripsi:</label><br>
    <textarea name="deskripsi"></textarea><br><br>

    <button type="submit">Simpan</button>
</form>

<a href="{{ route('kategori.index') }}">Kembali</a>