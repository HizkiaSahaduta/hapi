@extends('main')

{{-- Content Page CSS Begin--}}
@section('contentcss')
<link href="{{ asset('outside/plugins/dropify/dropify.min.css') }}" rel="stylesheet" type="text/css" >
<link href="{{ asset('outside/assets/css/users/account-setting.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('outside/plugins/table/datatable/datatables.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('outside/plugins/table/datatable/dt-global_style.css') }}" rel="stylesheet" type="text/css">
<link href="https://cdn.datatables.net/responsive/2.2.4/css/responsive.dataTables.min.css" rel="stylesheet"/>
<link href="{{ asset('outside/fa/css/font-awesome.min.css') }}" rel="stylesheet">
<link href="{{ asset('outside/assets/css/elements/tooltip.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('outside/assets/css/components/custom-modal.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('outside/plugins/notification/snackbar/snackbar.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('outside/assets/css/components/tabs-accordian/custom-tabs.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('outside/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('outside/plugins/flatpickr/flatpickr.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('outside/assets/css/forms/theme-checkbox-radio.css') }}" rel="stylesheet" type="text/css" >
<link href="{{ asset('outside/assets/css/components/custom-media_object.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('outside/assets/css/forms/switches.css') }}" rel="stylesheet" type="text/css">
<style>

.media img {
    width: 80%;
    height: 80%;
    margin-right: 5%;
    margin-left: 10%;
}
.widget-content-area {
  box-shadow: none !important; }

hr.style {
  border-top: 1px dashed #888ea8;
}

.badge {
  background: transparent; }

.badge-primary {
  color: #1b55e2;
  border: 2px dashed #1b55e2; }

.badge-warning {
  color: #e2a03f;
  border: 2px dashed #e2a03f; }

.badge-danger {
  color: #e7515a;
  border: 2px dashed #e7515a; }

.badge-success {
  color: #8dbf42;
  border: 2px dashed #8dbf42; }

.badge-info {
    position: absolute;
    font-size: 9px;
    right: 2%;
    color: #2196f3;
    border: 1px dashed;
}

.table > thead > tr > th {
  color: #ffffff;
  font-weight: 700;
  font-size: 12px;
  letter-spacing: 1px;
  text-transform: uppercase;
  background : #373a40;  
}

.table > tbody > tr > td {
    font-size: 12px;
}

@media (max-width: 991px) {
    
    .table > tbody > tr > td {
        font-size: 11px;
    }

    .table > thead > tr > th {
        font-size: 11px;
    }

    div.dataTables_wrapper div.dataTables_info {
        font-size: 11px; 
    }

    .modal-content .modal-header h5 {
        font-size: 16px;
    }
}

</style>
@endsection
{{-- Content CSS End--}}

{{-- Content Navbar Content Begin--}}
@section('navbar_content')
<div class="sub-header-container">
    <header class="header navbar navbar-expand-sm">
        <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg></a>

        <ul class="navbar-nav flex-row">
            <li>
                <div class="page-header">
                    <nav class="breadcrumb-one" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Keanggotaan</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><a href="{{ url('MemberMgt') }}">Manajemen Anggota</a></li>
                        </ol>
                    </nav>
                </div>
            </li>
        </ul>

        <ul class="navbar-nav flex-row ml-auto ">
			<li class="nav-item more-dropdown">
				<div class="dropdown  custom-dropdown-icon">
					<a class="dropdown-toggle btn" href="#" role="button" id="customDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span>Hello, {{ Auth::user()->name1 }}</span> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg></a>

					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="customDropdown">

                        @if(session()->has('mnuMyAccount'))
                        <a class="dropdown-item" data-value="UserProfile" href="{{ url('MyAccount') }}">Akun Saya</a>
                        @endif

                        @if(session()->has('mnuMyAccount'))
                        <a class="dropdown-item" data-value="UserProfile" href="{{ url('ChangePass') }}">Ganti Password</a>
                        @endif

						<a class="dropdown-item" data-value="Logout" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Keluar</a>
					</div>

					<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
						{{ csrf_field() }}
					</form>

				</div>
			</li>
        </ul>


    </header>
</div>
@endsection
{{-- Content Navbar Content End--}}


{{-- Content Page Begin--}}
@section('content')
<div class="layout-px-spacing">
    <div class="row layout-top-spacing">

        <div class="col-lg-12 col-md-12 layout-spacing" id="satu">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4 id='DocTitle'></h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content-area">
                    <a href="javascript:void(0)" class="btn btn-dark mb-2" id="btnAddMember">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                        Tambah Anggota
                    </a>
                    <a href="javascript:void(0)" class="btn btn-info mb-2" id="btnFilter">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-zoom-in"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line><line x1="11" y1="8" x2="11" y2="14"></line><line x1="8" y1="11" x2="14" y2="11"></line></svg>
                        Filter Pencarian
                    </a>
                    <a href="javascript:void(0)" class="btn btn-dark mb-2" id="btnBack" style="display: none">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                        Kembali
                    </a>
                    <div class="table-responsive" id="divTableMember">
                        <table id="Member" class="table mb-4" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID Anggota</th>
                                    <th>Tipe Anggota</th>
                                    <th>Nama</th>
                                    <th>Kota</th>
                                    <th>Status</th>
                                    <th>Tanggal Bergabung</th>
                                    <th>Edit</th>
                                    <th>Aktif Y/N</th>
                                </tr>
                            </thead>
                        </table>
                    </div>

                    <div id = "memberForm" style="display: none">

                        <ul class="nav nav-tabs mb-4 mt-3" id="iconTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="aDataMember" data-toggle="tab" href="#dataMember" role="tab" aria-controls="icon-home" aria-selected="true">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-check"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><polyline points="17 11 19 13 23 9"></polyline></svg>
                                Data Member</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="aSertifikasi" data-toggle="tab" href="#dataCertificate" role="tab" aria-controls="icon-contact" aria-selected="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layers"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
                                Sertifikasi</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="aPICKtp" data-toggle="tab" href="#picKTP" role="tab" aria-controls="icon-contact" aria-selected="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-image"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
                                KPT/SIM/Kartu Pelajar</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="aPICIjazah" data-toggle="tab" href="#picIjazah" role="tab" aria-controls="icon-contact" aria-selected="false">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                                Ijazah</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="iconTabContent-1">
                            <div class="tab-pane fade show active" id="dataMember" role="tabpanel" aria-labelledby="icon-home-tab">


                                <input type="hidden" id="tes1">

                                <form method="post" id="saveDataMember" enctype="multipart/form-data">
                                @csrf

                                <div class="row layout-top-spacing">
                                    <div class="col-lg-5 layout-spacing layout-spacing">

                                        <div class="form-row mb-6">
                                            <div class="form-group col-md-4">
                                                <label class="text-dark" for="txtPhoto">Foto Anggota</label>
                                                <input type="file" class="dropify" data-default-file="{{ asset('outside/assets/img/200x200.jpg') }}" 
                                                    data-max-file-size="5M" data-allowed-file-extensions="jpg jpeg png" id="txtPhoto" name="txtPhoto"
                                                />
                                            </div>
                                            <div class="form-group col-md-4">
                                                <br>
                                                <br>
                                                <span class="badge outline-badge-info"> Info </span>
                                                <p> </p>
                                                <p style="font-size: 10px"> Ukuran maksimal foto tidak boleh lebih dari 5MB. </p>
                                                <p style="font-size: 10px"> Ekstensi foto yang diperbolehkan (.jpg .jpeg .png). </p>
                                                <input type="hidden" id="UserPhotoSrc">
                                                <button class="btn btn-dark" id="LoadUserPhoto">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-image"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
                                                    Lihat Foto
                                                </button> 
                                            </div>
                                        </div>

                                        <div class="form-row mb-6">
                                            <div class="form-group col-md-10">
                                                <label class="text-dark" for="txtMemberID">ID Anggota</label>
                                                <input type="text" name="txtMemberID" id="txtMemberID" class="form-control" readonly>
                                            </div>
                                        </div>

                                        <div class="form-row mb-6">
                                            <div class="form-group col-md-10">
                                                <label class="text-dark" for="txtName">Nama Lengkap</label>
                                                <input type="text" name="txtName" id="txtName" class="form-control" placeholder="Contoh: Jhon Doe">
                                            </div>
                                        </div>

                                        <div class="form-row mb-6">
                                            <div class="form-group col-md-6">
                                                <label class="text-dark" for="txtNoIDCard">No. Identitas</label>
                                                <input type="text" name="txtNoIDCard" id="txtNoIDCard" class="form-control" placeholder="KTP/SIM/Kartu Pelajar">
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label class="text-dark" for="txtGender">Jenis Kelamin</label>
                                                <select class="form-control basic" name="txtGender" id="txtGender">
                                                    <option></option>
                                                    <option value="Laki - Laki">Laki - Laki</option>
                                                    <option value="Perempuan">Perempuan</option>
                                                </select>
                                            </div>
                                           
    
                                        </div>

                                        <div class="form-row mb-6">
                                            <div class="form-group col-md-10">
                                                <label class="text-dark" for="txtAddress">Alamat<span style="font-size: 10px; font-style: italic;"> (KTP)</span></label>
                                                <input type="text" name="txtAddress" id="txtAddress" class="form-control" placeholder="Nama jalan, nomor rumah, dll">
                                            </div>
                                        </div>

                                        <div class="form-row mb-6">
                                            <div class="form-group col-md-5">
                                                <label class="text-dark" for="txtProv">Provinsi<span style="font-size: 10px; font-style: italic;"> (KTP)</span></label>
                                                <input type="text" name="txtProvText" id="txtProvText" class="form-control" placeholder="Provinsi sesuai KTP">
                                                {{-- <input type="hidden" name="txtProvText" id="txtProvText">
                                                <div id="txtProv_loading">
                                                <select class="form-control basic" name="txtProv" id="txtProv">
                                                    <option></option>
                                                </select>
                                                </div> --}}
                                            </div>
                                            <div class="form-group col-md-5">
                                                <label class="text-dark" for="txtCity">Kota/Kab.<span style="font-size: 10px; font-style: italic;"> (KTP)</span></label>
                                                <input type="text" name="txtCity" id="txtCity" class="form-control" placeholder="Kota sesuai KTP">
                                                {{-- <div id="txtCity_loading">
                                                <select class="form-control basic" name="txtCity" id="txtCity">
                                                    <option></option>
                                                </select>
                                                </div> --}}
                                            </div>
                                        </div>

                                        <div class="form-row mb-6">
                                            <div class="form-group col-md-10">
                                                <label class="text-dark" for="txtAddressDom">Alamat<span style="font-size: 10px; font-style: italic;"> (Dom)</span></label>
                                                <input type="text" name="txtAddressDom" id="txtAddressDom" class="form-control" placeholder="Nama jalan, nomor rumah, dll">
                                            </div>
                                        </div>

                                        <div class="form-row mb-6">
                                            <div class="form-group col-md-5">
                                                <label class="text-dark" for="txtProvDom">Provinsi<span style="font-size: 10px; font-style: italic;"> (Dom)</span></label>
                                                <input type="text" name="txtProvDomText" id="txtProvDomText" class="form-control" placeholder="Provinsi sesuai domisili">
                                                {{-- <input type="hidden" name="txtProvDomText" id="txtProvDomText">
                                                <div id="txtProvDom_loading">
                                                <select class="form-control basic" name="txtProvDom" id="txtProvDom">
                                                    <option></option>
                                                </select>
                                                </div> --}}
                                            </div>
                                            <div class="form-group col-md-5">
                                                <label class="text-dark" for="txtCityDom">Kota/Kab.<span style="font-size: 10px; font-style: italic;"> (Dom)</span></label>
                                                <input type="text" name="txtCityDom" id="txtCityDom" class="form-control" placeholder="Kota sesuai domisili">
                                                {{-- <div id="txtCityDom_loading">
                                                <select class="form-control basic" name="txtCityDom" id="txtCityDom">
                                                    <option></option>
                                                </select>
                                                </div> --}}
                                            </div>
                                        </div>


                                       
                                    </div>


                                    <div class="col-lg-5 layout-spacing layout-spacing">
                                        <div class="form-row mb-6">
                                            <div class="form-group col-md-5">
                                                <label class="text-dark" for="txtBirthplace">Tempat Lahir</label>
                                                <input type="text" name="txtBirthplace" id="txtBirthplace" class="form-control">
                                            </div>

                                            <div class="form-group col-md-5">
                                                <label class="text-dark" for="txtDOB">Tanggal Lahir</label>
                                                <div class="input-group">
                                                    <input type="text" name="txtDOB" id="txtDOB" class="form-control">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-outline-success" id="resetDOB">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-refresh-cw"><polyline points="23 4 23 10 17 10"></polyline><polyline points="1 20 1 14 7 14"></polyline><path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path></svg>
                                                        </button>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>


                                        <div class="form-row mb-6">
                                            <div class="form-group col-md-10">
                                                <label class="text-dark" for="txtPhone">No. Telp</label>
                                                <input type="text" name="txtPhone" id="txtPhone" class="form-control only-numeric">
                                            </div>
                                        </div>

                                        <div class="form-row mb-6">
                                            <div class="form-group col-md-10">
                                                <label class="text-dark" for="txtEmail">Email</label>
                                                <input type="text" name="txtEmail" id="txtEmail" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-row mb-6">
                                            <div class="form-group col-md-10">
                                                <label class="text-dark" for="txtEducation">Pendidikan</label>
                                                <select class="form-control basic" name="txtEducation" id="txtEducation">
                                                    <option></option>
                                                    <option value="SD">SD</option>
                                                    <option value="SLTP">SLTP</option>
                                                    <option value="SLTA / SMK">SLTA / SMK</option>
                                                    <option value="S1">S1</option>
                                                    <option value="S2">S2</option>
                                                    <option value="S3">S3</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-row mb-6">
                                            <div class="form-group col-md-10">
                                                <label class="text-dark" for="txtJob">Pekerjaan</label>
                                                <input type="text" name="txtJob" id="txtJob" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-row mb-6">
                                            <div class="form-group col-md-10">
                                                <label class="text-dark" for="txtJabatan">Jabatan</label>
                                                <input type="text" name="txtJabatan" id="txtJabatan" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-row mb-6">
                                            <div class="form-group col-md-10">
                                                <label class="text-dark" for="txtStatMember">Status Anggota</label>
                                                <select class="form-control basic" name="txtStatMember" id="txtStatMember">
                                                    <option></option>
                                                    <option value="Anggota Penuh">Anggota Penuh</option>
                                                    <option value="Anggota Afiliasi">Anggota Afiliasi</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-row mb-6">
                                            <div class="form-group col-md-10">
                                                <label class="text-dark" for="txtIndustrial">Industrial</label>
                                                <input type="hidden" name="txtIndustrialName" id="txtIndustrialName">
                                                <select class="form-control basic" name="txtIndustrial" id="txtIndustrial">
                                                    <option></option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-row mb-6">

                                            <div class="form-group col-md-10">

                                                <div class="n-chk">
                                                    <label class="new-control new-checkbox checkbox-primary">
                                                    <input type="checkbox" name="txtStatKartu" id="txtStatKartu" class="new-control-input" value="st_kartu">
                                                    <span class="new-control-indicator text-dark"></span>Status Kartu
                                                    </label>
                                                </div>
            
                                                <div class="n-chk">
                                                    <label class="new-control new-checkbox checkbox-secondary">
                                                    <input type="checkbox" name="txtStatTrainee" id="txtStatTrainee" class="new-control-input" value="st_pelatihan">
                                                    <span class="new-control-indicator text-dark"></span>Sertifikat Pelatihan
                                                    </label>
                                                </div>
            
                                                <div class="n-chk">
                                                    <label class="new-control new-checkbox checkbox-success">
                                                    <input type="checkbox" name="txtStatCert" id="txtStatCert" class="new-control-input" value="st_bnsp">
                                                    <span class="new-control-indicator text-dark"></span>Sertifikat BNSP
                                                    </label>
                                                </div>
                                            </div>

                                        </div>
                                        
                                    </div>

                                </div>

                                <div class="form-row mb-6">

                                    <button class="btn btn-dark btn-block"  type="submit">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-save"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg>
                                        Simpan Data 
                                    </button> 

                                </div>
                                </form>

                            </div>
                            <div class="tab-pane fade" id="dataCertificate" role="tabpanel" aria-labelledby="icon-contact-tab">
                                
                                <form method="post" id="saveMemberCert" enctype="multipart/form-data">
                                @csrf

                                <div class="row layout-top-spacing">
                                    <div class="col-lg-5 layout-spacing layout-spacing">

                                        <div class="form-row mb-6">
                                            <div class="form-group col-md-10">
                                                <label class="text-dark" for="txtCertName">Nama Pelatihan/Sertifikasi</label>
                                                <input type="text" name="txtCertName" id="txtCertName" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-row mb-6">
                                            <div class="form-group col-md-8">
                                                <label class="text-dark" for="txtTrainingGround">Tempat Pelaksanaan</label>
                                                <input type="text" name="txtTrainingGround" id="txtTrainingGround" class="form-control">
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label class="text-dark" for="txtTrainingYear">Tahun</label>
                                                <input type="text" name="txtTrainingYear" id="txtTrainingYear" class="form-control only-numeric">
                                            </div>
                                        </div>

                                        <div class="form-row mb-6">
                                            <div class="form-group col-md-10">
                                                <label class="text-dark" for="txtOrganizer">Penyelenggara</label>
                                                <input type="text" name="txtOrganizer" id="txtOrganizer" class="form-control">
                                            </div>
                                        </div>

                                    </div>
                                
                                    <div class="col-lg-5 layout-spacing layout-spacing">

                                        <div class="form-row mb-6">
                                            <div class="form-group col-md-4">
                                                <input type="hidden" name="txtMemberIDTmp" id="txtMemberIDTmp">
                                                <input type="hidden" name="txtNumID" id="txtNumID">
                                                <input type="hidden" name="txtPicURL" id="txtPicURL">
                                                <input type="file" class="dropify" data-default-file="{{ asset('outside/assets/img/200x200.jpg') }}" 
                                                    data-max-file-size="5M" data-allowed-file-extensions="jpg jpeg png pdf doc docx" id="txtCert" name="txtCert"
                                                />
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label class="text-dark" for="txtCert">Bukti Sertifikasi/Pelatihan</label>
                                                <span class="badge outline-badge-info"> Info </span>
                                                <p> </p>
                                                <p style="font-size: 10px"> Ukuran maksimal file tidak boleh lebih dari 5MB. </p>
                                                <p style="font-size: 10px"> Ekstensi file yang diperbolehkan (.jpg .jpeg .png .pdf .doc .docx). </p>
                                            </div>
                                        </div>
                                        <div class="form-row mb-6">
                                            <button class="btn btn-dark btn-block"  type="submit">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-save"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg>
                                                Tambah Pelatihan/Sertifikasi 
                                            </button> 
                                        </div>   
                                    </div>
                                    
                                </div>
                                </form>

                                <hr class="style">

                                <div class="col-lg-12 layout-spacing layout-spacing">

                                    <h4>Daftar Pelatihan/Sertifikasi</h4>
                                    <div class="table-responsive">
                                        <table id="Cert" class="table mb-4" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>ID Anggota</th>
                                                    <th>Nomor</th>
                                                    <th>Nama Pelatihan/Sertifikasi</th>
                                                    <th>Tempat Pelaksanaan</th>
                                                    <th>Tahun</th>
                                                    <th>Penyelenggara</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>

                                </div>                                    


                            </div>
                            <div class="tab-pane fade" id="picKTP" role="tabpanel" aria-labelledby="icon-contact-tab">
                                <form method="post" id="saveKTP" enctype="multipart/form-data">
                                @csrf


                                <div class="form-row mb-6">
                                    <div class="form-group col-md-5">
                                        <label class="text-dark" for="txtKTP">File KTP</label>
                                        <input type="file" class="dropify" data-default-file="{{ asset('outside/assets/img/200x200.jpg') }}" 
                                            data-max-file-size="5M" data-allowed-file-extensions="jpg jpeg png pdf doc docx" id="txtKTP" name="txtKTP"
                                        />
                                    </div>
                                    <div class="form-group col-md-5">
                                        <br>
                                        <br>
                                        <span class="badge outline-badge-info"> Info </span>
                                        <p> </p>
                                        <p style="font-size: 10px"> Ukuran maksimal foto tidak boleh lebih dari 5MB. </p>
                                        <p style="font-size: 10px"> Ekstensi foto yang diperbolehkan (.jpg .jpeg .png .pdf .doc .docx). </p>
                                        <input type="hidden" name="txtMemberIDKTP" id="txtMemberIDKTP">
                                        <input type="hidden" id="FileKTPSrc">
                                        <button class="btn btn-dark" id="LoadKTP">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-image"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
                                            Lihat KTP
                                        </button> 
                                        <button class="btn btn-danger" id="HapusKTP">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                            Hapus KTP
                                        </button> 
                                    </div>
                                </div>
                                <div class="form-row mb-6">
                                    <button class="btn btn-dark btn-block"  type="submit">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-save"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg>
                                        Simpan KTP 
                                    </button> 
                                </div>   
                                </form>
                            </div>

                            <div class="tab-pane fade" id="picIjazah" role="tabpanel" aria-labelledby="icon-contact-tab">
                                <form method="post" id="saveIjazah" enctype="multipart/form-data">
                                @csrf

                                <div class="form-row mb-6">
                                    <div class="form-group col-md-5">
                                        <label class="text-dark" for="txtPhoto">File Ijazah</label>
                                        <input type="file" class="dropify" data-default-file="{{ asset('outside/assets/img/200x200.jpg') }}" 
                                            data-max-file-size="5M" data-allowed-file-extensions="jpg jpeg png pdf doc docx" id="txtIjazah" name="txtIjazah"
                                        />
                                    </div>
                                    <div class="form-group col-md-5">
                                        <br>
                                        <br>
                                        <span class="badge outline-badge-info"> Info </span>
                                        <p> </p>
                                        <p style="font-size: 10px"> Ukuran maksimal file tidak boleh lebih dari 5MB. </p>
                                        <p style="font-size: 10px"> Ekstensi foto yang diperbolehkan (.jpg .jpeg .png .doc .docx .pdf). </p>
                                        <input type="hidden" name="txtMemberIDIjazah" id="txtMemberIDIjazah">
                                        <input type="hidden" id="FileIjazahSrc">
                                        <button class="btn btn-dark" id="LoadIjazah">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                                            Lihat Ijazah
                                        </button> 
                                        <button class="btn btn-danger" id="HapusIjazah">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                            Hapus Ijazah
                                        </button> 
                                    </div>
                                </div>
                                <div class="form-row mb-6">
                                    <button class="btn btn-dark btn-block"  type="submit">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-save"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg>
                                        Simpan Ijazah 
                                    </button> 
                                </div> 
                                </form>
                            </div>
                        </div>

                    </div>



                </div>
            </div>
        </div>

    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="UserPhotoModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content" id="modalLoad">
            <div class="modal-header">
                <h4 class="modal-title">Foto Anggota</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <div class="modal-body">


                <div class="media" id="UserPhotoLoad">
                </div>

            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal">
                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="UserCertModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content" id="modalLoad">
            <div class="modal-header">
                <h4 class="modal-title">Edit Pelatihan/Sertifikasi</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <div class="modal-body">



                <form method="post" id="saveEditMemberCert" enctype="multipart/form-data">
                    @csrf

                    <div class="row layout-top-spacing">
                        <div class="col-lg-12 layout-spacing layout-spacing">

                            <div class="form-row mb-6">
                                <div class="form-group col-md-10">
                                    <label class="text-dark" for="txtCertNameEdit">Nama Pelatihan/Sertifikasi</label>
                                    <input type="text" name="txtCertNameEdit" id="txtCertNameEdit" class="form-control">
                                </div>
                            </div>

                            <div class="form-row mb-6">
                                <div class="form-group col-md-7">
                                    <label class="text-dark" for="txtTrainingGroundEdit">Tempat Pelaksanaan</label>
                                    <input type="text" name="txtTrainingGroundEdit" id="txtTrainingGroundEdit" class="form-control">
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="text-dark" for="txtTrainingYearEdit">Tahun</label>
                                    <input type="text" name="txtTrainingYearEdit" id="txtTrainingYearEdit" class="form-control only-numeric">
                                </div>
                            </div>

                            <div class="form-row mb-6">
                                <div class="form-group col-md-10">
                                    <label class="text-dark" for="txtOrganizerEdit">Penyelenggara</label>
                                    <input type="text" name="txtOrganizerEdit" id="txtOrganizerEdit" class="form-control">
                                </div>
                            </div>

                            <div class="form-row mb-6">
                                <div class="form-group col-md-5">
                                    <input type="hidden" name="txtMemberIDTmpEdit" id="txtMemberIDTmpEdit">
                                    <input type="hidden" name="txtNumIDEdit" id="txtNumIDEdit">
                                    <input type="hidden" name="txtPicURLEdit" id="txtPicURLEdit">
                                    <input type="file" class="dropify" data-default-file="{{ asset('outside/assets/img/200x200.jpg') }}" 
                                        data-max-file-size="5M" data-allowed-file-extensions="jpg jpeg png pdf doc docx" id="txtCertEdit" name="txtCertEdit"
                                    />
                                </div>
                                <div class="form-group col-md-5">
                                    <label class="text-dark" for="txtCert">Bukti Sertifikasi/Pelatihan</label>
                                    <span class="badge outline-badge-info"> Info </span>
                                    <p style="font-size: 10px"> Jika tidak ada perubahan, biarkan saja</p>
                                    <p style="font-size: 10px"> Ukuran maksimal file tidak boleh lebih dari 5MB. </p>
                                    <p style="font-size: 10px"> Ekstensi file yang diperbolehkan (.jpg .jpeg .png .pdf .doc .docx). </p>
                                    <button class="btn btn-dark" id="LoadCertFile">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                                        Lihat File
                                    </button> 
                                </div>
                            </div>
                            <div class="form-row mb-6">
                                <button class="btn btn-dark btn-block"  type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-save"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg>
                                    Perbaharui Data 
                                </button> 
                            </div>   
                        </div>
                        
                    </div>
                    </form>



            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal">
                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="CertPhotoModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content" id="modalLoad">
            <div class="modal-header">
                <h4 class="modal-title">Foto Sertifikasi</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <div class="modal-body">


                <div class="media" id="CertPhotoLoad">
                </div>

            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal">
                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="SearchModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content" id="modalLoad">
            <div class="modal-header">
                <h4 class="modal-title">Filter Pencarian</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <div class="modal-body">


                <div class="row layout-top-spacing">
                    <div class="col-lg-12 layout-spacing layout-spacing">


                        <div class="form-row mb-6">
                            <div class="form-group col-md-6">
                                <label class="text-dark" for="qTipeAnggota">Tipe Anggota</label>
                                <div id="qTipeAnggotaLoading">
                                    <select class="form-control basic" name="qTipeAnggota" id="qTipeAnggota">
                                        <option></option>
                                        <option value="Anggota Penuh">Anggota Penuh</option>
                                        <option value="Anggota Afiliasi">Anggota Afiliasi</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="text-dark" for="qKota">Kota</label>
                                <div id="qKotaLoading">
                                    <select class="form-control basic" name="qKota" id="qKota">
                                        <option></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    

                        <div class="form-row mb-6">
                            <div class="form-group col-md-6">
                                <label class="text-dark" for="qMemberID">ID Anggota</label>
                                <input type="text" name="qMemberID" id="qMemberID" class="form-control" placeholder="Cari ID Anggota">
                            </div>
                     
                            <div class="form-group col-md-6">
                                <label class="text-dark" for="qNama">Nama Anggota</label>
                                <input type="text" name="qNama" id="qNama" class="form-control" placeholder="Cari Nama Anggota">
                            </div>
                        </div>


                        <div class="form-row mb-6">
                            <div class="form-group col-md-6">
                                <label class="text-dark" for="qStartDate">Dari Tanggal</label>
                                <span class="badge badge-info">Tanggal Bergabung</span>
                                <div class="input-group">
                                    <input type="text" name="qStartDate" id="qStartDate" class="form-control">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-success" id="resetStartDate">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-refresh-cw"><polyline points="23 4 23 10 17 10"></polyline><polyline points="1 20 1 14 7 14"></polyline><path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path></svg>
                                        </button>
                                    </div>
                                </div> 
                            </div>

                            <div class="form-group col-md-6">
                                <label class="text-dark" for="qEndDate">Sampai Tanggal</label>
                                <span class="badge badge-info">Tanggal Bergabung</span>
                                <div class="input-group">
                                    <input type="text" name="qEndDate" id="qEndDate" class="form-control">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-success" id="resetEndDate">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-refresh-cw"><polyline points="23 4 23 10 17 10"></polyline><polyline points="1 20 1 14 7 14"></polyline><path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path></svg>
                                        </button>
                                    </div>
                                </div>
                                
                            </div>
                        </div>

                    </div>
                    
                </div>


                

            </div>
            <div class="modal-footer">


                <button class="btn btn-success mb2" id="resetSearch">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-rotate-ccw"><polyline points="1 4 1 10 7 10"></polyline><path d="M3.51 15a9 9 0 1 0 2.13-9.36L1 10"></path></svg>
                Reset</button>

                <button class="btn btn-dark mb2" id="startSearch">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-zoom-in"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line><line x1="11" y1="8" x2="11" y2="14"></line><line x1="8" y1="11" x2="14" y2="11"></line></svg>
                Cari</button>


                {{-- <button class="btn" data-dismiss="modal">
                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                Close</button> --}}
            </div>
        </div>
    </div>
</div>


@endsection
{{-- Content Page End--}}

{{-- Content Page JS Begin--}}
@section('contentjs')

<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.4/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('outside/plugins/notification/snackbar/snackbar.min.js') }}"></script>
<script src="{{ asset('outside/plugins/blockui/jquery.blockUI.min.js') }}"></script>
<script src="{{ asset('outside/plugins/select2/select2.min.js') }}"></script>
<script src="{{ asset('outside/plugins/flatpickr/flatpickr.js') }}"></script>
<script src="{{ asset('outside/plugins/dropify/dropify.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js" integrity="sha512-lOtDAY9KMT1WH9Fx6JSuZLHxjC8wmIBxsNFL6gJPaG7sLIVoSO9yCraWOwqLLX+txsOw0h2cHvcUJlJPvMlotw==" crossorigin="anonymous"></script>
<script src="{{ asset('outside/plugins/input-mask/jquery.inputmask.bundle.min.js') }}"></script>
<script>


var setId, f1, f2, f3;

var qTipeAnggota, qKota, qMemberID, qNama, qStartDate, qEndDate;

function blockUI(){

    $.blockUI({
        message: '<span class="text-semibold"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-loader spin position-left"><line x1="12" y1="2" x2="12" y2="6"></line><line x1="12" y1="18" x2="12" y2="22"></line><line x1="4.93" y1="4.93" x2="7.76" y2="7.76"></line><line x1="16.24" y1="16.24" x2="19.07" y2="19.07"></line><line x1="2" y1="12" x2="6" y2="12"></line><line x1="18" y1="12" x2="22" y2="12"></line><line x1="4.93" y1="19.07" x2="7.76" y2="16.24"></line><line x1="16.24" y1="7.76" x2="19.07" y2="4.93"></line></svg></i>&nbsp; Loading</span>',
        fadeIn: 100,
        overlayCSS: {
            backgroundColor: '#1b2024',
            opacity: 0.8,
            zIndex: 1200,
            cursor: 'wait'
        },
        css: {
            border: 0,
            color: '#fff',
            zIndex: 1201,
            padding: 0,
            backgroundColor: 'transparent'
        }
    });
}

function blockModal(block){

    $(block).block({
        centerY: false,
        centerX: false,
        message: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-loader spin"><line x1="12" y1="2" x2="12" y2="6"></line><line x1="12" y1="18" x2="12" y2="22"></line><line x1="4.93" y1="4.93" x2="7.76" y2="7.76"></line><line x1="16.24" y1="16.24" x2="19.07" y2="19.07"></line><line x1="2" y1="12" x2="6" y2="12"></line><line x1="18" y1="12" x2="22" y2="12"></line><line x1="4.93" y1="19.07" x2="7.76" y2="16.24"></line><line x1="16.24" y1="7.76" x2="19.07" y2="4.93"></line></svg>',
        overlayCSS: {
            backgroundColor: '#000',
            opacity: 0.8,
            cursor: 'wait'
        },
        css: {
            border: 0,
            color: '#fff',
            padding: '40px 15px',
            backgroundColor: 'transparent'
        }
    });
}

function blockElement(block){

    $(block).block({
        message: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-loader spin"><line x1="12" y1="2" x2="12" y2="6"></line><line x1="12" y1="18" x2="12" y2="22"></line><line x1="4.93" y1="4.93" x2="7.76" y2="7.76"></line><line x1="16.24" y1="16.24" x2="19.07" y2="19.07"></line><line x1="2" y1="12" x2="6" y2="12"></line><line x1="18" y1="12" x2="22" y2="12"></line><line x1="4.93" y1="19.07" x2="7.76" y2="16.24"></line><line x1="16.24" y1="7.76" x2="19.07" y2="4.93"></line></svg>',
        centerX: 0,
        centerY: 0,
        overlayCSS: {
            backgroundColor: '#fff',
            opacity: 0.8,
            cursor: 'wait'
        },
        css: {
            width: 35,
            top: '10px',
            left: '',
            right: '10px',
            bottom: 0,
            border: 0,
            padding: 0,
            backgroundColor: 'transparent'
        }
    });

}

function listGender(){

    $('#txtGender').select2({
        placeholder: 'Pilih Jenis Kelamin',
        allowClear: true
    });

}

function listEducation(){

    $('#txtEducation').select2({
        placeholder: 'Pilih Pendidikan',
        allowClear: true
    });

}

function listStatMember(){

    $('#txtStatMember').select2({
        placeholder: 'Pilih Status Keanggotaan',
        allowClear: true
    });

}

function listIndustrial(){

    $.ajax({
        type: "GET",
        url: "{{ url('listIndustrial') }}",
        success: function(data) {

            count = Object.keys(data).length;

            if (count < 2) {

                $('select[name="txtIndustrial"]').empty();
                $('select[name="txtIndustrial"]').prepend('<option></option>');
                $.each(data, function(index, element) {
                    $('select[name="txtIndustrial"]').append('<option value="'+element.position_id+'" selected>'+element.position+'</option>');
                });
                $('#txtIndustrial').prop('disabled', true);

            }

            else {
                
                $('select[name="txtIndustrial"]').empty();
                $('select[name="txtIndustrial"]').prepend('<option></option>');
                $.each(data, function(index, element) {
                    $('select[name="txtIndustrial"]').append('<option value="'+element.position_id+'">'+element.position+'</option>');
                });
                $('#txtIndustrial').prop('disabled', false);
            }
        }
    });


    $('#txtIndustrial').select2({
        placeholder: 'Pilih Industrial',
        allowClear: true
    });


}

function getMemberID(){

    $.ajax({
        type: "GET",
        url: "{{ url('getMemberID') }}",
        success: function(data) {

            var id = data['member_id']
            var today = new Date();
            var mm = String(today.getMonth() + 1).padStart(2, '0');
            var yyyy = today.getFullYear();
            var date = yyyy+mm;
            latest_id = date + id;

            $('#txtMemberID').val(latest_id);
            $('#txtMemberIDTmp').val(latest_id); 
            $('#txtMemberIDKTP').val(latest_id);  
            $('#txtMemberIDIjazah').val(latest_id);        
        }
    });


}

function setEmpty1() {

    $('#txtName').val('');
    $('#txtNoIDCard').val('');
    $('#txtAddress').val('');
    $('#txtProvText').val(null).trigger('change');
    $('#txtCity').val(null).trigger('change');
    $('#txtAddressDom').val(null).trigger('change');
    $('#txtProvDomText').val(null).trigger('change');
    $('#txtCityDom').val(null).trigger('change');
    $('#txtGender').val(null).trigger('change');
    $('#txtBirthplace').val('');
    f1.clear();
    $('#txtPhone').val('');
    $('#txtEmail').val('');
    $('#txtEducation').val(null).trigger('change');
    $('#txtJob').val('');
    $('#txtJabatan').val('');
    $('#txtStatMember').val(null).trigger('change');
    $('#txtIndustrial').val(null).trigger('change');

    if($('#txtStatKartu').is(':checked')){
            $('#txtStatKartu').attr('checked', false);
        }
        else{
            $('#txtStatKartu').attr('checked', false);
        }

    if($('#txtStatTrainee').is(':checked')){
            $('#txtStatTrainee').attr('checked', false);
        }else{
            $('#txtStatTrainee').attr('checked', false);
    }

    if($('#txtStatCert').is(':checked')){
            $('#txtStatCert').attr('checked', false);
        }else{
            $('#txtStatCert').attr('checked', false);
    }

    var drEvent = $('#txtPhoto').dropify();
    drEvent = drEvent.data('dropify');
    drEvent.resetPreview();
    drEvent.clearElement();
    drEvent.settings.defaultFile = "{{ asset('outside/assets/img/200x200.jpg') }}";
    drEvent.destroy();
    drEvent.init();
    $('.dropify#txtPhoto').dropify({
    defaultFile: "{{ asset('outside/assets/img/200x200.jpg') }}",
    });
}

function setEmpty2() {

    $('#txtCertName').val('');
    $('#txtTrainingYear').val('');
    $('#txtTrainingGround').val('');
    $('#txtOrganizer').val('');

}

function listqTipeAnggota(){

    $('#qTipeAnggota').select2({
        placeholder: 'Pilih Tipe Keanggotaan',
        allowClear: true,
        dropdownParent: $('#SearchModal')
    });

}

function listqKota(){

    var block = $('#qKotaLoading');
    blockElement(block);
    $.ajax({
        type: "GET",
        dataType: "json",
        url: "{{url('listqKota')}}",
        success: function (data) {
            $(block).unblock()
            $('select[name="qKota"]').empty();
            $('select[name="qKota"]').prepend('<option></option>');
            
            $.each(data, function(index, element) {
                $('select[name="qKota"]').append('<option value="'+element.city+'">'+element.city+'</option>');
            });
        }
    });
    $('#qKota').select2({
        placeholder: 'Pilih Kota',
        allowClear: true,
        dropdownParent: $('#SearchModal')
    });

}

function listMemberTable() {

    qTipeAnggota = $('#qTipeAnggota').val();
    qKota = $('#qKota').val();
    qMemberID = $('#qMemberID').val();
    qNama = $('#qNama').val();
    qStartDate = $('#qStartDate').val();
    qEndDate =$('#qEndDate').val();

    blockUI();

    var dataTable = $('#Member').DataTable({
        "oLanguage": {
            "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
            "sInfo": "Showing page _PAGE_ of _PAGES_",
            "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
            "sSearchPlaceholder": "Search",
            "sLengthMenu": "Show :  _MENU_ entries",
            },
        order: [ [0, 'desc'] ],
        stripeClasses: [],
        lengthMenu: [5, 10, 20, 50],
        pageLength: 10,
        destroy : true,
        responsive: true,
        processing: true,
        serverSide: true,
        autoWidth: false,
        ajax: {
            'url':'{!!url("listMember")!!}',
            'type': 'post',
            data: {
                    '_token': '{{ csrf_token() }}',
                    'qTipeAnggota' : qTipeAnggota,
                    'qKota' : qKota,
                    'qMemberID' : qMemberID,
                    'qNama' : qNama,
                    'qStartDate' : qStartDate,
                    'qEndDate' : qEndDate
                }
        },
        columns: [
            {data: 'member_id', name: 'member_id'},
            {data: 'st_anggota', name: 'st_anggota'},
            {data: 'member_name', name: 'member_name'},
            {data: 'city', name: 'city'},
            {data: 'active_flag', name: 'active_flag'},
            {data: 'dt_created', name: 'dt_created'},
            {data: 'Detail', name: 'Detail',orderable:false,searchable:false},
            {data: 'activate', name: 'activate',orderable:false,searchable:false}
        ],
        initComplete: function(settings, json) {

            if (!dataTable.rows().data().length) {

                $.unblockUI();

                swal("Whops", "Data not available", "error");
            }

            else {

                $.unblockUI();
            }
        },
    });
}

$(document).ready(function() {

    $('#homeNav').attr('data-active','false');
    $('#homeNav').attr('aria-expanded','false');
    $('#MemberMgtNav').attr('data-active','true');
    $('#MemberMgtNav').attr('aria-expanded','true');
    $('.MemberMgtTreeView').addClass('show');
    $('#MemberMgtSub').addClass('active');

    $('.basic').on('select2:open', function() {
        if (Modernizr.touch) {
            $('.select2-search__field').prop('focus', false);
        }
    });

    var block = $('#modalLoad');

    // listProv(); listProvDom(); listCity(); listCityDom(); 
    listGender(); listEducation(); listStatMember(); listIndustrial();

    f1 = flatpickr(document.getElementById('txtDOB'), {
        altInput: true,
        altFormat: "d-m-Y",
        dateFormat: "Y-m-d",
        disableMobile: "true",
    });


    f2 = flatpickr(document.getElementById('qStartDate'), {
        altInput: true,
        altFormat: "d M Y",
        dateFormat: "Y-m-d",
        disableMobile: "true",
    });


    f3 = flatpickr(document.getElementById('qEndDate'), {
        altInput: true,
        altFormat: "d M Y",
        dateFormat: "Y-m-d",
        disableMobile: "true",
    });

    var btnAddMember = document.getElementById("btnAddMember");
    var btnBack = document.getElementById("btnBack");
    var divTableMember = document.getElementById("divTableMember");
    var memberForm = document.getElementById("memberForm");
    var LoadCertFile = document.getElementById("LoadCertFile");

    var html1 = 'Daftar Anggota';
    var html2 = 'Tambah Anggota';
    var html3 = 'Edit Anggota';

    $('#DocTitle').text(html1);

    listMemberTable();
    listqTipeAnggota();
    listqKota();

    $('#btnAddMember').on('click', function() {

        setEmpty1();
        getMemberID();

        $("#btnBack").show();
        $("#btnAddMember").hide();
        $("#btnFilter").hide();
        divTableMember.style.display = "none";
        memberForm.style.display = "block";
        $('#DocTitle').text(html2);

        $('#aSertifikasi').removeClass('disabled');
        $('#aPICKtp').removeClass('disabled');
        $('#aPICIjazah').removeClass('disabled');

        $('#aSertifikasi').addClass('disabled');
        $('#aPICKtp').addClass('disabled');
        $('#aPICIjazah').addClass('disabled');

    });

    $('#btnBack').on('click', function() {

        $("#btnBack").hide();
        $("#btnAddMember").show();
        $("#btnFilter").show();
        divTableMember.style.display = "block";
        memberForm.style.display = "none";
        $('#DocTitle').text(html1);
        listMemberTable();

    });

    $('#txtProv').change(function(){
        
        var id = $("#txtProv").val();
        var block = $('#txtCity_loading');
        blockElement(block);

        if (id) {

            $.ajax({
              url: 'https://x.rajaapi.com/MeP7c5ne' + window.return_first + '/m/wilayah/kabupaten',
              data: "idpropinsi=" +id,
              type: 'GET',
              cache: false,
              dataType: 'json',
              success: function(json) {
                if (json.code == 200) {
                    
                    $(block).unblock();
                    $('select[name="txtCity"]').empty();
                    $('select[name="txtCity"]').prepend('<option></option>');
                        for (i = 0; i < Object.keys(json.data).length; i++) {
                            $('#txtCity').append($('<option>').text(json.data[i].name).attr('value', json.data[i].nama));
                        }

                    $('#txtCity').select2({
                        placeholder: 'Pilih Kota/Kab.',
                        allowClear: true
                    });
                }
              }
          });

        }
        else {
            $(block).unblock();
            $('select[name="txtCity"]').empty();
            $('select[name="txtCity"]').prepend('<option></option>');
            listCity();
        }
 
    });

    $('#LoadUserPhoto').on('click', function() {

        event.preventDefault();
        var txtImgSrc;
        var txtImgSrc = $('#UserPhotoSrc').val();
        if (txtImgSrc) {

            txtImgSrc = txtImgSrc+'?'+new Date().getTime();
            // alert(txtImgSrc)
            $("#UserPhotoModal").modal();
            document.getElementById("UserPhotoLoad").innerHTML = '<img  class="rounded" src="' +txtImgSrc+'">'

        }

        else {
            swal("Whops", "Foto tidak tersedia, silahkan simpan data member dahulu", "error")
        }
       

    

    });

    $('#txtProvDom').change(function(){
        var id = $("#txtProvDom").val();
        var block = $('#txtCityDom_loading');
        blockElement(block);

        if (id) {

            $.ajax({
              url: 'https://x.rajaapi.com/MeP7c5ne' + window.return_first + '/m/wilayah/kabupaten',
              data: "idpropinsi=" +id,
              type: 'GET',
              cache: false,
              dataType: 'json',
              success: function(json) {
                if (json.code == 200) {
                    
                    $(block).unblock();
                    $('select[name="txtCityDom"]').empty();
                    $('select[name="txtCityDom"]').prepend('<option></option>');
                        for (i = 0; i < Object.keys(json.data).length; i++) {
                            $('#txtCityDom').append($('<option>').text(json.data[i].name).attr('value', json.data[i].nama));
                        }

                    $('#txtCityDom').select2({
                        placeholder: 'Pilih Kota/Kab.',
                        allowClear: true
                    });
                }
              }
          });

        }
        else {
            $(block).unblock();
            $('select[name="txtCityDom"]').empty();
            $('select[name="txtCityDom"]').prepend('<option></option>');
            listCity();
        }
 
    });

    $('#resetDOB').on('click', function() {

        f1.clear();

    });

    $('.dropify').dropify({
      messages: { 
            'default': 'Click to Upload or Drag n Drop', 
            'remove':  '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>', 
            'replace': 'Upload or Drag n Drop' 
        }
    });

    $("#txtEmail").inputmask(
        {
            mask:"*{1,20}[.*{1,20}][.*{1,20}][.*{1,20}]@*{1,20}[.*{2,6}][.*{1,2}]",
            greedy:!1,onBeforePaste:function(m,a){return(m=m.toLowerCase()).replace("mailto:","")},
            definitions:{"*":
                {
                    validator:"[0-9A-Za-z!#$%&'*+/=?^_`{|}~-]",
                    cardinality:1,
                    casing:"lower"
                }
            }
        }
    )

    $('#txtIndustrial').on('change', function() {
        
        var e = document.getElementById("txtIndustrial");
        var txtIndustrialName = e.options[e.selectedIndex].text;
        $('#txtIndustrialName').val(txtIndustrialName);
    });

    $(".only-numeric").bind("keypress", function (e) {
        var keyCode = e.which ? e.which : e.keyCode

        if (!(keyCode >= 48 && keyCode <= 57)) {
            swal('Whops', 'Inputan hanya boleh angka(numeric)', 'error');
            return false;
        }
    });

    $('#saveDataMember').on('submit', function(event){
        
        event.preventDefault();

        var txtMemberID = $('#txtMemberID').val();
        setId = txtMemberID;
        var txtNoIDCard = $('#txtNoIDCard').val();
        var txtName = $('#txtName').val();
        var txtAddress = $('#txtAddress').val();
        var txtProv = $('#txtProvText').val();
        var txtCity = $('#txtCity').val();
        var txtAddressDom = $('#txtAddressDom').val();
        var txtProvDom = $('#txtProvDomText').val();
        var txtCityDom = $('#txtCityDom').val();
        var txtGender = $('#txtGender').val();

        if (!txtNoIDCard) {
            swal("Whoops", "No.Identitas harus diisi", "error")
        }
        if (!txtName) {
            swal("Whoops", "Nama Lengkap harus diisi", "error")
        }
        // if (!txtAddress) {
        //     swal("Whoops", "Alamat KTP harus diisi", "error")
        // }
        // if (!txtProv) {
        //     swal("Whoops", "Provinsi KTP harus diisi", "error")
        // }
        // if (!txtCity) {
        //     swal("Whoops", "Kota KTP harus diisi", "error")
        // }
        // if (!txtAddressDom) {
        //     swal("Whoops", "Alamat Domisili harus diisi", "error")
        // }
        // if (!txtProvDom) {
        //     swal("Whoops", "Provinsi Domisili harus diisi", "error")
        // }
        // if (!txtCityDom) {
        //     swal("Whoops", "Kota Domisili harus diisi", "error")
        // }
        // if (!txtGender) {
        //     swal("Whoops", "Jenis Kelamin harus diisi", "error")
        // }

        // if (txtNoIDCard && txtName && txtAddress && txtProv && txtCity && txtAddressDom && txtProvDom && txtCityDom && txtGender){
        if (txtNoIDCard && txtName){

            // var a = document.getElementById("txtProv");
            // var txtProv = a.options[a.selectedIndex].text;
            // $('#txtProvText').val(txtProv);

            // var b = document.getElementById("txtProvDom");
            // var txtProvDom = b.options[b.selectedIndex].text;
            // $('#txtProvDomText').val(txtProvDom);

            $.ajax({
                url: "{{ url('saveDataMember') }}",
                method:"POST",
                data:new FormData(this),
                dataType:'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success:function(data){

                    if ((data['response']) == "Data sukses disimpan") {
                        swal("Sukses", (data['response']), "success")
                            .then(function(){
                                swal("Info", "Sekarang anda bisa upload file Sertifikasi/Pelatihan, KTP/SIM/Kartu Pelajar, Ijazah untuk ID Anggota "+txtMemberID, "info")
                            }
                        );

                        $('#Cert').DataTable().ajax.url("{{url('listCert?id=')}}"+setId).load();

                        $('#aSertifikasi').removeClass('disabled');
                        $('#aPICKtp').removeClass('disabled');
                        $('#aPICIjazah').removeClass('disabled');

                        var txtImgSrc = data['img'];

                        $('#UserPhotoSrc').val(txtImgSrc);

                                
                    }

                    else if ((data['response']) == "Data sukses diperbaharui") {

                        swal("Sukses", (data['response']), "success");

                        $('#Cert').DataTable().ajax.url("{{url('listCert?id=')}}"+setId).load();

                        $('#aSertifikasi').removeClass('disabled');
                        $('#aPICKtp').removeClass('disabled');
                        $('#aPICIjazah').removeClass('disabled');

                        var txtImgSrc = data['img'];

                        $('#UserPhotoSrc').val(txtImgSrc);


                    }
                    else {
                        swal("Whops", (data['response']), "error");
                    }
            
                }
         })

        }
        
    });

    var dataTable2 = $('#Cert').DataTable({
        "oLanguage": {
            "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
            "sInfo": "Showing page _PAGE_ of _PAGES_",
            "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
            "sSearchPlaceholder": "Search",
            "sLengthMenu": "Show :  _MENU_ entries",
            },
        order: [ [1, 'ascr'] ],
        stripeClasses: [],
        lengthMenu: [5, 10, 20, 50],
        pageLength: 10,
        destroy : true,
        responsive: true,
        processing: true,
        serverSide: true,
        autoWidth: false,
        ajax: {
            'url':'{!!url("listCert")!!}' + '?id=' +setId,
            'type': 'post',
            'headers': {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        },
        columns: [
            {data: 'member_id', name: 'member_id'},
            {data: 'num_id', name: 'num_id'},
            {data: 'training_type', name: 'training_type'},
            {data: 'training_ground', name: 'training_ground'},
            {data: 'year', name: 'year'},
            {data: 'organizer', name: 'organizer'},
            {data: 'Detail', name: 'Detail',orderable:false,searchable:false}
        ],
        initComplete: function(settings, json) {

            if (!dataTable2.rows().data().length) {

                // swal("Whops", "Data not available", "error");
            }
        },
    });

    $('#saveMemberCert').on('submit', function(event){
        
        event.preventDefault();

        var txtCertName = $('#txtCertName').val();
        var txtTrainingGround = $('#txtTrainingGround').val();
        var txtTrainingYear = $('#txtTrainingYear').val();
        var txtOrganizer = $('#txtOrganizer').val();
        var txtCert = $('#txtCert').val();
        
        if (!txtCertName) {
            swal("Whoops", "Nama Pelatihan/Sertifikasi harus diisi", "error")
        }
        if (!txtTrainingGround) {
            swal("Whoops", "Tempat pelaksanaan harus diisi", "error")
        }
        if (!txtTrainingYear) {
            swal("Whoops", "Tahun Pelatihan/Sertifikasi harus diisi", "error")
        }
        if (!txtOrganizer) {
            swal("Whoops", "Penyelenggara harus diisi", "error")
        }
        if (!txtCert) {
            swal("Whoops", "Bukti Pelatihan/Sertifikasi harus diikut sertakan", "error")
        }

        if (txtCertName && txtTrainingGround && txtTrainingYear && txtOrganizer && txtCert){

            $.ajax({
                url: "{{ url('saveMemberCert') }}",
                method:"POST",
                data:new FormData(this),
                dataType:'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success:function(data){

                    if ((data['response']) == "Data tersimpan") {

                        swal("Sukses", (data['response']), "success");
                        $('#Cert').DataTable().ajax.url("{{url('listCert?id=')}}"+setId).load();
                        setEmpty2();

                        var drEvent = $('#txtCert').dropify();
                        drEvent = drEvent.data('dropify');
                        drEvent.resetPreview();
                        drEvent.clearElement();
                        drEvent.settings.defaultFile = "{{ asset('outside/assets/img/200x200.jpg') }}";
                        drEvent.destroy();
                        drEvent.init();
                        $('.dropify#txtCert').dropify({
                        defaultFile: "{{ asset('outside/assets/img/200x200.jpg') }}",
                        });

                    }
                    else {
                        swal("Whops", (data['response']), "error");
                    }
            
                }
         })

        }
        
    });

    $('body').on('click', '.editCert', function(e) {

        var txtMemberID = $(this).data('id1');
        var txtNumID = $(this).data('id2');

        $("#UserCertModal").modal();
        blockModal(block);

        $.ajax({
            type: "POST",
            url: "{{ url('editCert') }}",
            data: {
                '_token': '{{ csrf_token() }}',
                'txtMemberID': txtMemberID,
                'txtNumID': txtNumID
            },
            success: function(data) {

                if (data.length > 0) {

                    $.each(data, function(index, element) {

                        $('#txtMemberIDTmpEdit').val(element.member_id);
                        $('#txtCertNameEdit').val(element.training_type);
                        $('#txtTrainingGroundEdit').val(element.training_ground);
                        $('#txtTrainingYearEdit').val(element.year);
                        $('#txtOrganizerEdit').val(element.organizer);
                        $('#txtNumIDEdit').val(element.num_id)
                        $('#txtPicURLEdit').val(element.pic_url)
                        
                        var drEvent = $('#txtCertEdit').dropify();
                        drEvent = drEvent.data('dropify');
                        drEvent.resetPreview();
                        drEvent.clearElement();
                        drEvent.settings.defaultFile = element.pic_url;
                        drEvent.destroy();
                        drEvent.init();
                        $('.dropify#txtCertEdit').dropify({
                        defaultFile: element.pic_url,
                        });;
                    });    

                $(block).unblock();   


                }

                else {

                    swal("Whops", "Terjadi kesalahan", "error");

                    $(block).unblock();

                }
            }
        });




    });

    $('body').on('click', '.delCert', function(e) {

        var txtMemberID = $(this).data('id1');
        var txtNumID = $(this).data('id2');


        swal({
            title: 'Apakah anda yakin?',
            text: "Data yang dihapus tidak bisa dikembalikan",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Hapus',
            padding: '2em'
            }).then(function(result) {
                
                if (result.value) {
                    
                    $.ajax({
                        type: "POST",
                        url: "{{ url('deleteCert') }}",
                        data: {
                            '_token': '{{ csrf_token() }}',
                            'txtMemberID': txtMemberID,
                            'txtNumID': txtNumID
                        },
                        success: function(data) {

                            if ((data['response']) == "Data berhasil dihapus") {
                                    swal("Sukses", (data['response']), "success");
                                
                                    $('#Cert').DataTable().ajax.url("{{url('listCert?id=')}}"+setId).load();
                                            
                                }
                                else {
                                    swal("Whops", (data['response']), "error");
                                }

                        
                        }
                    });

                }
            });

        




    });

    $('#LoadCertFile').on('click', function() {

        event.preventDefault();
        var txtFileSrc;
        var txtFileSrc = $('#txtPicURLEdit').val();

        window.open(txtFileSrc, '_blank'); 

        // swal("Info", "File akan otomatis terunduh, klik Ok untuk melanjutkan", "info")
        //     .then(function(){
        //         document.location.href = txtFileSrc; 
        //     }
        // );

        // var fileExt = txtFileSrc.split('.').pop();
        // if (fileExt == "doc" || fileExt == "docx" || fileExt == "pdf") {
        //     document.location.href = txtFileSrc; 
        // }
        // else {

        //     txtFileSrc = txtFileSrc+'?'+new Date().getTime();
        //     $("#CertPhotoModal").modal();
        //     document.getElementById("CertPhotoLoad").innerHTML = '<img  class="rounded" src="' +txtFileSrc+'">'

        // }

    });

    $('#saveEditMemberCert').on('submit', function(event){
        
        event.preventDefault();

        var txtCertName = $('#txtCertNameEdit').val();
        var txtTrainingGround = $('#txtTrainingGroundEdit').val();
        var txtTrainingYear = $('#txtTrainingYearEdit').val();
        var txtOrganizer = $('#txtOrganizerEdit').val();
        var txtCert = $('#txtCertEdit').val();

        // alert(txtCert)
        
        if (!txtCertName) {
            swal("Whoops", "Nama Pelatihan/Sertifikasi harus diisi", "error")
        }
        if (!txtTrainingGround) {
            swal("Whoops", "Tempat pelaksanaan harus diisi", "error")
        }
        if (!txtTrainingYear) {
            swal("Whoops", "Tahun Pelatihan/Sertifikasi harus diisi", "error")
        }
        if (!txtOrganizer) {
            swal("Whoops", "Penyelenggara harus diisi", "error")
        }

        if (txtCertName && txtTrainingGround && txtTrainingYear && txtOrganizer){

            $.ajax({
                url: "{{ url('saveEditMemberCert') }}",
                method:"POST",
                data:new FormData(this),
                dataType:'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success:function(data){

                    if ((data['response']) == "Data berhasil diperbarui") {
                        swal("Sukses", (data['response']), "success");
                        $("#UserCertModal").modal('hide')
                        $('#Cert').DataTable().ajax.url("{{url('listCert?id=')}}"+setId).load();

                    }
                    else {
                        swal("Whops", (data['response']), "error");
                    }
            
                }
            })

        }
        
    });

    $('#saveKTP').on('submit', function(event){
        
        event.preventDefault();

        var txtKTP = $('#txtKTP').val();
        
        if (!txtKTP) {
            swal("Whops", "Anda belum memilih file untuk diunggah", "error")
        }

        else {

            $.ajax({
                url: "{{ url('saveKTP') }}",
                method:"POST",
                data:new FormData(this),
                dataType:'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success:function(data){

                    if ((data['response']) == "KTP berhasil disimpan") {
                        swal("Sukses", (data['response']), "success");

                        var txtFileKTP = data['img'];

                        $('#FileKTPSrc').val(txtFileKTP);
                       
                        var drEvent = $('#txtKTP').dropify();
                        drEvent = drEvent.data('dropify');
                        drEvent.resetPreview();
                        drEvent.clearElement();
                        drEvent.settings.defaultFile = txtFileKTP;
                        drEvent.destroy();
                        drEvent.init();
                        $('.dropify#txtKTP').dropify({
                        defaultFile: txtFileKTP,
                        });

                    }
                    else {
                        swal("Whops", (data['response']), "error");
                    }
            
                }
            })

        }
        
    });

    $('#saveIjazah').on('submit', function(event){
        
        event.preventDefault();

        var txtIjazah = $('#txtIjazah').val();
        
        if (!txtIjazah) {
            swal("Whops", "Anda belum memilih file untuk diunggah", "error")
        }

        else {

            $.ajax({
                url: "{{ url('saveIjazah') }}",
                method:"POST",
                data:new FormData(this),
                dataType:'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success:function(data){

                    if ((data['response']) == "Ijazah berhasil disimpan") {
                        swal("Sukses", (data['response']), "success");

                        var txtFileIjazah = data['img'];

                        $('#FileIjazahSrc').val(txtFileIjazah);
                       
                        var drEvent = $('#txtIjazah').dropify();
                        drEvent = drEvent.data('dropify');
                        drEvent.resetPreview();
                        drEvent.clearElement();
                        drEvent.settings.defaultFile = txtFileIjazah;
                        drEvent.destroy();
                        drEvent.init();
                        $('.dropify#txtIjazah').dropify({
                        defaultFile: txtFileIjazah,
                        });

                    }
                    else {
                        swal("Whops", (data['response']), "error");
                    }
            
                }
            })

        }
        
    });

    $('#LoadKTP').on('click', function() {

        event.preventDefault();
        var txtKTPSrc =  $('#FileKTPSrc').val();
        if (txtKTPSrc) {

            window.open(txtKTPSrc, '_blank'); 
        }

        else {
            swal("Whops", "File tidak tersedia, silahkan unggah dan simpan file KTP dahulu", "error")
        }
       

    

    });

    $('#LoadIjazah').on('click', function() {

        event.preventDefault();
        var txtIjazahSrc =  $('#FileIjazahSrc').val();
        if (txtIjazahSrc) {

            window.open(txtIjazahSrc, '_blank'); 

        }

        else {
            swal("Whops", "File tidak tersedia, silahkan unggah dan simpan file ijazah dahulu", "error")
        }
       

    

    });

    $('#HapusKTP').on('click', function() {

        event.preventDefault();
        var txtMemberID = $('#txtMemberIDKTP').val();

        swal({
            title: 'Apakah anda yakin?',
            text: "KTP yang dihapus tidak bisa dikembalikan",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Hapus',
            padding: '2em'
            }).then(function(result) {
                
                if (result.value) {
                    
                    $.ajax({
                        type: "POST",
                        url: "{{ url('deleteKTP') }}",
                        data: {
                            '_token': '{{ csrf_token() }}',
                            'txtMemberID': txtMemberID
                        },
                        success: function(data) {

                            if ((data['response']) == "KTP berhasil dihapus") {
                                    swal("Sukses", (data['response']), "success");
                                
                                    $('#FileKTPSrc').val('');

                                    var drEvent = $('#txtKTP').dropify();
                                    drEvent = drEvent.data('dropify');
                                    drEvent.resetPreview();
                                    drEvent.clearElement();
                                    drEvent.settings.defaultFile = "{{ asset('outside/assets/img/200x200.jpg') }}";
                                    drEvent.destroy();
                                    drEvent.init();
                                    $('.dropify#txtKTP').dropify({
                                    defaultFile: "{{ asset('outside/assets/img/200x200.jpg') }}",
                                    });
                                            
                                }
                                else {
                                    swal("Whops", (data['response']), "error");
                                }

                        
                        }
                    });

                }
            });
       

    

    });

    $('#HapusIjazah').on('click', function() {

        event.preventDefault();
        var txtMemberID = $('#txtMemberIDIjazah').val();

        swal({
            title: 'Apakah anda yakin?',
            text: "Ijzah yang dihapus tidak bisa dikembalikan",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Hapus',
            padding: '2em'
            }).then(function(result) {
                
                if (result.value) {
                    
                    $.ajax({
                        type: "POST",
                        url: "{{ url('deleteIjazah') }}",
                        data: {
                            '_token': '{{ csrf_token() }}',
                            'txtMemberID': txtMemberID
                        },
                        success: function(data) {

                            if ((data['response']) == "Ijazah berhasil dihapus") {
                                    swal("Sukses", (data['response']), "success");
                                
                                    $('#FileIjazahSrc').val('');

                                    var drEvent = $('#txtIjazah').dropify();
                                    drEvent = drEvent.data('dropify');
                                    drEvent.resetPreview();
                                    drEvent.clearElement();
                                    drEvent.settings.defaultFile = "{{ asset('outside/assets/img/200x200.jpg') }}";
                                    drEvent.destroy();
                                    drEvent.init();
                                    $('.dropify#txtIjazah').dropify({
                                    defaultFile: "{{ asset('outside/assets/img/200x200.jpg') }}",
                                    });
                                            
                                }
                                else {
                                    swal("Whops", (data['response']), "error");
                                }

                        
                        }
                    });

                }
            });
        
       

    

    });

    $('body').on('click', '.editMember', function(e) {

        blockUI();

        var txtMemberID = $(this).data('id');

        setId = txtMemberID;

        
        setEmpty1();
        
        $("#btnBack").show();
        $("#btnAddMember").hide();
        $("#btnFilter").hide();
        divTableMember.style.display = "none";
        memberForm.style.display = "block";
        $('#DocTitle').text(html3);

        $('#aSertifikasi').removeClass('disabled');
        $('#aPICKtp').removeClass('disabled');
        $('#aPICIjazah').removeClass('disabled');

        $('#txtMemberID').val(txtMemberID);
        $('#txtMemberIDTmp').val(txtMemberID); 
        $('#txtMemberIDKTP').val(txtMemberID);  
        $('#txtMemberIDIjazah').val(txtMemberID);     

        $('#Cert').DataTable().ajax.url("{{url('listCert?id=')}}"+setId).load();

        $.ajax({
            type: "POST",
            url: "{{ url('getDetailMember') }}",
            data: {
                '_token': '{{ csrf_token() }}',
                'txtMemberID': txtMemberID
            },
            success: function(data) {

                if (data.length > 0) {

                    $.each(data, function(index, element) {

                        var drEvent1 = $('#txtPhoto').dropify();
                        drEvent1 = drEvent1.data('dropify');
                        drEvent1.resetPreview();
                        drEvent1.clearElement();
                        drEvent1.settings.defaultFile = element.pic_url;
                        drEvent1.destroy();
                        drEvent1.init();
                        $('.dropify#txtPhoto').dropify({
                        defaultFile: element.pic_url,
                        });

                        

                        $('#UserPhotoSrc').val(element.pic_url);
                        $('#txtMemberID').val(element.member_id);
                        $("#txtGender").val(element.sex).trigger('change');
                        $('#txtName').val(element.member_name);
                        $('#txtNoIDCard').val(element.ident_id);
                        // $("#txtNoIDCard").attr("readonly", "readonly"); 
                        $('#txtAddress').val(element.address);
                        $('#txtProvText').val(element.province);
                        $('#txtCity').val(element.city);
                        $('#txtAddressDom').val(element.address1);
                        $('#txtProvDomText').val(element.province1);
                        $('#txtCityDom').val(element.city1);
                        // $('#txtBirthplace').val(element.birth_place);

                        var dob =  element.date_birth

                        // alert(dob);

                        f1.clear();
                        
                        f1 = flatpickr(document.getElementById('txtDOB'), {
                            altInput: true,
                            altFormat: "d-m-Y",
                            dateFormat: "Y-m-d",
                            disableMobile: "true",
                            defaultDate : element.date_birth
                        });



                        $('#txtDOB').val(element.date_birth);
                        $('#txtPhone').val(element.phone);
                        $('#txtEmail').val(element.email);
                        $("#txtEducation").val(element.last_educ).trigger('change');
                        $('#txtJob').val(element.job);
                        $('#txtJabatan').val(element.position);
                        $("#txtStatMember").val(element.st_anggota).trigger('change');
                        $("#txtIndustrial").val(element.position_id).trigger('change');
                        $('#txtIndustrialName').val(element.position_name);

                        if (element.st_kartu == 'Y') {

                            $("#txtStatKartu").prop("checked", true);

                        }

                        else {

                            $("#txtStatKartu").prop("checked", false);
                        }

                        if (element.st_pelatihan == 'Y') {

                            $("#txtStatTrainee").prop("checked", true);

                        }

                        else {

                            $("#txtStatTrainee").prop("checked", false);
                        }

                        if (element.st_bnsp == 'Y') {

                            $("#txtStatCert").prop("checked", true);

                        }

                        else {

                            $("#txtStatCert").prop("checked", false);
                        }

                        var drEvent2 = $('#txtKTP').dropify();
                        drEvent2 = drEvent2.data('dropify');
                        drEvent2.resetPreview();
                        drEvent2.clearElement();
                        drEvent2.settings.defaultFile = element.ktp_url;
                        drEvent2.destroy();
                        drEvent2.init();
                        $('.dropify#txtKTP').dropify({
                        defaultFile: element.ktp_url,
                        });

                        $('#FileKTPSrc').val(element.ktp_url);

                       
                       
                       var drEvent3 = $('#txtIjazah').dropify();
                       drEvent3 = drEvent3.data('dropify');
                       drEvent3.resetPreview();
                       drEvent3.clearElement();
                       drEvent3.settings.defaultFile = element.ijasah_url;
                       drEvent3.destroy();
                       drEvent3.init();
                       $('.dropify#txtIjazah').dropify({
                       defaultFile: element.ijasah_url,
                       });

                       $('#FileIjazahSrc').val(element.ijasah_url);






                        $.unblockUI();
                  
                    });





                   
                    
             

                   
                
                } else {

                    swal("Whops", (data['response']), "error");
                    
                }

            }
        })

        
        
        
        
        
        
        
        
        
        
        

        



       
        




    });

    $('body').on('click', '.setActive', function(e) {

        var txtMemberID = $(this).val();

        if(this.checked) {

            swal({
            title: 'Apakah anda yakin?',
            text: "Mengaktifkan member dengan ID "+txtMemberID,
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Lanjutkan',
            padding: '2em'
            }).then(function(result) {
                
                if (result.value) {
                    
                    $.ajax({
                        type: "POST",
                        url: "{{ url('setActive') }}",
                        data: {
                            '_token': '{{ csrf_token() }}',
                            'txtMemberID': txtMemberID,
                            'txtSetActive' : "Y"
                        },
                        success: function(data) {

                            if ((data['response']) == "Member sukses diaktifkan") {

                                swal("Sukses", (data['response']), "success");

                                $('#Member').DataTable().ajax.url("{{url('listMember')}}").load();
                                
                                        
                            }
                            else {
                                swal("Whops", (data['response']), "error");
                            }

                        
                        }
                    });

                }
                else {
                    
                    var switcID = "#"+txtMemberID;
                    $(switcID).prop('checked', false);

                }
            });
            
           
        }
        else {

            swal({
            title: 'Apakah anda yakin?',
            text: "Mengnonaktifkan member dengan ID "+txtMemberID,
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Lanjutkan',
            padding: '2em'
            }).then(function(result) {
                
                if (result.value) {
                    
                    $.ajax({
                        type: "POST",
                        url: "{{ url('setActive') }}",
                        data: {
                            '_token': '{{ csrf_token() }}',
                            'txtMemberID': txtMemberID,
                            'txtSetActive' : "N"
                        },
                        success: function(data) {

                            if ((data['response']) == "Member sukses dinonaktifkan") {

                                swal("Sukses", (data['response']), "success");

                                $('#Member').DataTable().ajax.url("{{url('listMember')}}").load();
                                    
                                        
                            }
                            else {
                                swal("Whops", (data['response']), "error");
                            }

                        
                        }
                    });

                }
                else {
                    var switcID = "#"+txtMemberID;
                    $(switcID).prop('checked', true);

                }
            });
           
        }



    });

    $('#btnFilter').on('click', function() {

        $("#SearchModal").modal('show');

    });

    $('#resetStartDate').on('click', function() {

        f2.clear();

    });

    $('#resetEndDate').on('click', function() {

        f3.clear();

    });

    $('#startSearch').on('click', function() {

        $("#SearchModal").modal('hide');

        listMemberTable();


    });

    $('#resetSearch').on('click', function() {


        $('#qTipeAnggota').val(null).trigger('change');
        $('#qKota').val(null).trigger('change');
        $('#qMemberID').val('');
        $('#qMemberName').val('');
        $('#qStartDate').val(null).trigger('change');
        $('#qEndDate').val(null).trigger('change');

        $("#SearchModal").modal('hide');

        listMemberTable();


        
   


    });

    





});


</script>

@endsection
{{-- Content Page JS End--}}
