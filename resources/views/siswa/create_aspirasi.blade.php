<h1>Tambah Aspirasi Baru</h1>

<form action="{{ route('siswa.aspirasi.store') }}" method="POST">
    @csrf
    <label>Kategori:</label><br>
    <select name="kategori_id" required>
        <option value="">-- Pilih Kategori --</option>
        @foreach($kategori as $k)
            <option value="{{ $k->id }}">{{ $k->nama_kategori }}</option>
        @endforeach
    </select><br><br>

    <label>Judul:</label><br>
    <input type="text" name="judul" required><br><br>

    <label>Isi Aspirasi:</label><br>
    <textarea name="isi" rows="5" required></textarea><br><br>

    <button type="submit">Kirim Aspirasi</button>
</form>

<p><a href="{{ route('siswa.dashboard') }}">Kembali ke Dashboard</a></p>