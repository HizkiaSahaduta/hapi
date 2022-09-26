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
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Master</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><a href="{{ url('MasterPekerjaan') }}">Pekerjaan</a></li>
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
                            <h4>Master Pekerjaan</h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content-area">
                    <a href="javascript:void(0)" class="btn btn-dark mb-2" id="btnAddMaster">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                        Tambah Master Pekerjaan
                    </a>

                    <a href="javascript:void(0)" class="btn btn-dark mb-2" id="btnBack" style="display: none">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                        Kembali
                    </a>

                    <div class="table-responsive" id="divTableMember">
                        <table id="MasterTable" class="table mb-4" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Mill ID</th>
                                    <th>ID Pekerjaan</th>
                                    <th>Pekerjaan</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div id="masterForm" style="display: none">
                        <div class="row layout-top-spacing">
                            <div class="col-lg-3 layout-spacing layout-spacing">
                                <div class="form-row mb-6">
                                    <div class="form-group col-md-12">
                                        <label class="text-dark" for="txtMemberID">ID Pekerjaan</label>
                                        <input type="text" name="txtMemberID" id="txtMemberID" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 layout-spacing layout-spacing">
                                <div class="form-row mb-6">
                                    <div class="form-group col-md-12">
                                        <label class="text-dark" for="txtName">Pekerjaan</label>
                                        <input type="text" name="txtName" id="txtName" class="form-control" placeholder="Contoh: Swasta">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 layout-spacing layout-spacing">
                                <div class="form-row mb-6">
                                    <div class="form-group col-md-12">
                                        <label class="text-dark" for="txtStatus">Status</label>
                                        <select class="form-control basic" name="txtStatus" id="txtStatus">
                                            <option></option>
                                            <option value="Y">Aktif</option>
                                            <option value="N">Tidak Aktif</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row mb-6">
 
                            <button class="btn btn-dark btn-block" type="button" id="btnSave">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-save"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg>
                                Simpan Data 
                            </button> 

                        </div>
                    </div>
                </div>
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

function listMasterPekerjaan() {
    blockUI();

    var dataTable = $('#MasterTable').DataTable({
        "oLanguage": {
            "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
            "sInfo": "Showing page _PAGE_ of _PAGES_",
            "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
            "sSearchPlaceholder": "Search",
            "sLengthMenu": "Show :  _MENU_ entries",
            },
        // order: [ [0, 'desc'] ],
        stripeClasses: [],
        lengthMenu: [5, 10, 20, 50],
        pageLength: 10,
        destroy : true,
        responsive: true,
        processing: true,
        serverSide: true,
        autoWidth: false,
        ajax: {
            'url':'{!!url("listMasterPekerjaan")!!}',
            'type': 'post',
            data: {
                '_token': '{{ csrf_token() }}',
                'qTipeAnggota' : ''
            }
        },
        columns: [
            {data: 'mill_id', name: 'mill_id'},
            {data: 'id', name: 'id'},
            {data: 'pekerjaan', name: 'pekerjaan'},
            {data: 'active_flag', name: 'active_flag'},
            {data: 'Detail', name: 'Detail',orderable:false,searchable:false}
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

function getPekerjaanID(){

    $.ajax({
        type: "GET",
        url: "{{ url('getPekerjaanID') }}",
        success: function(data) {
            var id = 'P' + data['id']
            $('#txtMemberID').val(id);      
        }
    });

}

$(document).ready(function() {
    $('#homeNav').attr('data-active','false');
    $('#homeNav').attr('aria-expanded','false');
    $('#MasterNav').attr('data-active','true');
    $('#MasterNav').attr('aria-expanded','true');
    $('.MasterTreeView').addClass('show');
    $('#MasterPekerjaan').addClass('active');

    listMasterPekerjaan();getPekerjaanID();

    var divTableMember = document.getElementById("divTableMember");

    $('#btnAddMaster').on('click', function() {

        // setEmpty1();
        // getMemberID();

        $("#btnBack").show();
        $("#btnAddMaster").hide();
        divTableMember.style.display = "none";
        masterForm.style.display = "block";

    });

    $('#btnBack').on('click', function() {

        // setEmpty1();
        // getMemberID();

        $("#btnAddMaster").show();
        $("#btnBack").hide();
        divTableMember.style.display = "block";
        masterForm.style.display = "none";

        listMasterPekerjaan();

    });

    $('body').on('click', '.editMember', function(e) {
        blockUI();

        var txtMemberID = $(this).data('id');

        setId = txtMemberID;

        $.ajax({
            type: "POST",
            url: "{{ url('getDetailPekerjaan') }}",
            data: {
                '_token': '{{ csrf_token() }}',
                'txtMemberID': txtMemberID
            },
            success: function(data) {
                console.log(data);

                $('#txtMemberID').val(data.id);
                $('#txtName').val(data.pekerjaan);
                $('#txtStatus').val(data.active_flag);

                $("#btnBack").show();
                $("#btnAddMaster").hide();
                divTableMember.style.display = "none";
                masterForm.style.display = "block";

                $.unblockUI();

            }
        })
    });

    $('#btnSave').on('click', function() {
        txtMemberID = $('#txtMemberID').val();
        txtName = $('#txtName').val();
        txtStatus = $('#txtStatus').val();

        if (!txtName) {
            swal("Whoops", "Pekerjaan harus diisi", "error")
        }
        if (!txtStatus) {
            swal("Whoops", "Status Pekerjaan harus diisi", "error")
        }

        $.ajax({
            type: "POST",
            url: "{{ url('saveDataPekerjaan') }}",
            data: {
                '_token': '{{ csrf_token() }}',
                'txtMemberID': txtMemberID,
                'txtName': txtName,
                'txtStatus': txtStatus
            },
            success: function(data) {
                if ((data['response']) == "Data sukses disimpan") {
                    swal("Sukses", (data['response']), "success")
                        .then(function(){
                            swal("Info", "Data sukses disimpan", "info")
                        }
                    );
                    window.location.reload();
                }
                else if ((data['response']) == "Data sukses diperbaharui") {
                    swal("Sukses", (data['response']), "success");
                    window.location.reload();
                }
                else{
                    swal("Whops", (data['response']), "error");
                }
            }
        });
    })

});
</script>
@endsection