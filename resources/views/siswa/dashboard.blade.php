<h1>Dashboard Siswa</h1>
<p>Selamat datang, {{ Auth::user()->name }}</p>

<p><a href="{{ route('siswa.aspirasi.create') }}">Tambah Aspirasi Baru</a></p>

@if(session('success'))
    <p style="color:green;">{{ session('success') }}</p>
@endif

<h3>Daftar Aspirasi Anda</h3>
<table border="1" cellpadding="8">
    <tr>
        <th>No</th>
        <th>Judul</th>
        <th>Kategori</th>
        <th>Status</th>
        <th>Tanggal</th>
        <th>Aksi</th>
    </tr>
    @foreach($aspirasi as $index => $a)
    <tr>
        <td>{{ $index + 1 }}</td>
        <td>{{ $a->judul }}</td>
        <td>{{ optional($a->kategori)->nama_kategori ?? 'Kategori tidak ditemukan' }}</td>
        <td>{{ $a->status }}</td>
        <td>{{ $a->created_at->format('d-m-Y') }}</td>
        <td>
            <a href="{{ route('siswa.aspirasi.detail', $a->id) }}">Detail</a>
        </td>
    </tr>
    @endforeach
</table>

<p>
    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
</p>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
    @csrf
</form>