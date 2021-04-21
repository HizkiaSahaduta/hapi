@extends('main')

{{-- Content Page CSS Begin--}}
@section('contentcss')


<link href="{{ asset('outside/plugins/table/datatable/datatables.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('outside/plugins/table/datatable/dt-global_style.css') }}" rel="stylesheet" type="text/css">
<link href="https://cdn.datatables.net/responsive/2.2.4/css/responsive.dataTables.min.css" rel="stylesheet"/>
<link href="{{ asset('outside/assets/css/components/custom-modal.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('outside/plugins/notification/snackbar/snackbar.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('outside/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('outside/plugins/flatpickr/flatpickr.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('outside/assets/css/forms/theme-checkbox-radio.css') }}" rel="stylesheet" type="text/css" >
<link href="{{ asset('outside/assets/css/components/custom-media_object.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('outside/assets/css/forms/switches.css') }}" rel="stylesheet" type="text/css">
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

.badge-info {
  color: #2196f3;
  border: 2px dashed #2196f3; }

.table > thead > tr > th {
  color: #ffffff;
  font-weight: 700;
  font-size: 13px;
  letter-spacing: 1px;
  text-transform: uppercase;
  background : #373a40;  
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
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Master Data</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><a href="{{ url('MasterTraining') }}">Master Training</a></li>
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
                    <a href="javascript:void(0)" class="btn btn-dark mb-2" id="btnAddTraining">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                        Tambah Training
                    </a>
                    <a href="javascript:void(0)" class="btn btn-dark mb-2" id="btnBack" style="display: none">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                        Kembali
                    </a>
                    <div class="table-responsive" id="divTableTraining">
                        <table id="Training" class="table mb-4" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Training ID</th>
                                    <th>Description</th>
                                    <th>DtCreate</th>
                                    <th>DtModified</th>
                                    <th>CreatedBy</th>
                                    <th>Act</th>
                                </tr>
                            </thead>
                        </table>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>


<!-- Modal -->

<div class="modal fade" id="addTraining" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content" id="modalLoad">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Training</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <div class="modal-body">



                <form method="post" id="saveTraining">
                    @csrf

                    <div class="row layout-top-spacing">
                        <div class="col-lg-12 layout-spacing layout-spacing">

                            <div class="form-row mb-6">
                                <div class="form-group col-md-5 col-5">
                                    <label class="text-dark" for="txtTrainingID">Training ID</label>
                                    <input type="text" name="txtTrainingID" id="txtTrainingID" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-row mb-6">
                                <div class="form-group col-md-10 col-10">
                                    <label class="text-dark" for="txtDescr">Deskripsi</label>
                                    <input type="text" name="txtDescr" id="txtDescr" class="form-control">
                                </div>
                            </div> 
                        </div>
                        
                    </div>

            </div>
            <div class="modal-footer">
                <button class="btn btn-dark"  type="submit">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-save"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg>
                    Simpan
                </button> 
            </form>

                <button class="btn" data-dismiss="modal">
                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                Tutup</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editTraining" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content" id="modalLoad">
            <div class="modal-header">
                <h4 class="modal-title">Edit Training</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <div class="modal-body">



                <form method="post" id="editTraining">
                    @csrf

                    <div class="row layout-top-spacing">
                        <div class="col-lg-12 layout-spacing layout-spacing">

                            <div class="form-row mb-6">
                                <div class="form-group col-md-10">
                                    <label class="text-dark" for="txtTrainingIDEdit">Training ID</label>
                                    <input type="text" name="txtTrainingIDEdit" id="txtTrainingIDEdit" class="form-control">
                                </div>
                            </div>

                            <div class="form-row mb-6">
                                <div class="form-group col-md-10">
                                    <label class="text-dark" for="txtDescrEdit">Deskripsi</label>
                                    <input type="text" name="txtDescrEdit" id="txtDescrEdit" class="form-control">
                                </div>
                            </div>

                            <div class="form-row mb-6">
                                <button class="btn btn-dark btn-block"  type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-save"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg>
                                    Perbarui Data
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

function getTrainingID(){

    $.ajax({
        type: "GET",
        url: "{{ url('getTrainingID') }}",
        success: function(data) {

            var id = data['train_id'];

            $('#txtTrainingID').val(id);      
        }
    });
}

$(document).ready(function() {

    $('#homeNav').attr('data-active','false');
    $('#homeNav').attr('aria-expanded','false');
    $('#MMasterDataNav').attr('data-active','true');
    $('#MasterDataNav').attr('aria-expanded','true');
    $('.MasterDataTreeView').addClass('show');
    $('#MasterTraining').addClass('active');


    $('#btnAddTraining').on('click', function() {

        getTrainingID();

        $('#txtDescr').val('');

        $("#addTraining").modal();


    }); 

    var dataTable = $('#Training').DataTable({
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
            'url':'{!!url("listTraining")!!}',
            'type': 'post',
            'headers': {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        },
        columns: [
            {data: 'train_id', name: 'train_id'},
            {data: 'descr', name: 'descr'},
            {data: 'dt_created', name: 'dt_created'},
            {data: 'dt_modified', name: 'dt_modified'},
            {data: 'user_id', name: 'user_id'},
            {data: 'Act', name: 'Act',orderable:false,searchable:false},
        ],
        initComplete: function(settings, json) {

            if (!dataTable.rows().data().length) {

                swal("Whops", "Data not available", "error");
            }
        },
    });

    $('#saveTraining').on('submit', function(event){
        
        event.preventDefault();

        var txtTrainingID = $('#txtTrainingID').val();
        var txtDescr = $('#txtDescr').val();

        if (!txtTrainingID) {
            swal("Whoops", "Training ID harus diisi", "error")
        }
        if (!txtDescr) {
            swal("Whoops", "Deskripsi training harus diisi", "error")
        }

        if (txtTrainingID && txtDescr){

            $.ajax({
                url: "{{ url('saveTraining') }}",
                method:"POST",
                data:new FormData(this),
                dataType:'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success:function(data){

                    if ((data['response']) == "Data sukses disimpan") {
                        swal("Sukses", (data['response']), "success");

                        $("#addTraining").modal('hide')

                        $('#Training').DataTable().ajax.url("{{url('listTraining')}}").load();

                    }
                    else {
                        swal("Whops", (data['response']), "error");
                    }
            
                }
            });

        }
        
    });

     $('body').on('click', '.editTraining', function(e) {

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

    

});


</script>

@endsection
{{-- Content Page JS End--}}
