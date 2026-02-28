<h1>Detail Aspirasi</h1>

<h3>{{ $aspirasi->judul }}</h3>
<p><strong>Kategori:</strong> {{ optional($aspirasi->kategori)->nama_kategori ?? 'Kategori tidak ditemukan' }}</p>
<p><strong>Isi Aspirasi:</strong> {{ $aspirasi->isi }}</p>
<p><strong>Status:</strong> {{ $aspirasi->status }}</p>
<p><strong>Dikirim pada:</strong> {{ $aspirasi->created_at->format('d M Y H:i') }}</p>

<hr>

<h3>Feedback dari Admin</h3>
@if($aspirasi->feedback->count() > 0)
    <ul>
        @foreach($aspirasi->feedback as $fb)
            <li>
                <strong>{{ $fb->created_at->format('d M Y H:i') }}:</strong> {{ $fb->isi_feedback }}
            </li>
        @endforeach
    </ul>
@else
    <p>Belum ada feedback dari admin.</p>
@endif

<hr>

<h3>Progress Update</h3>
@if($aspirasi->progress->count() > 0)
    <ul>
        @foreach($aspirasi->progress as $p)
            <li>
                <strong>{{ $p->created_at->format('d M Y H:i') }}:</strong> {{ $p->keterangan }}
            </li>
        @endforeach
    </ul>
@else
    <p>Belum ada update progres.</p>
@endif

<p>
    <a href="{{ route('siswa.dashboard') }}">Kembali ke Dashboard</a>
</p>