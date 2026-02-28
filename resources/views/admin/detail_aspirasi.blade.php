<h1>Detail Aspirasi</h1>

<h3>{{ $aspirasi->judul }}</h3>
<p><strong>Pengirim:</strong> {{ optional($aspirasi->user)->nama ?? 'User tidak ditemukan' }}</p>
<p><strong>Kategori:</strong> {{ optional($aspirasi->kategori)->nama_kategori ?? 'Kategori tidak ditemukan' }}</p>
<p><strong>Isi:</strong> {{ $aspirasi->isi }}</p>
<p><strong>Status:</strong> {{ ucfirst($aspirasi->status) }}</p>
<p><strong>Dikirim pada:</strong> {{ $aspirasi->created_at->format('d M Y H:i') }}</p>

<hr>

<h3>Feedback</h3>
@if(session('success_feedback'))
    <p style="color:green;">{{ session('success_feedback') }}</p>
@endif

<ul>
    @forelse($aspirasi->feedback as $fb)
        <li>
            <strong>{{ $fb->created_at->format('d M Y H:i') }}:</strong> {{ $fb->isi_feedback }}
        </li>
    @empty
        <li>Belum ada feedback</li>
    @endforelse
</ul>

<form action="{{ route('admin.aspirasi.feedback', $aspirasi->id) }}" method="POST">
    @csrf
    <textarea name="isi_feedback" rows="3" placeholder="Tulis feedback..." required></textarea><br>
    <button type="submit">Tambah Feedback</button>
</form>

<hr>

<h3>Update Status Aspirasi</h3>
@if(session('success_progress'))
    <p style="color:green;">{{ session('success_progress') }}</p>
@endif

<form action="{{ route('admin.aspirasi.progress', $aspirasi->id) }}" method="POST">
    @csrf
    <label for="status">Pilih Status:</label>
    <select name="status" id="status" required>
        <option value="dikirim" {{ $aspirasi->status === 'dikirim' ? 'selected' : '' }}>Dikirim</option>
        <option value="diproses" {{ $aspirasi->status === 'diproses' ? 'selected' : '' }}>Diproses</option>
        <option value="selesai" {{ $aspirasi->status === 'selesai' ? 'selected' : '' }}>Selesai</option>
    </select>
    <button type="submit">Update Status</button>
</form>

<p>
    <a href="{{ route('admin.dashboard') }}">Kembali ke Dashboard</a>
</p>