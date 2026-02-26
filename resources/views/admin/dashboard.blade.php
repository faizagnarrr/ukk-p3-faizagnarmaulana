<h1>Admin Dashboard</h1>
<p>Selamat datang, {{ Auth::user()->name }}</p>

<h3>Filter Aspirasi</h3>
<form method="GET" action="{{ route('admin.dashboard') }}" style="margin-bottom:20px;">

    <!-- Filter Tanggal -->
    <label>Tanggal:</label>
    <input type="date" name="tanggal" value="{{ request('tanggal') }}">

    <!-- Filter Kategori -->
    <label>Kategori:</label>
    <select name="kategori_id">
        <option value="">-- Semua Kategori --</option>
        @foreach($kategori as $k)
            <option value="{{ $k->id }}"
                {{ request('kategori_id') == $k->id ? 'selected' : '' }}>
                {{ $k->nama_kategori }}
            </option>
        @endforeach
    </select>

    <!-- Search Nama Siswa -->
    <label>Nama Siswa:</label>
    <input type="text" name="nama_siswa"
           value="{{ request('nama_siswa') }}"
           placeholder="Cari nama siswa...">

    <button type="submit">Filter</button>
    <a href="{{ route('admin.dashboard') }}">Reset</a>

</form>

<hr>

<h3>Daftar Aspirasi</h3>
<table border="1" cellpadding="8">
    <tr>
        <th>No</th>
        <th>Judul</th>
        <th>Pengirim</th>
        <th>Kategori</th>
        <th>Status</th>
        <th>Tanggal</th>
        <th>Aksi</th>
    </tr>
    @forelse($aspirasi as $index => $a)
    <tr>
        <td>{{ $index + 1 }}</td>
        <td>{{ $a->judul }}</td>
        <td>{{ $a->user->name ?? '-' }}</td>
        <td>{{ $a->kategori->nama_kategori ?? '-' }}</td>
        <td>{{ $a->status }}</td>
        <td>{{ $a->created_at->format('d-m-Y') }}</td>
        <td>
            <a href="{{ route('admin.aspirasi.detail', $a->id) }}">Detail / Edit</a>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="7" align="center">Tidak ada data ditemukan</td>
    </tr>
    @endforelse
</table>

<h3>Menu Admin</h3>
<ul>
    <li><a href="{{ route('kategori.index') }}">Kelola Kategori</a></li>
</ul>

<p>
    <a href="{{ route('logout') }}"
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
       Logout
    </a>
</p>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
    @csrf
</form>