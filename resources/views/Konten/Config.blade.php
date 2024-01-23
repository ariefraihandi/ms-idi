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
                        <a class="nav-link active" href="{{ route('config.instansi') }}"><i class="bx bx-building me-1"></i> Instansi</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link " href="{{ route('config.wasbid') }}"><i class="bx bxs-binoculars me-1"></i> Pengawasan Bidang</a>
                      </li>
                    </li>                   
                    </li>
                  </ul>
                  <h5 class="card-header">Instansi Details</h5>
                  <div class="card mb-4">
                    <div class="card-body">
                        <form action="{{ route('update.logo') }}" method="post" enctype="multipart/form-data" id="logoForm">
                            @csrf
                            <div class="d-flex align-items-start align-items-sm-center gap-4">
                                <img src="{{ asset('assets') }}/img/profile/{{ $instansi->logo }}" alt="instansi-avatar"
                                    class="d-block rounded" height="100" width="100" id="uploadedAvatarLogo" />
                                <div class="button-wrapper">
                                    <label for="uploadLogo" class="btn btn-primary me-2 mb-4" tabindex="0">
                                        <span class="d-none d-sm-block">Upload new Logo</span>
                                        <i class="bx bx-upload d-block d-sm-none"></i>
                                        <input type="file" id="uploadLogo" name="logo" class="account-file-input" hidden
                                            accept="image/png, image/jpeg" onchange="submitForm('logoForm')" />
                                    </label>
                                    <p class="text-muted mb-0">Allowed JPG, GIF, or PNG. Max size of 800K</p>
                                </div>
                            </div>
                        </form>
                    </div>
                    <hr class="my-0" />
                    <div class="card mb-4">
                        <div class="card-body">
                            <form action="{{ route('update.kopsurat') }}" method="post" enctype="multipart/form-data" id="kopForm">
                                @csrf
                                <div class="d-flex align-items-start align-items-sm-center gap-4">
                                    <img src="{{ asset('assets') }}/img/profile/{{ $instansi->kop_surat }}" alt="instansi-avatar"
                                        class="d-block rounded" height="120" width="550" id="uploadedAvatarKop" />
                                    <div class="button-wrapper">
                                        <label for="uploadKop" class="btn btn-primary me-2 mb-4" tabindex="0">
                                            <span class="d-none d-sm-block">Upload Kop Surat</span>
                                            <i class="bx bx-upload d-block d-sm-none"></i>
                                            <input type="file" id="uploadKop" name="logo" class="account-file-input" hidden
                                                accept="image/png, image/jpeg" onchange="submitForm('kopForm')" />
                                        </label>
                                        <p class="text-muted mb-0">Allowed JPG, GIF, or PNG. Max size of 800K</p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
            
                  
                    <hr class="my-0" />
                    <div class="card-body">
                        <form id="formInstansi" method="POST" action="{{ route('instansi.update') }}">
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="name" class="form-label">Name</label>
                                    <input class="form-control" type="text" id="name" name="name" value="{{ optional($instansi)->name }}" autofocus />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="short_name" class="form-label">Short Name</label>
                                    <input class="form-control" type="text" id="short_name" name="short_name" value="{{ optional($instansi)->short_name }}" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="long_name" class="form-label">Long Name</label>
                                    <input class="form-control" type="text" id="long_name" name="long_name" value="{{ optional($instansi)->long_name }}" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="alamat" class="form-label">Address</label>
                                    <input class="form-control" type="text" id="alamat" name="alamat" value="{{ optional($instansi)->alamat }}" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="email" class="form-label">Email</label>
                                    <input class="form-control" type="text" id="email" name="email" value="{{ optional($instansi)->email }}" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="wa" class="form-label">WhatsApp</label>
                                    <input class="form-control" type="text" id="wa" name="wa" value="{{ optional($instansi)->wa }}" />
                                </div>
                                <!-- Field tambahan -->
                                <div class="mb-3 col-md-6">
                                    <label for="zip_code" class="form-label">Zip Code</label>
                                    <input class="form-control" type="text" id="zip_code" name="zip_code" value="{{ optional($instansi)->zip_code }}" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="country" class="form-label">Country</label>
                                    <input class="form-control" type="text" id="country" name="country" value="{{ optional($instansi)->country }}" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="phone_number" class="form-label">Phone Number</label>
                                    <input class="form-control" type="text" id="phone_number" name="phone_number" value="{{ optional($instansi)->phone_number }}" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="website" class="form-label">Website</label>
                                    <input class="form-control" type="text" id="website" name="website" value="{{ optional($instansi)->website }}" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" id="description" name="description">{{ optional($instansi)->description }}</textarea>
                                </div>                               
                            </div>
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary me-2">Save changes</button>
                                <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                            </div>
                        </form>
                        
                        
                    </div>                    
                  </div>
                  
                </div>
              </div>
            </div>
            <!-- / Content -->
    

  @endsection

  @push('footer-script')
  <script>
      function submitForm(formId) {
          document.getElementById(formId).submit();
      }
  </script>
  @endpush