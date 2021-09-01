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
<link href="{{ asset('outside/assets/css/elements/alert.css') }}" rel="stylesheet" type="text/css" >
<link href="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/css/dataTables.checkboxes.css" rel="stylesheet" type="text/css" />
<style>

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

.badge-secondary {
    color: #5c1ac3;
    border: 2px dashed #5c1ac3; }
}

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
                            <li class="breadcrumb-item active" aria-current="page"><a href="{{ url('MemberMgt') }}">Pelatihan dan Sertifikasi Anggota</a></li>
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

        <div class="col-lg-12 col-md-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4 id='DocTitle'></h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content-area">

                    <div class="alert alert-icon-left alert-light-success mb-4" role="alert" id="alertEvent" style="display: none">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-circle"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                        <strong>Voila!</strong> Pelatihan/Sertifikasi ini sudah selesai dilaksanakan.
                    </div>

                    <a href="javascript:void(0)" class="btn btn-dark mb-2" id="btnAddTrainee">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                        Tambah Pelatihan/Sertifikasi
                    </a>

                    <a href="javascript:void(0)" class="btn btn-info mb-2" id="btnFilter">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-zoom-in"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line><line x1="11" y1="8" x2="11" y2="14"></line><line x1="8" y1="11" x2="14" y2="11"></line></svg>
                        Filter Pencarian
                    </a>

                    <a href="javascript:void(0)" class="btn btn-dark mb-2" id="btnBack" style="display: none">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                        Kembali
                    </a>

                    <a href="javascript:void(0)" class="btn btn-success mb-2" id="eventClosing" style="display: none">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                        Pelatihan/Sertifikasi Selesai ?
                    </a>

                    <div class="table-responsive" id="divTraineeTable">
                        <table id="TraineeTable" class="table wrap" style="width:100%">
                            <thead>
                                <tr>

                                    @if(Session::get('GROUPID') == 'ADMIN' or Session::get('GROUPID') == 'DEVELOPMENT')
                                        <th>Aksi</th>
                                        <th>Event ID</th>
                                        <th>Kantor Cabang</th>
                                        <th>Tanggal Penyelenggaraan</th>
                                        <th>Status</th>
                                        <th>Peserta</th>
                                        <th>Jenis</th>
                                        <th>Nama</th>
                                        <th>Keterangan</th>
                                        <th>Penyelenggara</th> 
                                    @else
                                        <th>Event ID</th>
                                        <th>Kantor Cabang</th>
                                        <th>Tanggal Penyelenggaraan</th>
                                        <th>Status</th>
                                        <th>Peserta</th>
                                        <th>Jenis</th>
                                        <th>Nama</th>
                                        <th>Keterangan</th>
                                        <th>Penyelenggara</th>              
                                    @endif
                                    
                
                                </tr>
                            </thead>
                        </table>
                    </div>


                    <div id ="traineeForm" style="display: none">

                        <div class="row layout-top-spacing">
                            <div class="col-lg-5 layout-spacing layout-spacing">

                                <form method="post" id="saveEventHdr">
                                @csrf

                                <div class="form-row mb-6">
                                    <div class="form-group col-md-6 col-6">
                                        <label class="text-dark" for="txtEventID">Event ID</label>
                                        <input type="text" name="txtEventID" id="txtEventID" class="form-control" readonly>
                                    </div>

                                    <div class="form-group col-md-6 col-6">
                                        <label class="text-dark" for="txtDtTrx">Tanggal Pelaksanaan</label>
                                        <div class="input-group">
                                            <input type="text" name="txtDtTrx" id="txtDtTrx" class="form-control" readonly>
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-success" id="resetDtTrx">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-refresh-cw"><polyline points="23 4 23 10 17 10"></polyline><polyline points="1 20 1 14 7 14"></polyline><path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path></svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row mb-6">
                                    <div class="form-group col-md-12 col-12">
                                        <label class="text-dark" for="txtOfficeID">Cabang</label>
                                        <select class="form-control basic" name="txtOfficeID" id="txtOfficeID">
                                            <option></option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-row mb-6">
                                    <div class="form-group col-md-6 col-6">
                                        <label class="text-dark" for="txtTrainingID">Nama Training</label>
                                        <select class="form-control basic" name="txtTrainingID" id="txtTrainingID">
                                            <option></option>
                                        </select>
                                    </div>
                               
                                    <div class="form-group col-md-6 col-6">
                                        <label class="text-dark" for="txtTrainingType">Tipe Training</label>
                                        <div id="txtTrainingTypeLoading">
                                            <select class="form-control basic" name="txtTrainingType" id="txtTrainingType">
                                                <option></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row mb-6">
                                    <div class="form-group col-md-6 col-6">
                                        <label class="text-dark" for="txtEventName">Nama Event</label>
                                        <input type="text" name="txtEventName" id="txtEventName" class="form-control">
                                    </div>
                            
                                    <div class="form-group col-md-6 col-6">
                                        <label class="text-dark" for="txtAgency">Penyelenggara</label>
                                        <input type="text" name="txtAgency" id="txtAgency" class="form-control">
                                    </div>
                                </div>
                                
                                <div class="form-row mb-6">
                                    <div class="form-group col-md-12 col-12">
                                        <label class="text-dark" for="txtAddress">Alamat Pelaksanaan</label>
                                        <textarea class="form-control" id="txtAddress" name="txtAddress" rows="3"></textarea>
                                    </div>
                                </div>

                                <div class="form-row mb-6">
                                    <div class="form-group col-md-6 col-6">
                                        <label class="text-dark" for="txtCity">Kota</label>
                                        <input type="text" name="txtCity" id="txtCity" class="form-control">
                                    </div>
                               
                                    <div class="form-group col-md-6 col-6">
                                        <label class="text-dark" for="txtProv">Provinsi</label>
                                        <input type="text" name="txtProv" id="txtProv" class="form-control">
                                    </div>
                                </div>

                                <div class="form-row mb-6">
                                    <div class="form-group col-md-12 col-12">
                                        <label class="text-dark" for="txtRemark">Keterangan</label>
                                        <textarea class="form-control" id="txtRemark" name="txtRemark" rows="3"></textarea>
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


                            <div class="col-lg-7 layout-spacing layout-spacing">

                                <a href="javascript:void(0)" class="btn btn-warning mb-2" id="btnAddMemberEvent">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                    Peserta
                                </a>

                                <div class="table-responsive" id="divEventMemberTable">
                                    <table id="EventMemberTable" class="table wrap" style="width:100%">
                                        <thead>
                                            <tr>
                                                {{-- <th>Event ID</th> --}}
                                                <th>ID Anggota</th>
                                                <th>Status</th>
                                                <th>Nama Anggota</th>
                                                <th>Kota</th>
                                                <th>Prov</th>
                                                <th>Telp</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                {{-- <th>Event ID</th> --}}
                                                <th>ID Anggota</th>
                                                <th>Status</th>
                                                <th>Nama Anggota</th>
                                                <th>Kota</th>
                                                <th>Prov</th>
                                                <th>Telp</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>

                               


                            </div>
                        </div>





                    </div>

                    {{-- <button class="btn btn-success btn-block" id="eventClosing">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-save"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg>
                        Pelatihan/Sertifikasi Selesai
                    </button> --}}




                </div>
            </div>
        </div>

        

    </div>
</div>


<div class="modal fade" id="modalSelMember" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content" id="modalLoad">
            <div class="modal-header">
                <h3 class="modal-title">Silahkan pilih anggota yang akan menjadi peserta</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <div class="modal-body">

                <form method="post" id="saveEventDtl">
                    @csrf
            
                <div class="table-responsive">
                    <table id="ChooseMemberTable" class="table wrap" style="width:100%">
                        <thead>
                            <tr>
                                <th></th>
                                <th>ID Anggota</th>
                                {{-- <th>No. Identitas</th> --}}
                                <th>Nama</th>
                                <th>Telp</th>
                                {{-- <th>Alamat(KTP)</th> --}}
                                <th>Kota</th>
                                {{-- <th>Alamat(Dom)</th> --}}
                                <th>Prov</th>
                                {{-- <th>Jenis Kelamin</th>
                                <th>Pendidikan</th>
                                <th>Pekerjaan</th>
                                <th>Posisi</th> --}}
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th>ID Anggota</th>
                                {{-- <th>No. Identitas</th> --}}
                                <th>Nama</th>
                                <th>Telp</th>
                                {{-- <th>Alamat(KTP)</th> --}}
                                <th>Kota</th>
                                {{-- <th>Alamat(Dom)</th> --}}
                                <th>Prov</th>
                                {{-- <th>Jenis Kelamin</th>
                                <th>Pendidikan</th>
                                <th>Pekerjaan</th>
                                <th>Posisi</th> --}}
                            </tr>
                        </tfoot>
                    </table>
                </div>

                

            </div>
            <div class="modal-footer">
                
                <button class="btn btn-dark" id="simpanPeserta">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-save"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg>
                    Simpan Data 
                </button> 
            
                </form>
                
                
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
                            <div class="form-group col-md-6 col-6">
                                <label class="text-dark" for="qOfficeID">Cabang</label>
                                <select class="form-control basic" name="qOfficeID" id="qOfficeID">
                                    <option></option>
                                </select>
                            </div>
                            <div class="form-group col-md-6 col-6">
                                <label class="text-dark" for="qStatus">Status</label>
                                <select class="form-control basic" name="qStatus" id="qStatus">
                                    <option></option>
                                    <option value="P">Planned</option>
                                    <option value="C">Closed</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row mb-6">
                            <div class="form-group col-md-6 col-6">
                                <label class="text-dark" for="qTrainingID">Nama Training</label>
                                <select class="form-control basic" name="qTrainingID" id="qTrainingID">
                                    <option></option>
                                </select>
                            </div>
                       
                            <div class="form-group col-md-6 col-6">
                                <label class="text-dark" for="qTrainingType">Tipe Training</label>
                                <div id="qTrainingTypeLoading">
                                    <select class="form-control basic" name="qTrainingType" id="qTrainingType">
                                        <option></option>
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="form-row mb-6">
                            <div class="form-group col-md-6">
                                <label class="text-dark" for="qStartDate">Dari Tanggal</label>
                                <span class="badge badge-info">Tanggal Event</span>
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
                                <span class="badge badge-info">Tanggal Event</span>
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


<div class="modal fade" id="modalClosing" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content" id="modalLoad">
            <div class="modal-header">
                <h3 class="modal-title">Event Closing</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <div class="modal-body">

            
                <div class="table-responsive">
                    <table id="ClosingTable" class="table wrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>Keterangan</th>
                                <th>ID Anggota</th>
                                <th>Nama Anggota</th>
                                <th>Kota</th>
                                <th>Prov</th>
                                <th>Telp</th>
                            </tr>
                        </thead>
                    </table>
                </div>


                <div id="formExpired" style="display: none">

                    <hr class="style">
                
                    <div class="form-row mb-6">
                        <div class="form-group col-md-5 col-5">
                            <label class="text-dark" for="txtExpiredStart">Tanggal Sertifikasi</label>
                            <span class="badge badge-info">Berlaku dari tanggal</span>
                            <div class="input-group">
                                <input type="text" name="txtExpiredStart" id="txtExpiredStart" class="form-control">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-success" id="resetExpiredStart">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-refresh-cw"><polyline points="23 4 23 10 17 10"></polyline><polyline points="1 20 1 14 7 14"></polyline><path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path></svg>
                                    </button>
                                </div>
                            </div> 
                        </div>

                        <div class="form-group col-md-2 col-2">
                            <label class="text-dark" for="txtExpiredYear">Masa berlaku</label>
                                <input class="form-control" name="txtExpiredYear" id="txtExpiredYear" onkeypress="return CheckNumeric()"/>
                        </div>

                        <div class="form-group col-md-5 col-5">
                            <label class="text-dark" for="txtExpiredEnd">Tanggal Sertifikasi</label>
                            <span class="badge badge-info">Berlaku sampai tanggal</span>
                            <div class="input-group">
                                <input type="text" name="txtExpiredEnd" id="txtExpiredEnd" class="form-control" disabled>
                            </div> 
                        </div>
                    </div>
                
                </div>

                

            </div>
            <div class="modal-footer">
                
                <button class="btn btn-dark" id="simpanEventClosing">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-save"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg>
                    Simpan Data 
                </button> 
                
                
                <button class="btn" data-dismiss="modal">
                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                Close</button>

                
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
<script src="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/js/dataTables.checkboxes.min.js" type="text/javascript" ></script>
<script>

var latest_id, block, dataTable3, listMemberID, f1, f2, f3, f4, listMemberClosing, txtTypeEvent;
var qTrainingID, qTrainingType, qEventID, qStatus;
var groupid = '{{ Session::get('GROUPID') }}'

//For search filter
var qqOfficeID, qqStatus, qqTrainingID, qqTrainingType, qqStartDate, qqEndDate;

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

function listOffice(id){

    if(!id) {

        $.ajax({
        type: "GET",
        url: "{{ url('listOffice') }}",
            success: function(data) {

                count = Object.keys(data).length;

                if (count < 2) {

                    $('select[name="txtOfficeID"]').empty();
                    $('select[name="txtOfficeID"]').prepend('<option></option>');
                    $.each(data, function(index, element) {
                        $('select[name="txtOfficeID"]').append('<option value="'+element.office_id+'" selected>'+element.office_name+'</option>');
                    });
                    $('#txtOfficeID').prop('disabled', true);

                }

                else {
                    
                    $('select[name="txtOfficeID"]').empty();
                    $('select[name="txtOfficeID"]').prepend('<option></option>');
                    $.each(data, function(index, element) {
                        $('select[name="txtOfficeID"]').append('<option value="'+element.office_id+'">'+element.office_name+'</option>');
                    });
                    $('#txtOfficeID').prop('disabled', false);
                }
            }
        });


        $('#txtOfficeID').select2({
            placeholder: 'Pilih Cabang',
            allowClear: true
        });
    }

    else {

         $.ajax({
        type: "GET",
        url: "{{ url('listOffice') }}",
            success: function(data) {

                count = Object.keys(data).length;

                if (count < 2) {

                    $('select[name="txtOfficeID"]').empty();
                    $('select[name="txtOfficeID"]').prepend('<option></option>');
                    $.each(data, function(index, element) {
                        $('select[name="txtOfficeID"]').append('<option value="'+element.office_id+'" selected>'+element.office_name+'</option>');
                    });
                    $('#txtOfficeID').prop('disabled', true);

                }

                else {
                    
                    $('select[name="txtOfficeID"]').empty();
                    $('select[name="txtOfficeID"]').prepend('<option></option>');
                    $.each(data, function(index, element) {
                        if ( element.office_id == id ) {
                            $('select[name="txtOfficeID"]').append('<option value="'+element.office_id+'" selected>'+element.office_name+'</option>');
                        }
                        else {
                            $('select[name="txtOfficeID"]').append('<option value="'+element.office_id+'">'+element.office_name+'</option>');
                        }
                    });
                    $('#txtOfficeID').prop('disabled', false);
                }
            }
        });


        $('#txtOfficeID').select2({
            placeholder: 'Pilih Cabang',
            allowClear: true
        });


    }

   


}

function listTraining(id){

    if(!id) {

        $.ajax({
            type: "GET",
            url: "{{ url('listTraining') }}",
            success: function(data) {

                count = Object.keys(data).length;

                if (count < 2) {

                    $('select[name="txtTrainingID"]').empty();
                    $('select[name="txtTrainingID"]').prepend('<option></option>');
                    $.each(data, function(index, element) {
                        $('select[name="txtTrainingID"]').append('<option value="'+element.train_id+'" selected>'+element.descr+'</option>');
                    });
                    $('#txtTrainingID').prop('disabled', true);

                }

                else {
                    
                    $('select[name="txtTrainingID"]').empty();
                    $('select[name="txtTrainingID"]').prepend('<option></option>');
                    $.each(data, function(index, element) {
                        $('select[name="txtTrainingID"]').append('<option value="'+element.train_id+'">'+element.descr+'</option>');
                    });
                    $('#txtTrainingID').prop('disabled', false);
                }
            }
        });


        $('#txtTrainingID').select2({
            placeholder: 'Pilih Training',
            allowClear: true
        });

    }

    else {
        
        $.ajax({
            type: "GET",
            url: "{{ url('listTraining') }}",
            success: function(data) {

                count = Object.keys(data).length;

                if (count < 2) {

                    $('select[name="txtTrainingID"]').empty();
                    $('select[name="txtTrainingID"]').prepend('<option></option>');
                    $.each(data, function(index, element) {
                        $('select[name="txtTrainingID"]').append('<option value="'+element.train_id+'" selected>'+element.descr+'</option>');
                    });
                    $('#txtTrainingID').prop('disabled', true);

                }

                else {
                    
                    $('select[name="txtTrainingID"]').empty();
                    $('select[name="txtTrainingID"]').prepend('<option></option>');
                    $.each(data, function(index, element) {

                        if ( element.train_id == id ) {
                            $('select[name="txtTrainingID"]').append('<option value="'+element.train_id+'" selected>'+element.descr+'</option>');
                        }
                        else {
                            $('select[name="txtTrainingID"]').append('<option value="'+element.train_id+'">'+element.descr+'</option>');
                        }
                    });
                    $('#txtTrainingID').prop('disabled', false);
                }
            }
        });


        $('#txtTrainingID').select2({
            placeholder: 'Pilih Training',
            allowClear: true
        });
    }

   


}

function listTrainingType(){

    $('#txtTrainingType').select2({
        placeholder: 'Pilih Training dulu',
        allowClear: true
    });


}

function listMemberEvent(txtEventID){

    $('#EventMemberTable tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" class="form-control" placeholder="..." />' );
    } );

    var dataTable2 = $('#EventMemberTable').DataTable({
        "oLanguage": {
            "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
            "sInfo": "Showing page _PAGE_ of _PAGES_",
            "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
            "sSearchPlaceholder": "Search",
            "sLengthMenu": "Show :  _MENU_ entries",
            },
        order: [ [2, 'asc'] ],
        stripeClasses: [],
        lengthMenu: [5, 10, 20, 50],
        pageLength: 10,
        destroy : true,
        responsive: true,
        processing: true,
        serverSide: true,
        autoWidth: false,
        ajax: {
            'url':'{!!url("listEventDtl")!!}',
            'type': 'post',
            data: {
                    '_token': '{{ csrf_token() }}',
                    'txtEventID': txtEventID
                }
        },
        columns: [

            // {data: 'trx_id', name: 'trx_id'},
            {data: 'member_id', name: 'member_id'},
            {data: 'stat', name: 'stat'},
            {data: 'member_name', name: 'member_name'},
            {data: 'city', name: 'city'},
            {data: 'province', name: 'province'},
            {data: 'phone', name: 'phone'},
            {data: 'Detail', name: 'Detail',orderable:false,searchable:false},
        ],
        initComplete: function(settings, json) {

            if (!dataTable2.rows().data().length) {

                // swal("Whops", "Data not available", "error");
            }

            else {

                if(qStatus == 'P') {

                    $('#eventClosing').show();
                }

                else {

                    $('#eventClosing').show();
                }

                this.api().columns().every( function () {
                                    
                    var that = this;

                    $( 'input', this.footer() ).on( 'keyup change clear', function () {
                        if ( that.search() !== this.value ) {
                            that
                                .search( this.value )
                                .draw();
                        }
                    } );
                });
            }
        },
    });

    //alert(txtEventID);

}

function setEmpty1() {

    f1.clear();
    $('#txtDtTrx').val();
    $('#txtOfficeID').val(null).trigger('change');
    $('#txtTrainingID').val(null).trigger('change');
    $('#txtTrainingType').val(null).trigger('change');
    $('#txtEventName').val('');
    $('#txtAgency').val('');
    $('#txtAddress').val('');
    $('#txtCity').val('');
    $('#txtProv').val('');
    $('#txtRemark').val('');



}

function listqOfficeID(){

    $.ajax({
    type: "GET",
    url: "{{ url('listOffice') }}",
        success: function(data) {

            count = Object.keys(data).length;

            if (count < 2) {

                $('select[name="qOfficeID"]').empty();
                $('select[name="qOfficeID"]').prepend('<option></option>');
                $.each(data, function(index, element) {
                    $('select[name="qOfficeID"]').append('<option value="'+element.office_id+'" selected>'+element.office_name+'</option>');
                });
                $('#qOfficeID').prop('disabled', true);

            }

            else {

                $('select[name="qOfficeID"]').empty();
                $('select[name="qOfficeID"]').prepend('<option></option>');
                $.each(data, function(index, element) {
                    $('select[name="qOfficeID"]').append('<option value="'+element.office_id+'">'+element.office_name+'</option>');
                });
                $('#qOfficeID').prop('disabled', false);
            }
        }
    });


    $('#qOfficeID').select2({
        placeholder: 'Pilih Cabang',
        allowClear: true,
        dropdownParent: $('#SearchModal')
    });



}

function listqStatus(){


    $('#qStatus').select2({
        placeholder: 'Pilih Status',
        allowClear: true,
        dropdownParent: $('#SearchModal')
    });


}

function listqTrainingID(){

    $.ajax({
        type: "GET",
        url: "{{ url('listTraining') }}",
        success: function(data) {

            count = Object.keys(data).length;

            if (count < 2) {

                $('select[name="qTrainingID"]').empty();
                $('select[name="qTrainingID"]').prepend('<option></option>');
                $.each(data, function(index, element) {
                    $('select[name="qTrainingID"]').append('<option value="'+element.train_id+'" selected>'+element.descr+'</option>');
                });
                $('#qTrainingID').prop('disabled', true);

            }

            else {
                
                $('select[name="qTrainingID"]').empty();
                $('select[name="qTrainingID"]').prepend('<option></option>');
                $.each(data, function(index, element) {
                    $('select[name="qTrainingID"]').append('<option value="'+element.train_id+'">'+element.descr+'</option>');
                });
                $('#qTrainingID').prop('disabled', false);
            }
        }
    });


    $('#qTrainingID').select2({
        placeholder: 'Pilih Training',
        allowClear: true,
        dropdownParent: $('#SearchModal')
    });


}

function listqTrainingType(){

    $('#qTrainingType').select2({
        placeholder: 'Pilih Training dulu',
        allowClear: true,
        dropdownParent: $('#SearchModal')
    });

}

function listTraineeTable(groupid){

    
    qqOfficeID = $('#qOfficeID').val();
    qqStatus = $('#qStatus').val();
    qqTrainingID = $('#qTrainingID').val();
    qqTrainingType = $('#qTrainingType').val();
    qqStartDate = $('#qStartDate').val();
    qqEndDate = $('#qEndDate').val();

    // blockUI();

    if (groupid == 'ADMIN' || groupid == 'DEVELOPMENT') {
    
        var dataTable = $('#TraineeTable').DataTable({
            "oLanguage": {
                "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Search",
                "sLengthMenu": "Show :  _MENU_ entries",
                },
            // order: [ [1, 'asc'] ],
            stripeClasses: [],
            lengthMenu: [5, 10, 20, 50],
            pageLength: 10,
            destroy : true,
            responsive: true,
            processing: true,
            serverSide: true,
            autoWidth: false,
            ajax: {
                'url':'{!!url("listTrainee")!!}',
                'type': 'post',
                data: {
                        '_token': '{{ csrf_token() }}',
                        'qOfficeID' : qqOfficeID,
                        'qStatus' : qqStatus,
                        'qTrainingID' : qqTrainingID,
                        'qTrainingType' : qqTrainingType,
                        'qStartDate' : qqStartDate,
                        'qEndDate' : qqEndDate
                    }
            },
            columns: [
                {data: 'Detail', name: 'Detail',orderable:false,searchable:false},
                {data: 'trx_id', name: 'trx_id'},
                {data: 'office_name', name: 'office_name'},
                {data: 'dt_trx', name: 'dt_trx'},
                {data: 'stat', name: 'stat'},
                {data: 'qty_member', name: 'qty_member'},
                {data: 'descr_mst_training', name: 'descr_mst_training'},
                {data: 'descr_mst_training_type', name: 'descr_mst_training_type'},
                {data: 'descr_event', name: 'descr_event'},
                {data: 'agency', name: 'agency'}
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
    else {

        var dataTable = $('#TraineeTable').DataTable({
            "oLanguage": {
                "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Search",
                "sLengthMenu": "Show :  _MENU_ entries",
                },
            // order: [ [1, 'asc'] ],
            stripeClasses: [],
            lengthMenu: [5, 10, 20, 50],
            pageLength: 10,
            destroy : true,
            responsive: true,
            processing: true,
            serverSide: true,
            autoWidth: false,
            ajax: {
                'url':'{!!url("listTrainee")!!}',
                'type': 'post',
                data: {
                        '_token': '{{ csrf_token() }}',
                        'qOfficeID' : qqOfficeID,
                        'qStatus' : qqStatus,
                        'qTrainingID' : qqTrainingID,
                        'qTrainingType' : qqTrainingType,
                        'qStartDate' : qqStartDate,
                        'qEndDate' : qqEndDate
                    }
            },
            columns: [
                {data: 'trx_id', name: 'trx_id'},
                {data: 'office_name', name: 'office_name'},
                {data: 'dt_trx', name: 'dt_trx'},
                {data: 'stat', name: 'stat'},
                {data: 'qty_member', name: 'qty_member'},
                {data: 'descr_mst_training', name: 'descr_mst_training'},
                {data: 'descr_mst_training_type', name: 'descr_mst_training_type'},
                {data: 'descr_event', name: 'descr_event'},
                {data: 'agency', name: 'agency'}
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

}

function CheckNumeric() {
    return event.keyCode >= 48 && event.keyCode <= 57 || event.keyCode == 46;
}

$(document).ready(function() {

    $('#homeNav').attr('data-active','false');
    $('#homeNav').attr('aria-expanded','false');
    $('#MemberMgtNav').attr('data-active','true');
    $('#MemberMgtNav').attr('aria-expanded','true');
    $('.MemberMgtTreeView').addClass('show');
    $('#MemberTrainee').addClass('active');

    block = $('#modalLoad');

    var divTraineeTable = document.getElementById("divTraineeTable");
    var traineeForm = document.getElementById("traineeForm");
    var formExpired = document.getElementById("formExpired");

    var html1 = 'Daftar Event Pelatihan/Sertifikasi';
    var html2 = 'Tambah Event Pelatihan/Sertifikasi';
    var html3 = 'Edit Event Pelatihan/Sertifikasi';

    $('#DocTitle').text(html1);

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


    listqOfficeID();
    listqStatus();
    listqTrainingID();
    listqTrainingType();
    listTraineeTable(groupid);

    @if(Session::get('GROUPID') == 'ADMIN' or Session::get('GROUPID') == 'DEVELOPMENT')
        $("#btnAddTrainee").show();
    @else
        $("#btnAddTrainee").hide();
    @endif

    $('.basic').on('select2:open', function() {
        if (Modernizr.touch) {
            $('.select2-search__field').prop('focus', false);
        }
    });

    f1 = flatpickr(document.getElementById('txtDtTrx'), {
        altInput: true,
        altFormat: "d-m-Y",
        dateFormat: "Y-m-d",
        disableMobile: "true",
    });

    $('#btnAddTrainee').on('click', function() {

        setEmpty1();
        var id;

        $("#btnBack").show();
        $("#btnAddTrainee").hide();
        $("#btnFilter").hide();
        divTraineeTable.style.display = "none";
        traineeForm.style.display = "block";
        $('#DocTitle').text(html2);
        
        $.ajax({
            type: "GET",
            url: "{{ url('getEventID') }}",
            success: function(data) {

                latest_id = data['eventID'];
                listMemberEvent(latest_id);
                $('#txtEventID').val(latest_id);
                
            }
        });

        listOffice(id);
        listTraining(id);
        listTrainingType();
       
    });

    $('#btnBack').on('click', function() {

        $("#btnAddTrainee").show();
        $("#btnFilter").show();
        $("#btnBack").hide();
        $("#eventClosing").hide();
        divTraineeTable.style.display = "block";
        traineeForm.style.display = "none";
        $('#TraineeTable').DataTable().ajax.url("{{url('listTrainee')}}").load();

    });

    $('#txtTrainingID').change(function(){
        
        var id = $("#txtTrainingID").val();
        var block = $('#txtTrainingTypeLoading');
        blockElement(block);

        if (id) {

            $.ajax({
                type: "GET",
                dataType: "json",
                url: "{{url('listTrainingType/id=')}}"+id,
                success: function (data) {
                    $(block).unblock();
                    $('select[name="txtTrainingType"]').empty();
                    $('select[name="txtTrainingType"]').prepend('<option></option>');
                    $.each(data, function(index, element) {
                    $('select[name="txtTrainingType"]').append('<option value="'+element.train_type_id+'">'+element.descr+'</option>');
                    });
                }
            });

            $('#txtTrainingType').select2({
                placeholder: 'Pilih Training Tipe',
                allowClear: true
            });

        }
        else {
            $(block).unblock();
            $('select[name="txtTrainingType"]').empty();
            $('select[name="txtTrainingType"]').prepend('<option></option>');
            listTrainingType();
        }
 
    });

    $('#resetDtTrx').on('click', function(event) {

        event.preventDefault();

        f1.clear();

    });

    $('#btnFilter').on('click', function() {

        $("#SearchModal").modal('show');

    });

    $('#qTrainingID').change(function(){
        
        var id = $("#qTrainingID").val();
        var block = $('#qTrainingTypeLoading');
        blockElement(block);

        if (id) {

            $.ajax({
                type: "GET",
                dataType: "json",
                url: "{{url('listTrainingType/id=')}}"+id,
                success: function (data) {
                    $(block).unblock();
                    $('select[name="qTrainingType"]').empty();
                    $('select[name="qTrainingType"]').prepend('<option></option>');
                    $.each(data, function(index, element) {
                    $('select[name="qTrainingType"]').append('<option value="'+element.train_type_id+'">'+element.descr+'</option>');
                    });
                }
            });

            $('#qTrainingType').select2({
                placeholder: 'Pilih Training Tipe',
                allowClear: true,
                dropdownParent: $('#SearchModal')
                
            });

        }
        else {
            $(block).unblock();
            $('select[name="qTrainingType"]').empty();
            $('select[name="qTrainingType"]').prepend('<option></option>');
            listqTrainingType();
        }
 
    });

    $('#startSearch').on('click', function() {

        $("#SearchModal").modal('hide');

        listTraineeTable(groupid);


    });

    $('#resetSearch').on('click', function() {


        $('#qOfficeID').val(null).trigger('change');
        $('#qStatus').val(null).trigger('change');
        $('#qTrainingID').val(null).trigger('change');
        $('#qTrainingType').val(null).trigger('change');
        $('#qStartDate').val(null).trigger('change');
        $('#qEndDate').val(null).trigger('change');

        $("#SearchModal").modal('hide');

        listTraineeTable(groupid);

    });

    $('#resetExpiredStart').on('click', function(event) {

        event.preventDefault();

        f3.clear();
        f4.clear();
        $('#txtExpiredYear').val('')

    });

    $('#txtExpiredStart').change(function(){

        var txtExpiredYear = $('#txtExpiredYear').val()
        var txtExpiredStart = $('#txtExpiredStart').val()

        var yearEnd = parseInt(txtExpiredStart.substring(0, 4)) + parseInt(txtExpiredYear);
        var monthEnd = txtExpiredStart.substring(5, 7);
        var dayEnd = txtExpiredStart.substring(8, 10);

        var dateEnd = yearEnd+"-"+monthEnd+"-"+dayEnd


        f4 = flatpickr(document.getElementById('txtExpiredEnd'), {
            altInput: true,
            altFormat: "d M Y",
            dateFormat: "Y-m-d",
            disableMobile: "true",
            defaultDate : dateEnd
        });


        

    });

    $('#txtExpiredYear').keyup(function(){


        var txtExpiredYear = $('#txtExpiredYear').val()
        var txtExpiredStart = $('#txtExpiredStart').val()

        var yearEnd = parseInt(txtExpiredStart.substring(0, 4)) + parseInt(txtExpiredYear);
        var monthEnd = txtExpiredStart.substring(5, 7);
        var dayEnd = txtExpiredStart.substring(8, 10);

        var dateEnd = yearEnd+"-"+monthEnd+"-"+dayEnd

        f4 = flatpickr(document.getElementById('txtExpiredEnd'), {
            altInput: true,
            altFormat: "d M Y",
            dateFormat: "Y-m-d",
            disableMobile: "true",
            defaultDate : dateEnd
        });
       
     

    });

    $('#modalClosing').on('shown.bs.modal', function () {
       dataTable4.columns.adjust();
    });


    // Transaction begin


    $('#saveEventHdr').on('submit', function(event){
        
        event.preventDefault();

        var txtEventID = $('#txtEventID').val();
        var txtDtTrx = $('#txtDtTrx').val();
        var txtOfficeID = $('#txtOfficeID').val();
        var txtTrainingID = $('#txtTrainingID').val();
        var txtTrainingType = $('#txtTrainingType').val();
        var txtEventName = $('#txtEventName').val();
        var txtAddress = $('#txtAddress').val();
        var txtCity = $('#txtCity').val();
        var txtProv = $('#txtProv').val();
        
        if (!txtEventID) {
            swal("Whoops", "Event ID harus diisi", "error")
        }
        if (!txtDtTrx) {
            swal("Whoops", "Tanggal pelaksanaan harus diisi", "error")
        }
        if (!txtOfficeID) {
            swal("Whoops", "Cabang pelaksana harus diisi", "error")
        }
        if (!txtTrainingID) {
            swal("Whoops", "Training harus diisi", "error")
        }
        if (!txtTrainingType) {
            swal("Whoops", "Tipe training harus diisi", "error")
        }
        if (!txtEventName) {
            swal("Whoops", "Nama Event harus diisi", "error")
        }
        if (!txtAddress) {
            swal("Whoops", "Alamat pelaksaan harus diisi", "error")
        }
        if (!txtCity) {
            swal("Whoops", "Kota pelaksaan harus diisi", "error")
        }
        if (!txtProv) {
            swal("Whoops", "Provinsi harus diisi", "error")
        }

        if (txtEventID && txtDtTrx && txtOfficeID && txtTrainingID && txtTrainingType && txtEventName && txtAddress && txtCity && txtProv){

            $.ajax({
                url: "{{ url('saveEventHdr') }}",
                method:"POST",
                data:new FormData(this),
                dataType:'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success:function(data){

                    if ((data['response']) == "Data sukses disimpan") {

                        var response = data['response'];


                        $.ajax({
                            type: "POST",
                            url: "{{ url('getEventHdr') }}",
                            data: {
                                '_token': '{{ csrf_token() }}',
                                'txtEventID': txtEventID
                            },
                            success: function(data) {

                                $.unblockUI();

                                if (data.length > 0) {

                                    $.each(data, function(index, element) {

                                        qTrainingID = element.train_id;
                                        qTrainingType = element.train_type_id;
                                        qEventID = element.trx_id;
                                        qStatus = element.stat;
                                    });

                                }

                                else {

                                    swal("whops", "Variabel tidak terpenuhi", "error")

                                }
                            }

                    
                        });

                        swal("Yeay", response+ ", sekarang anda bisa menambahkan anggota peserta", "success");

                    }

                    else if ((data['response']) == "Data sukses diperbaharui") {

                        var response = data['response'];

                        swal("Yeay", response, "success");

                    }
                    else {
                        swal("Whops", (data['response']), "error");
                    }
            
                }
         })

        }
        
    });

    $('#btnAddMemberEvent').on('click', function() {

        event.preventDefault();
        blockUI();
        var txtEventID = $('#txtEventID').val();

        $.ajax({
            type: "GET",
            dataType: "json",
            url: "{{url('checkEventHdr/id=')}}"+txtEventID,
            success: function (data) {

                if (data.length > 0) {

                    $('#ChooseMemberTable tfoot th').each( function () {
                        var title = $(this).text();
                        $(this).html( '<input type="text" class="form-control" placeholder="..." />' );
                    } );

                    dataTable3 = $('#ChooseMemberTable').DataTable({
                        "oLanguage": {
                            "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                            "sInfo": "Showing page _PAGE_ of _PAGES_",
                            "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                            "sSearchPlaceholder": "Search",
                            "sLengthMenu": "Show :  _MENU_ entries",
                        },
                        'columnDefs': [
                            {
                                'targets': 0,
                                'checkboxes': {
                                'selectRow': true
                                }
                            }
                        ],
                        'select': {
                            'style': 'multi'
                        },
                        order: [ [2, 'asc'] ],
                        stripeClasses: [],
                        lengthMenu: [5, 10, 20, 50],
                        pageLength: 5,
                        destroy : true,
                        responsive: true,
                        processing: true,
                        serverSide: false,
                        autoWidth: false,
                        ajax: {
                            'url':'{!!url("getAvailMember")!!}',
                            'type': 'post',
                            data: {
                                '_token': '{{ csrf_token() }}',
                                'qTrainingID': qTrainingID,
                                'qTrainingType': qTrainingType,
                                'qEventID': qEventID
                            }
                        },
                        columns: [

                            {data: 'member_id', name: 'member_id'},
                            {data: 'member_id', name: 'member_id'},
                            // {data: 'ident_id', name: 'ident_id'},
                            {data: 'nama', name: 'nama'},
                            {data: 'phone', name: 'phone'},
                            // {data: 'alamat_ktp', name: 'alamat_ktp'},
                            {data: 'kota_ktp', name: 'kota_ktp'},
                            // {data: 'alamat_dom', name: 'alamat_dom'},
                            {data: 'provinsi_ktp', name: 'provinsi_ktp'},
                            // {data: 'jenis_kelamin', name: 'jenis_kelamin'},
                            // {data: 'pendidikan', name: 'pendidikan'},
                            // {data: 'job', name: 'job'},
                            // {data: 'position', name: 'position'},
                        ],
                        initComplete: function(settings, json) {

                            if (!dataTable3.rows().data().length) {

                                $.unblockUI();

                                

                                swal("whops","Tidak ada anggota yang tersedia untuk mengikuti pelatihan/sertifikasi", "error")
                            }

                            else {

                                $.unblockUI();

                                $("#modalSelMember").modal();

                                this.api().columns().every( function () {
                                    
                                    var that = this;

                                    $( 'input', this.footer() ).on( 'keyup change clear', function () {
                                        if ( that.search() !== this.value ) {
                                            that
                                                .search( this.value )
                                                .draw();
                                        }
                                    } );
                                });

                                
                            }
                        },

                    });


                }

                else {

                    $.unblockUI();

                    swal ("Whops", "Silahkan lengkapi dan simpan form isian Event dahulu", "error")


                }
                

            }
        });

    });

    $('#simpanPeserta').on('click', function() {

        event.preventDefault();

        blockUI();


        var rows_selected = dataTable3.column(0).checkboxes.selected();

        $.each(rows_selected, function(index, rowId){
        
            listMemberID = rows_selected.join(",")
        
        });

        $.ajax({
            type: "POST",
            url: "{{ url('saveEventDtl') }}",
            data: {
                '_token': '{{ csrf_token() }}',
                'id': listMemberID,
                'txtEventID': qEventID
            },
            success:function(data){


                if ((data['response']) == "Data sukses disimpan") {

                    $.unblockUI();

                    swal("Yeay", (data['response']), "success");

                    blockModal(block);

                    $('#ChooseMemberTable tfoot th').each( function () {
                        var title = $(this).text();
                        $(this).html( '<input type="text" class="form-control" placeholder="..." />' );
                    } );

                    dataTable3 = $('#ChooseMemberTable').DataTable({
                        "oLanguage": {
                            "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                            "sInfo": "Showing page _PAGE_ of _PAGES_",
                            "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                            "sSearchPlaceholder": "Search",
                            "sLengthMenu": "Show :  _MENU_ entries",
                        },
                        'columnDefs': [
                            {
                                'targets': 0,
                                'checkboxes': {
                                'selectRow': true
                                }
                            }
                        ],
                        'select': {
                            'style': 'multi'
                        },
                        order: [ [2, 'asc'] ],
                        stripeClasses: [],
                        lengthMenu: [5, 10, 20, 50],
                        pageLength: 5,
                        destroy : true,
                        responsive: true,
                        processing: true,
                        serverSide: false,
                        autoWidth: false,
                        ajax: {
                            'url':'{!!url("getAvailMember")!!}',
                            'type': 'post',
                            data: {
                                '_token': '{{ csrf_token() }}',
                                'qTrainingID': qTrainingID,
                                'qTrainingType': qTrainingType,
                                'qEventID': qEventID
                            }
                        },
                        columns: [

                            {data: 'member_id', name: 'member_id'},
                            {data: 'member_id', name: 'member_id'},
                            // {data: 'ident_id', name: 'ident_id'},
                            {data: 'nama', name: 'nama'},
                            {data: 'phone', name: 'phone'},
                            // {data: 'alamat_ktp', name: 'alamat_ktp'},
                            {data: 'kota_ktp', name: 'kota_ktp'},
                            // {data: 'alamat_dom', name: 'alamat_dom'},
                            {data: 'provinsi_ktp', name: 'provinsi_ktp'},
                            // {data: 'jenis_kelamin', name: 'jenis_kelamin'},
                            // {data: 'pendidikan', name: 'pendidikan'},
                            // {data: 'job', name: 'job'},
                            // {data: 'position', name: 'position'},
                        ],
                        initComplete: function(settings, json) {

                            if (!dataTable3.rows().data().length) {
                                
                                swal("whops","Tidak ada anggota yang tersedia untuk mengikuti pelatihan/sertifikasi", "error")
                            }

                            else {

                                $(block).unblock();

                                this.api().columns().every( function () {
                                    
                                    var that = this;

                                    $( 'input', this.footer() ).on( 'keyup change clear', function () {
                                        if ( that.search() !== this.value ) {
                                            that
                                                .search( this.value )
                                                .draw();
                                        }
                                    } );
                                } );

                                
                            }
                        },

                    });




                    listMemberEvent(qEventID);

                }
                else {

                    $.unblockUI();

                    swal("Whops", (data['response']), "error");
                }

            }
        });

        


    });

    $('body').on('click', '.delMemberEvent', function(e) {

        e.preventDefault();
        var txtEventID = $(this).data('id1');
        var txtMemberID = $(this).data('id2');
        var txtMemberName = $(this).data('id3');

        swal({
            title: "Apakah anda yakin",
            text: "Hapus "+txtMemberName+" dari event ini ?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Hapus',
            padding: '2em'
            }).then(function(result) {
                
                if (result.value) {
                    
                    $.ajax({
                        type: "POST",
                        url: "{{ url('deleteMemberEvent') }}",
                        data: {
                            '_token': '{{ csrf_token() }}',
                            'txtEventID': txtEventID,
                            'txtMemberID': txtMemberID
                            },
                            success: function(data) {
                                if ((data['response']) == 'Peserta berhasil dihapus dari event') {
                                    swal("Success", (data['response']), "success");
                                    listMemberEvent(qEventID);
                                }
                            
                                else {
                                    swal("Error", (data['response']), "error");
                                }
                            }
                    });

                }
            });
    



    });   

    $('body').on('click', '.editEvent', function(e) {

        blockUI();

        $('#DocTitle').text(html3);
        setEmpty1();

        $("#btnBack").show();
        $("#btnAddTrainee").hide();
        $("#btnFilter").hide();
        divTraineeTable.style.display = "none";
        traineeForm.style.display = "block";

        var txtEventID = $(this).data('id');

        setEmpty1();

        $.ajax({
            type: "POST",
            url: "{{ url('getEventHdr') }}",
            data: {
                '_token': '{{ csrf_token() }}',
                'txtEventID': txtEventID
            },
            success: function(data) {

                $.unblockUI();

                if (data.length > 0) {

                    $.each(data, function(index, element) {

                        qTrainingID = element.train_id;
                        qTrainingType = element.train_type_id;
                        qEventID = element.trx_id;
                        qStatus = element.stat;

                        $('#txtEventID').val(element.trx_id);
                        $('#txtEventName').val(element.descr);
                        $('#txtAgency').val(element.agency);
                        $('#txtAddress').val(element.address);
                        $('#txtCity').val(element.city);
                        $('#txtProv').val(element.prov);
                        $('#txtRemark').val(element.remark);

                        f1 = flatpickr(document.getElementById('txtDtTrx'), {
                            altInput: true,
                            altFormat: "d-m-Y",
                            dateFormat: "Y-m-d",
                            disableMobile: "true",
                            defaultDate : element.dt_trx
                        });

                        listOffice(element.office_id);
                        listTraining(element.train_id);

                        var block = $('#txtTrainingTypeLoading');
                        blockElement(block);

                        var checkTrainType = element.train_type_id;

                        // alert(checkTrainType);

                        $.ajax({
                            type: "GET",
                            dataType: "json",
                            url: "{{url('listTrainingType/id=')}}"+element.train_id,
                            success: function (data) {
                                $(block).unblock();
                                $('select[name="txtTrainingType"]').empty();
                                $('select[name="txtTrainingType"]').prepend('<option></option>');
                                $.each(data, function(index, element) {
                                    if  (element.train_type_id == checkTrainType ) {
                                        $('select[name="txtTrainingType"]').append('<option value="'+element.train_type_id+'" selected>'+element.descr+'</option>');
                                    }
                                    else {
                                        $('select[name="txtTrainingType"]').append('<option value="'+element.train_type_id+'">'+element.descr+'</option>');
                                    }
                                });
                            }
                        });

                        $('#txtTrainingType').select2({
                            placeholder: 'Pilih Training Tipe',
                            allowClear: true
                        });

                        listMemberEvent(element.trx_id);



                        


                    });


                      
                   



                }

                else {

                    swal("whops", "Data tidak ditemukan", "error")

                }
            }

                    
        });

        

    
    });
 
    $('#eventClosing').on('click', function() {


        event.preventDefault();

        blockUI();
		
        $.ajax({
            type: "POST",
            url: "{{ url('getExpiredDate') }}",
            data: {
                '_token': '{{ csrf_token() }}',
                'txtlistTrainingID' : qTrainingID,
                'txtlistTrainingType' : qTrainingType,
                'txtEventID': qEventID
            },
            success: function(data) {


                if (data.length > 0) {

                    $.each(data, function(index, element) {
						
		

                        $('#txtExpiredYear').val(element.year_expired);

                        f3 = flatpickr(document.getElementById('txtExpiredStart'), {
                            altInput: true,
                            altFormat: "d M Y",
                            dateFormat: "Y-m-d",
                            disableMobile: "true",
                            defaultDate : element.dt_finish
                        });

                        f4 = flatpickr(document.getElementById('txtExpiredEnd'), {
                            altInput: true,
                            altFormat: "d M Y",
                            dateFormat: "Y-m-d",
                            disableMobile: "true",
                            defaultDate : element.dt_expired
                        });


                    });

                }

                else {
					
					$('#txtExpiredYear').val('');

                    
                    f3 = flatpickr(document.getElementById('txtExpiredStart'), {
                            altInput: true,
                            altFormat: "d M Y",
                            dateFormat: "Y-m-d",
                            disableMobile: "true",
                    })
					
					f4 = flatpickr(document.getElementById('txtExpiredEnd'), {
                            altInput: true,
                            altFormat: "d M Y",
                            dateFormat: "Y-m-d",
                            disableMobile: "true",
                    })

                    

                }
            }

                    
        });


        $.ajax({
            type: "POST",
            url: "{{ url('checkTypeTraining') }}",
            data: {
                '_token': '{{ csrf_token() }}',
                'qTrainingID': qTrainingID,
                'qTrainingType' : qTrainingType
            },
            success: function(data) {


                if ((data['response']) == "Y") {

                formExpired.style.display = "block";

                txtTypeEvent = data['response'];

                dataTable4 = $('#ClosingTable').DataTable({
                    "oLanguage": {
                        "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                        "sInfo": "Showing page _PAGE_ of _PAGES_",
                        "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                        "sSearchPlaceholder": "Search",
                        "sLengthMenu": "Show :  _MENU_ entries",
                        },
                    select: {
                        style: 'multi',
                    },
                    scrollY: 300,
                    "paging":   false,
                    "info":     false,
                    order: [ [2, 'asc'] ],
                    stripeClasses: [],
                    // lengthMenu: [5, 10, 20, 50],
                    // pageLength: qtyMemberEvent,
                    destroy : true,
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    autoWidth: true,
                    ajax: {
                        'url':'{!!url("listMemberClosing")!!}',
                        'type': 'post',
                        data: {
                                '_token': '{{ csrf_token() }}',
                                'txtEventID': qEventID,
                                'type': txtTypeEvent,
                            }
                    },
                    columns: [

                        {data: 'stat', name: 'stat',orderable:false,searchable:false},
                        {data: 'member_id', name: 'member_id'},
                        {data: 'member_name', name: 'member_name'},
                        {data: 'city', name: 'city'},
                        {data: 'province', name: 'province'},
                        {data: 'phone', name: 'phone'}
                    ],
                    initComplete: function(settings, json) {

                        if (!dataTable4.rows().data().length) {

                            $.unblockUI();

                            swal("Whops", "Terjadi Kesalahan", "error");
                        }

                        else {


                            $.unblockUI();

                            $("#modalClosing").modal();

                            // alert(qqTrainingType)

                        }
                    },
                });


                }

                else {

                    formExpired.style.display = "none";
                    
                    txtTypeEvent = data['response'];

                    dataTable4 = $('#ClosingTable').DataTable({
                        "oLanguage": {
                            "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                            "sInfo": "Showing page _PAGE_ of _PAGES_",
                            "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                            "sSearchPlaceholder": "Search",
                            "sLengthMenu": "Show :  _MENU_ entries",
                            },
                        select: {
                            style: 'multi',
                        },
                        scrollY: 300,
                        "paging":   false,
                        "info":     false,
                        order: [ [2, 'asc'] ],
                        stripeClasses: [],
                        // lengthMenu: [5, 10, 20, 50],
                        // pageLength: qtyMemberEvent,
                        destroy : true,
                        responsive: true,
                        processing: true,
                        serverSide: true,
                        autoWidth: true,
                        ajax: {
                            'url':'{!!url("listMemberClosing")!!}',
                            'type': 'post',
                            data: {
                                    '_token': '{{ csrf_token() }}',
                                    'txtEventID': qEventID,
                                    'type': txtTypeEvent,
                                }
                        },
                        columns: [

                            {data: 'stat', name: 'stat',orderable:false,searchable:false},
                            {data: 'member_id', name: 'member_id'},
                            {data: 'member_name', name: 'member_name'},
                            {data: 'city', name: 'city'},
                            {data: 'province', name: 'province'},
                            {data: 'phone', name: 'phone'}
                        ],
                        initComplete: function(settings, json) {

                            if (!dataTable4.rows().data().length) {

                                $.unblockUI();

                                swal("Whops", "Terjadi Kesalahan", "error");
                            }

                            else {


                                $.unblockUI();

                                $("#modalClosing").modal();

                                

                                // alert(qqTrainingType)

                            }
                        },
                    });

                   

                    

                }
            }

                    
        });




    });    

    $('#simpanEventClosing').on('click', function() {

        var data = dataTable4.$('select').serializeArray();

        listMemberClosing = '';

        jQuery.each( data, function( i, field ) {
            
            listMemberClosing += field.value+","
    
        });

        listMemberClosing = listMemberClosing.slice(0, -1)


        var txtDtFinish = $('#txtExpiredStart').val()
        var txtYearExpired = $('#txtExpiredYear').val()
        var txtDtExpired = $('#txtExpiredEnd').val()

        if (txtTypeEvent == "Y") {

            if(!txtDtFinish) {

                swal("Whops", "Harap tanggal awal berlaku sertifikasi di isi", "error")

            }

            if(!txtYearExpired) {

                swal("Whops", "Harap tahun expired sertifikasi di isi", "error")
                
            }

            if(!txtDtExpired) {

                swal("Whops", "Harap tanggal akhir berlaku sertifikasi di isi", "error")
                
            }

            if (txtDtFinish && txtYearExpired && txtDtExpired) {
				
				blockUI();

                $.ajax({
                    type: "POST",
                    url: "{{ url('saveEventClosing') }}",
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'txtlistMemberClosing': listMemberClosing,
                        'txtlistTrainingID' : qTrainingID,
                        'txtlistTrainingType' : qTrainingType,
                        'txtEventID': qEventID,
                        'txtTypeEvent': txtTypeEvent,
                        'txtDtFinish' : txtDtFinish,
                        'txtYearExpired' : txtYearExpired,
                        'txtDtExpired' : txtDtExpired
                    },
                    success:function(data){

                        if (data['error']) {
                            

                            listMemberEvent(qEventID);
                            $.unblockUI();
                            swal("Whops", data['error'], "error")
                        }

                        else {

                            listMemberEvent(qEventID);
                            $.unblockUI();
                            swal("Sukses", "Closing Event berhasil", "success")
                        }

                    }
                });

            }

        }

        else {

			blockUI();

            $.ajax({
                type: "POST",
                url: "{{ url('saveEventClosing') }}",
                data: {
                    '_token': '{{ csrf_token() }}',
                    'txtlistMemberClosing': listMemberClosing,
                    'txtlistTrainingID' : qTrainingID,
                    'txtlistTrainingType' : qTrainingType,
                    'txtEventID': qEventID,
                    'txtTypeEvent': txtTypeEvent,
                    'txtDtFinish' : txtDtFinish,
                    'txtYearExpired' : txtYearExpired,
                    'txtDtExpired' : txtDtExpired
                },
                success:function(data){

                    if (data['error']) {

                        listMemberEvent(qEventID);
                        $.unblockUI();
                        swal("Whops", data['error'], "error")
                    }

                    else {


                        listMemberEvent(qEventID);
                        $.unblockUI();
                        swal("Sukses", "Closing Event berhasil", "success")
                    }

                }
            });

        }


        



    });




    





});
</script>

@endsection
{{-- Content Page JS End--}}
