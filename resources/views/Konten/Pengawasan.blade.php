@extends('Partials/app')

@push('head-script')
@endpush

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">{{$title}} /</span> {{$subtitle}} Tahun {{$year}}</h4>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

    <div class="row">
        <!-- Kartu Pertama (Hijau) -->
        <div class="col-lg-4 mb-4 order-0">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5 class="card-title">Temuan Bidang</h5>
                    <!-- Tombol Tambah Temuan (Info) -->
                    <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#tambahTemuanModal">
                        Tambah Temuan
                    </button>                  
                    <!-- Tombol Data Lain (Warning) -->
                    <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#dataLainModal">Data Lain</button>
                    <!-- Tombol Modal Baru (Primary) -->
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#cetak">Cetak</button>



                </div>
            </div>
        </div>
        <!-- Kartu Kedua (Kuning) -->
        <div class="col-lg-4 mb-4 order-1">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <h4 class="card-title fw-bold">Temuan Triwulan {{$triwulan}}</h4>
                    <p class="card-text">
                        {{$jumlahPengawasan}} Temuan
                    </p>
                </div>
            </div>
        </div>

        <!-- Kartu Ketiga (Biru) -->
        <div class="col-lg-4 mb-4 order-2">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <h4 class="card-title fw-bold">T. Lanjut Triwulan {{$triwulan}}</h4>
                    <p class="card-text">{{$jumlahTL}} Tindak Lanjut
                    </p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="container-xxl flex-grow-1 container">            
            <div class="card">
                <h5 class="card-header">Data Pengawsan Bidang</h5>
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width: 5%;">No</th>
                            <th style="width: 10%;">Bidang</th>
                            <th style="width: 15%;">Tajuk</th>
                            <th style="width: 20%;">Kondisi</th>
                            <th style="width: 20%;">Rekomendasi</th>
                            <th style="width: 15%;">Eviden</th>
                            <th style="width: 15%;">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @if(count($pengawasanData) > 0)
                            @foreach($pengawasanData as $key => $pengawasan)
                                @php
                                    // Tentukan warna baris berdasarkan kondisiafter
                                    $rowColor = $pengawasan->kondisiafter === null ? 'table-warning' : 'table-success';
                                @endphp
                                <tr class="{{ $rowColor }}">
                                    <td style="width: 5%;">{{ $key + 1 }}</td>
                                    <td style="width: 15%;">{{ \App\Models\Bidang::find($pengawasan->bidang)->nama }}</td>
                                    <td style="width: 15%;">{{ $pengawasan->tajuk }}</td>
                                    <td style="width: 20%;">{{ $pengawasan->kondisi }}</td>
                                    <td style="width: 20%;">{{ $pengawasan->rekomendasi }}</td>
                                    <td style="width: 15%;">
                                        <!-- Tambahkan tag img untuk menampilkan gambar eviden -->
                                        <img src="{{ asset('eviden/' . $pengawasan->eviden) }}" alt="Eviden" class="rounded-circle" width="40" height="40">
                                    </td>
                                    <td style="width: 15%;">
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#tindakLanjutModal{{ $pengawasan->id }}"><i class='bx bx-log-in-circle'></i>
                                                    Tindak Lanjut</a>
                                                <div class="dropdown-divider"></div>                                                
                                                <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#editModal{{ $pengawasan->id }}"><i class="bx bx-edit-alt me-1"></i>
                                                    Edit</a>
                                                <a class="dropdown-item" href="{{ route('print.temuan', ['id' => $pengawasan->id]) }}" target="_blank">
                                                    <i class="bx bx-download me-1"></i> Eviden Temuan
                                                </a>
                                                <a class="dropdown-item" href="{{ route('print.tindaklanjut', ['id' => $pengawasan->id]) }}" target="_blank">
                                                    <i class="bx bx-download me-1"></i> Eviden Tindak Lanjut
                                                </a>
                                                <a class="dropdown-item" href="{{ route('delete.was', $pengawasan->id) }}">
                                                    <i class="bx bx-trash me-1"></i> Delete
                                                </a>
                                            </div>   
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7" style="text-align: center;">Tidak ada pengawasan bidang.</td>
                            </tr>
                        @endif
                    </tbody>
                    
                </table>
                                  
                </div>
            </div>
        </div>
    </div>


    <div class="modal" tabindex="-1" id="cetak">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Isi konten modal di sini -->
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Temuan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('filter.report') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="selectYear">Pilih Tahun:</label>
                            <select class="form-control" id="selectYear" name="year">
                                @php
                                    $currentYear = date('Y');
                                    $yearsToShow = range($currentYear - 3, $currentYear + 3);
                                @endphp
                        
                                @foreach ($yearsToShow as $year)
                                    <option value="{{ $year }}" {{ ($year == $currentYear) ? 'selected' : '' }}>{{ $year }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="selectQuarter">Pilih Triwulan:</label>
                            <select class="form-control" id="selectQuarter" name="quarter">
                                <option value="1">Triwulan 1</option>
                                <option value="2">Triwulan 2</option>
                                <option value="3">Triwulan 3</option>
                                <option value="4">Triwulan 4</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="selectReportType">Pilih Jenis Laporan:</label>
                            <select class="form-control" id="selectReportType" name="report_type">
                                <option value="LHP">Laporan Hasil Pengawasan (LHP)</option>
                                <option value="TLHP">Tindak Lanjut Hasil Pengawasan (TLHP)</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </form>                 
                </div>
            </div>
        </div>
    </div>
    

    {{-- Modal Tambah Temuan --}}
        <div class="modal" tabindex="-1" id="tambahTemuanModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Isi konten modal di sini -->
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Temuan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Form tambah temuan -->
                        <form action="{{ route('tambah.pengawasan') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="tanggal_pengawasan" class="form-label">Tanggal Pengawasan</label>
                                <input type="date" class="form-control" id="tanggal_pengawasan" name="tanggal_pengawasan" required value="{{ $today }}">
                            </div>
                            
                            <div class="mb-3">
                                <label for="bidang" class="form-label">Bidang</label>
                                @if ($bidangs->isEmpty())
                                    <p>Tidak ada bidang. <a href="{{ route('config.wasbid') }}">Tambah bidang</a></p>
                                @else
                                    <select class="form-control" id="bidang" name="bidang" required>
                                        @foreach ($bidangs as $bidang)
                                            <option value="{{ $bidang->id }}">{{ $bidang->nama }}</option>
                                        @endforeach
                                    </select>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="subbidang" class="form-label">Subbidang</label>
                                <input type="text" class="form-control" id="subbidang" name="subbidang" required placeholder="Masukkan subbidang">
                            </div>
                            <div class="mb-3">
                                <label for="tajuk" class="form-label">Tajuk</label>
                                <input type="text" class="form-control" id="tajuk" name="tajuk" required placeholder="Masukkan tajuk">
                            </div>
                            <div class="mb-3">
                                <label for="kondisi" class="form-label">Kondisi</label>
                                <textarea class="form-control" id="kondisi" name="kondisi" required placeholder="Masukkan kondisi"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="kriteria" class="form-label">Kriteria</label>
                                <textarea class="form-control" id="kriteria" name="kriteria" required placeholder="Masukkan kriteria"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="sebab" class="form-label">Sebab</label>
                                <textarea class="form-control" id="sebab" name="sebab" required placeholder="Masukkan sebab"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="akibat" class="form-label">Akibat</label>
                                <textarea class="form-control" id="akibat" name="akibat" required placeholder="Masukkan akibat"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="rekomendasi" class="form-label">Rekomendasi</label>
                                <textarea class="form-control" id="rekomendasi" name="rekomendasi" required placeholder="Masukkan rekomendasi"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="pengawas" class="form-label">Pengawas</label>
                                @if ($hakims->isEmpty())
                                    <p>Tidak ada data hakim. <a href="{{ route('config.wasbid') }}">Tambah data hakim</a></p>
                                @else
                                    <select class="form-control" id="pengawas" name="pengawas" required>
                                        @foreach ($hakims as $hakim)
                                            <option value="{{ $hakim->id }}">{{ $hakim->name }}</option>
                                        @endforeach
                                    </select>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="penanggung_jawab" class="form-label">Penanggung Jawab</label>
                                @if ($pengawas->isEmpty())
                                    <p>Tidak ada data pengawas. <a href="{{ route('config.wasbid') }}">Tambah data pengawas</a></p>
                                @else
                                    <select class="form-control" id="penanggung_jawab" name="penanggung_jawab" required>
                                        @foreach ($pengawas as $p)
                                            <option value="{{ $p->id }}">{{ $p->name }}</option>
                                        @endforeach
                                    </select>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="eviden" class="form-label">Eviden (Foto)</label>
                                <input type="file" class="form-control" id="eviden" name="eviden" accept="image/*" required placeholder="Pilih file eviden">
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    {{-- // Modal Tambah Temuan --}}

    <!-- Modal Data Lain -->
        <div class="modal" tabindex="-1" id="dataLainModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Isi konten modal di sini -->
                    <div class="modal-header">
                        <h5 class="modal-title">Pilihan Triwulan dan Tahun</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('lihat.data') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="triwulan">Triwulan:</label>
                                <select class="form-control" id="triwulan" name="triwulan">
                                    <option value="1">Triwulan 1</option>
                                    <option value="2">Triwulan 2</option>
                                    <option value="3">Triwulan 3</option>
                                    <option value="4">Triwulan 4</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tahun">Tahun:</label>
                                <select class="form-control" id="tahun" name="tahun">
                                    <!-- Auto select tahun sekarang -->
                                    <option value="{{ now()->year }}" selected>{{ now()->year }}</option>
                                    <!-- Pilihan tahun dari 5 tahun ke belakang hingga 5 tahun ke depan -->
                                    @for ($i = now()->year - 5; $i <= now()->year + 5; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Lihat Data</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        </div>             
                    </form>
                </div>
            </div>
        </div>
    <!--// Modal Data Lain -->

<!-- Modal Tindak Lanjut -->
@foreach ($pengawasans as $ba)        
    <div class="modal fade" id="tindakLanjutModal{{ $ba->id }}" tabindex="-1" aria-labelledby="tindakLanjutModalLabel{{ $ba->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Isi modal tindak lanjut disini -->
                <div class="modal-header">
                    <h5 class="modal-title" id="tindakLanjutModalLabel{{ $ba->id }}">Tindak Lanjut {{ $ba->tajuk }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('tindak.lanjut') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="kondisi" class="form-label">Kondisi Awal</label>
                            <textarea class="form-control" id="kondisi" name="kondisi" readonly placeholder="{{ $ba->kondisi }}">{{ $ba->kondisi }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="kondisiafter">Kondisi Setelah Tindak Lanjut:</label>
                            <textarea class="form-control" id="kondisiafter" name="kondisiafter" ></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="evidenafter" class="form-label">Eviden (Foto)</label>
                            <input type="file" class="form-control" id="evidenafter" name="evidenafter" accept="image/*" required>
                        </div>
                        <input type="hidden" id="id" name="id" value="{{ $ba->id }}">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Tindak Lanjut</button>
                        </div>
                    </form>                
                </div>
            </div>
        </div>
    </div>
@endforeach
<!-- //Modal Tindak Lanjut -->

<!-- Modal Edit Temuan -->
@foreach ($pengawasans as $edittem)
    <div class="modal fade" id="editModal{{ $edittem->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $edittem->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Isi modal edit temuan disini -->
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel{{ $edittem->id }}">Edit Temuan {{ $edittem->tajuk }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form edit temuan -->
                <!-- Form Edit Temuan -->
                    <form action="{{ route('edit.pengawasan') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="tanggal_pengawasan" class="form-label">Tanggal Pengawasan</label>
                            <input type="date" class="form-control" id="tanggal_pengawasan" name="tanggal_pengawasan" required value="{{ $edittem->tanggal_pengawasan }}">
                        </div>

                        <div class="mb-3">
                            <label for="bidang" class="form-label">Bidang</label>
                            <select class="form-control" id="bidang" name="bidang" required>
                                @foreach ($bidangs as $bidang)
                                    <option value="{{ $bidang->id }}" {{ $edittem->bidang == $bidang->id ? 'selected' : '' }}>{{ $bidang->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="subbidang" class="form-label">Subbidang</label>
                            <input type="text" class="form-control" id="subbidang" name="subbidang" required value="{{ $edittem->subbidang }}">
                        </div>

                        <div class="mb-3">
                            <label for="tajuk" class="form-label">Tajuk</label>
                            <input type="text" class="form-control" id="tajuk" name="tajuk" required value="{{ $edittem->tajuk }}">
                        </div>
                        <div class="mb-3">
                            <label for="kondisi" class="form-label">Kondisi</label>
                            <textarea class="form-control" id="kondisi" name="kondisi" required placeholder="Masukkan kondisi">{{ $edittem->kondisi }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="kriteria" class="form-label">Kriteria</label>
                            <textarea class="form-control" id="kriteria" name="kriteria" required placeholder="Masukkan kriteria">{{ $edittem->kriteria }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="sebab" class="form-label">Sebab</label>
                            <textarea class="form-control" id="sebab" name="sebab" required placeholder="Masukkan sebab">{{ $edittem->sebab }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="akibat" class="form-label">Akibat</label>
                            <textarea class="form-control" id="akibat" name="akibat" required placeholder="Masukkan akibat">{{ $edittem->akibat }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="rekomendasi" class="form-label">Rekomendasi</label>
                            <textarea class="form-control" id="rekomendasi" name="rekomendasi" required placeholder="Masukkan rekomendasi">{{ $edittem->rekomendasi }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="pengawas" class="form-label">Pengawas</label>
                            @if ($hakims->isEmpty())
                                <p>Tidak ada data hakim. <a href="{{ route('config.wasbid') }}">Tambah data hakim</a></p>
                            @else
                                <select class="form-control" id="pengawas" name="pengawas" required>
                                    @foreach ($hakims as $hakim)
                                        <option value="{{ $hakim->id }}" {{ $hakim->id == $edittem->pengawas_id ? 'selected' : '' }}>
                                            {{ $hakim->name }}
                                        </option>
                                    @endforeach
                                </select>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="penanggung_jawab" class="form-label">Penanggung Jawab</label>
                            @if ($pengawas->isEmpty())
                                <p>Tidak ada data pengawas. <a href="{{ route('config.wasbid') }}">Tambah data pengawas</a></p>
                            @else
                                <select class="form-control" id="penanggung_jawab" name="penanggung_jawab" required>
                                    @foreach ($pengawas as $p)
                                        <option value="{{ $p->id }}" {{ $p->id == $edittem->penanggung_jawab ? 'selected' : '' }}>
                                            {{ $p->name }}
                                        </option>
                                    @endforeach
                                </select>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="eviden" class="form-label">Eviden (Foto)</label>
                            <input type="file" class="form-control" id="eviden" name="eviden" accept="image/*">
                        </div>

                        <input type="hidden" id="id" name="id" value="{{ $edittem->id }}">
                        <input type="hidden" id="year" name="year" value="{{ $year }}">
                        <input type="hidden" id="triwulan" name="triwulan" value="{{ $triwulan }}">

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </form>
                    <!-- // Form Edit Temuan -->

                </div>
            </div>
        </div>
    </div>
@endforeach
<!-- //Modal Edit Temuan -->



@endsection

@push('footer-script')  
@endpush