@extends('Partials/app')

@push('head-script')
@endpush

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">{{$title}} /</span> {{$subtitle}}</h4>
    @if(session('success'))
      <div class="alert alert-success mt-3" role="alert">
          {{ session('success') }}
      </div>
    @endif

    @if(session('error'))
      <div class="alert alert-danger mt-3" role="alert">
          {{ session('error') }}
      </div>
    @endif
        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    <li class="nav-item">
                      <a class="nav-link" href="{{ route('config.instansi') }}"><i class="bx bx-building me-1"></i> Instansi</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link active" href="{{ route('config.wasbid') }}"><i class="bx bxs-binoculars me-1"></i> Pengawasan Bidang</a>
                    </li>                  
                </ul>
                <div class="card mb-4">
                    <h5 class="card-header">Instansi Details</h5>
                    <div class="card-body d-flex flex-wrap justify-content-center">
                        <div class="card me-3 flex-grow-1 mb-3" style="max-width: 540px; background-color: #4CAF50; color: #fff;">
                            <div class="card-body text-center">
                                <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#tambahHakimModal">
                                    Tambah Hakim
                                </button>
                            </div>
                        </div>
                        <div class="card me-3 flex-grow-1 mb-3" style="max-width: 540px; background-color: #FFD700; color: #000;">
                            <div class="card-body text-center">
                                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#tambahBidangModal">
                                    Tambah Bidang
                                </button>
                            </div>
                        </div>
                        <div class="card me-3 flex-grow-1 mb-3" style="max-width: 540px; background-color: #3498DB; color: #fff;">
                            <div class="card-body text-center">
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#tambahPenanggungJawabModal">
                                    Tambah Penangung Jawab
                                </button>
                            </div>
                        </div>
                    </div>
                </div>                  
                <hr class="my-0" />
                <div class="container-xxl flex-grow-1 container-p-y">                      
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <h5 class="card-header">Hakim Pengawas</h5>
                                <div class="table-responsive text-nowrap">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Nama</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-border-bottom-0">
                                            @forelse($hakims as $hakim)
                                                <tr>
                                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $hakim->name }}</strong></td>                                          
                                                    <td>
                                                        <div class="dropdown">
                                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                                <i class="bx bx-dots-vertical-rounded"></i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editUserModal{{ $hakim->id }}">
                                                                    <i class="bx bx-edit-alt me-1"></i> Edit
                                                                </button>
                                                                <a class="dropdown-item" href="{{ route('delete.user', $hakim->id) }}">
                                                                    <i class="bx bx-trash me-1"></i> Delete
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="2" class="text-center">Data Kosong</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>                                                                       
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <h5 class="card-header">Bidang Pengawasan</h5>
                                <div class="table-responsive text-nowrap">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Bidang</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-border-bottom-0">
                                            @forelse($bidangs as $bidang)
                                                <tr>
                                                    <td>{{ $bidang->nama }}</td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                                <i class="bx bx-dots-vertical-rounded"></i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editBidangModal{{ $bidang->id }}">
                                                                    <i class="bx bx-edit-alt me-1"></i> Edit
                                                                </button>
                                                                <a class="dropdown-item" href="{{ route('hapus.bidang', $bidang->id) }}">
                                                                    <i class="bx bx-trash me-1"></i> Delete
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>                                               
                                            @empty
                                                <tr>
                                                    <td colspan="2">Tidak ada bidang.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <h5 class="card-header">Penangung Jawab</h5>
                                <div class="table-responsive text-nowrap">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Nama</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-border-bottom-0">
                                            @foreach($penanggungJawabs as $penanggungJawab)
                                                <tr>
                                                    <td>
                                                        <i class="fab fa-angular fa-lg text-danger me-3"></i>
                                                        <strong>{{ $penanggungJawab->name }}</strong>
                                                    </td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                                <i class="bx bx-dots-vertical-rounded"></i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editUserModal{{ $penanggungJawab->id }}">
                                                                    <i class="bx bx-edit-alt me-1"></i> Edit
                                                                </button>
                                                                <!-- Tambahkan href untuk route hapus pengawas -->
                                                                <a class="dropdown-item" href="{{ route('delete.user', $penanggungJawab->id) }}">
                                                                    <i class="bx bx-trash me-1"></i> Delete
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                                          
                    </div> 
                </div>
            </div>
        </div>  
    </div>  

    <!-- Modal "Tambah Hakim" -->
    <div class="modal fade" id="tambahHakimModal" tabindex="-1" aria-labelledby="tambahHakimModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Header modal -->
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahHakimModalLabel">Tambah Hakim</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <!-- Body modal -->
                <div class="modal-body">
                    <!-- Isi form atau konten modal sesuai kebutuhan -->
                    <form action="{{ route('add.user') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="namaHakim" class="form-label">Nama Hakim</label>
                            <input type="text" class="form-control" id="namaHakim" name="name" required placeholder="Masukkan nama hakim">
                        </div>

                        <div class="mb-3">
                            <label for="usernameHakim" class="form-label">Username</label>
                            <input type="text" class="form-control" id="usernameHakim" name="username" required placeholder="Masukkan username">
                        </div>

                        <div class="mb-3">
                            <label for="emailHakim" class="form-label">Email</label>
                            <input type="email" class="form-control" id="emailHakim" name="email" required placeholder="Masukkan email">
                        </div>
                        <div class="mb-3">
                            <label for="waHakim" class="form-label">WhatsApp</label>
                            <input type="text" class="form-control" id="waHakim" name="wa" placeholder="Masukkan nomor WhatsApp">
                        </div>
                        
                        <input type="hidden" class="form-control" id="role" name="role" required value="2">
                        <input type="hidden" class="form-control" id="password" name="password" required value="123456">
                        <input type="hidden" class="form-control" id="token" name="token" required value="{{$instansi->token}}">                    
                    </div>
                    
                    <!-- Footer modal -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- // Modal "Tambah Hakim" -->
    
    <!-- Modal "Tambah Hakim" -->
    <div class="modal fade" id="tambahPenanggungJawabModal" tabindex="-1" aria-labelledby="tambahPenanggungJawabModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Header modal -->
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahPenanggungJawabModal">Tambah Penangung Jawab</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <!-- Body modal -->
                <div class="modal-body">
                    <!-- Isi form atau konten modal sesuai kebutuhan -->
                    <form action="{{ route('add.user') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="namaHakim" class="form-label">Nama Hakim</label>
                            <input type="text" class="form-control" id="namaHakim" name="name" required placeholder="Masukkan nama hakim">
                        </div>
                    
                        <div class="mb-3">
                            <label for="usernameHakim" class="form-label">Username</label>
                            <input type="text" class="form-control" id="usernameHakim" name="username" required placeholder="Masukkan username">
                        </div>
                    
                        <div class="mb-3">
                            <label for="emailHakim" class="form-label">Email</label>
                            <input type="email" class="form-control" id="emailHakim" name="email" required placeholder="Masukkan email">
                        </div>
                    
                        <div class="mb-3">
                            <label for="waHakim" class="form-label">WhatsApp</label>
                            <input type="text" class="form-control" id="waHakim" name="wa" placeholder="Masukkan nomor WhatsApp">
                        </div>
                    
                        <div class="mb-3">
                            <label for="role" class="form-label">Jabatan</label>
                            <select class="form-select" id="role" name="role" required>
                                <option value="3">Sekretaris</option>
                                <option value="4">Panitera</option>
                            </select>
                        </div>
                    
                        <!-- Hidden fields -->
                        <input type="hidden" class="form-control" id="password" name="password" required value="123456">
                        <input type="hidden" class="form-control" id="token" name="token" required value="{{ $instansi->token }}">
                    
                        <!-- Footer modal -->
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
    <!-- // Modal "Tambah Hakim" -->

    <!-- Modal Tambah Bidang -->
    <div class="modal fade" id="tambahBidangModal" tabindex="-1" aria-labelledby="tambahBidangModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahBidangModalLabel">Tambah Bidang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('tambah.bidang') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="namaBidang" class="form-label">Nama Bidang</label>
                            <input type="text" class="form-control" id="namaBidang" name="namaBidang" required placeholder="Masukkan nama bidang">
                        </div>
                        <!-- Tambahkan elemen input lainnya sesuai kebutuhan -->
                        <!-- ... -->

                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    <!-- // Modal Tambah Bidang -->


    <!-- Modal Edit User -->
    @foreach ($users as $user)
    <div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1" aria-labelledby="editUserModalLabel{{ $user->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Isi modal edit user disini -->
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel{{ $user->id }}">Edit User - {{ $user->name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('edit.user') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="namaHakim" class="form-label">Nama Hakim</label>
                            <input type="text" class="form-control" id="namaHakim" name="name" required placeholder="Masukkan nama hakim" value="{{ $user->name }}">
                        </div>
                    
                        <div class="mb-3">
                            <label for="usernameHakim" class="form-label">Username</label>
                            <input type="text" readonly class="form-control" id="usernameHakim" name="username" required placeholder="Masukkan username" value="{{ $user->username }}">
                        </div>
                    
                        <div class="mb-3">
                            <label for="emailHakim" class="form-label">Email</label>
                            <input type="email" class="form-control" id="emailHakim" name="email" required placeholder="Masukkan email" value="{{ $user->email }}">
                        </div>
                        
                        <div class="mb-3">
                            <label for="waHakim" class="form-label">WhatsApp</label>
                            <input type="text" class="form-control" id="waHakim" name="wa" placeholder="Masukkan nomor WhatsApp" value="{{ $user->wa }}">
                        </div>
                        
                        <input type="hidden" class="form-control" id="id" name="id" required value="{{ $user->id }}">
                        
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>                    
                </div>
            </div>
        </div>
    </div>
    @endforeach
    <!-- // Modal Edit User -->

    <!-- Modal Edit Bidang -->
    @foreach ($bidangs as $bidang)
    <div class="modal fade" id="editBidangModal{{ $bidang->id }}" tabindex="-1" aria-labelledby="editBidangModalLabel{{ $bidang->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Isi modal edit bidang disini -->
                <div class="modal-header">
                    <h5 class="modal-title" id="editBidangModalLabel{{ $bidang->id }}">Edit Bidang - {{ $bidang->nama }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('edit.bidang') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Bidang</label>
                            <input type="text" class="form-control" id="nama" name="nama" required placeholder="Masukkan nama bidang" value="{{ $bidang->nama }}">
                        </div>
                        
                        <!-- Add other fields for editing bidang as needed -->

                        <input type="hidden" class="form-control" id="id" name="id" required value="{{ $bidang->id }}">
                        
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>                    
                </div>
            </div>
        </div>
    </div>
    @endforeach
    <!-- // Modal Edit Bidang -->

@endsection

@push('footer-script')  
@endpush