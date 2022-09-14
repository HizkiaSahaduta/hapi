@extends('main')

{{-- Content Page CSS Begin--}}
@section('contentcss')
<link href="{{ asset('outside/plugins/table/datatable/datatables.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('outside/plugins/table/datatable/dt-global_style.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.4/css/responsive.dataTables.min.css" />
<link href="{{ asset('outside/assets/css/elements/infobox.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('outside/plugins/notification/snackbar/snackbar.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('outside/assets/css/components/custom-modal.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@latest/dist/plugins/monthSelect/style.css">
<link href="{{ asset('outside/plugins/flatpickr/flatpickr.css') }}" rel="stylesheet" type="text/css">

<style>
.flatpickr-input[readonly] {
    cursor: pointer;
    background-color: transparent !important;
    max-width: 125px;
    float: right;
}
.widget-content-area {
  box-shadow: none !important; }

.widget-one {
    background: transparent;
}

.info {
    margin-bottom: 10px !important;
}

.border-bottom {
    border-bottom: 1px solid #dee2e6 !important;
}

h6 {
    color: #fff !important;
}

.scroll-area-md {
    height: 100px;
    overflow-x: hidden;
}

.shadow-overflow {
    position: relative;
}

.scrollbar-container {
    position: relative;
    height: 100%
}

.list-group {
    color: #fff !important;
    border-radius: 5 !important;
}

.list-group-item {
    background: #5797fb !important;
    color: #fff !important;
}

.modal-dialog {
    max-width: 1200px;
    margin: 1.75rem auto;
}

@media (max-width: 991px) {

    .widget-account-invoice-two .account-box p {
        font-size: 10px;
    }
	
	.row [class*="col-"] .widget .widget-header h4 {
		font-size: 14px;
   
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
                            <li class="breadcrumb-item active"><a href="javascript:void(0);">Beranda</a></li>
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

       
        <div class="col-lg-2 layout-spacing layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4 class="m-0">Total Anggota</h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">

                    <div id="chartContainer1" style="height: 370px; width: 100%;"></div>

                </div>
            </div>
        </div>

        <div class="col-lg-5 layout-spacing layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4 class="m-0">Aplikator Per Wilayah/Kota</h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">

                    <div id="chartContainer2" style="height: 370px; width: 100%;"></div>

                </div>
            </div>
        </div>

        <div class="col-lg-5 layout-spacing layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4 class="m-0">Anggota - Terlatih & Tersertifikasi</h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">

                    <div id="chartContainer3" style="height: 370px; width: 100%;"></div>

                </div>
            </div>
        </div>

        <div class="col-lg-6 layout-spacing layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4 class="m-0">Jumlah Pelatihan & Sertifikasi</h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">

                    <div id="chartContainer4" style="height: 370px; width: 100%;"></div>

                </div>
            </div>
        </div>

        <div class="col-lg-6 layout-spacing layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4 class="m-0">Jumlah Peserta Pelatihan & Sertifikasi</h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">

                    <div id="chartContainer5" style="height: 370px; width: 100%;"></div>

                </div>
            </div>
        </div>

        <div class="col-lg-6 layout-spacing layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row mt-2">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <div class="d-flex">
                                <h4 class="mr-auto">Total Anggota Penuh & Afiliasi HAPI (KORDA)</h4>
                                <input id="start" class="form-control flatpickr flatpickr-input active" type="text" placeholder="Period" style="max-width: 125px;">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">

                    <div id="chartContainerKorda" style="height: 370px; width: 100%;"></div>

                </div>
            </div>
        </div>

        <div class="col-lg-6 layout-spacing layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row mt-2">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <div class="d-flex">
                                <input id="period_sertificate" class="form-control flatpickr flatpickr-input active " type="text" placeholder="Period" style="max-width: 125px;">
                                <h4 class="ml-auto">Total Anggota Tersertifikasi (KORDA)</h4>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">

                    <div id="chartContainerKordaSertifikasi" style="height: 370px; width: 100%;"></div>

                </div>
            </div>
        </div>

        <div class="col-lg-6 layout-spacing layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row mt-2">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <div class="d-flex">
                                <h4 class="mr-auto">Top 5 Anggota (KORDA)</h4>
                                <input id="period_top_korda" class="form-control flatpickr flatpickr-input active" type="text" placeholder="Period" style="max-width: 125px;">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    <div class="table-responsive">
                        <table class="table align-middle table-sm">
                          <thead>
                            <tr>
                              <th>Status Anggota</th>
                              <th>Kota</th>
                              <th class="text-center">Total Anggota</th>
                            </tr>
                          </thead>
                          <tbody id="listTop5AnggotaKorda">
                          </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 layout-spacing layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row mt-2">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <div class="d-flex">
                                <input id="period_top_sertificate" class="form-control flatpickr flatpickr-input active" type="text" placeholder="Period" style="max-width: 125px;">
                                <h4 class="ml-auto">Top 5 Anggota tersertifikasi (KORDA)</h4>
                                

                            </div>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    <div class="table-responsive">
                        <table class="table align-middle table-sm">
                          <thead>
                            <tr>
                              <th>Status Anggota</th>
                              <th>Kota</th>
                              <th class="text-center">Total Anggota</th>
                            </tr>
                          </thead>
                          <tbody id="listTop5AnggotaSertifikasi">
                          </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div id="headerModal"></div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <div class="modal-body">



                <div id="Cstep1" style="display: none">
                    <div class="table-responsive">
                        <table id="Member" class="table mb-4" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID Anggota</th>
                                    <th>Tipe Anggota</th>
                                    <th>Nama</th>
                                    <th>Prov (Dom)</th>
                                    <th>Kota (Dom)</th>
                                    <th>Status</th>
                                    <th>Tanggal Bergabung</th>
                                    <th>Pelatihan</th>
                                    <th>Sertifikasi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>   
                </div>  

                <div id="Cstep2" style="display: none">
                    <div class="widget-content widget-content-area">
                        <div id="chartContainer7" style="height: 200px; width: 100%;"></div>
                    </div>
                    <div class="table-responsive">
                        <table id="Member2" class="table mb-4" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID Anggota</th>
                                    <th>Tipe Anggota</th>
                                    <th>Nama</th>
                                    <th>Prov (Dom)</th>
                                    <th>Kota (Dom)</th>
                                    <th>Status</th>
                                    <th>Tanggal Bergabung</th>
                                    <th>Pelatihan</th>
                                    <th>Sertifikasi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>   
                </div>  

                <div id="Cstep3" style="display: none">
                    <div class="table-responsive">
                        <table id="Member3" class="table mb-4" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID Anggota</th>
                                    <th>Tipe Anggota</th>
                                    <th>Nama</th>
                                    <th>Prov (Dom)</th>
                                    <th>Kota (Dom)</th>
                                    <th>Status</th>
                                    <th>Tanggal Bergabung</th>
                                    <th>Pelatihan</th>
                                    <th>Sertifikasi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>   
                </div>  

                <div id="Cstep4" style="display: none">
                    <div class="table-responsive">
                        <table id="Trainee" class="table mb-4" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Event ID</th>
                                    <th>Kantor Cabang</th>
                                    <th>Tanggal Penyelenggaraan</th>
                                    <th>Status</th>
                                    <th>Peserta</th>
                                    <th>Jenis</th>
                                    <th>Nama</th>
                                    <th>Keterangan</th>
                                    <th>Penyelenggara</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>  


                <div id="Cstep5" style="display: none">
                    <div class="widget-content widget-content-area">
                        <div id="chartContainer6" style="height: 200px; width: 100%;"></div>
                    </div>
                    <div class="table-responsive">
                        <table id="TraineeDtl" class="table mb-4" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Event ID</th>
                                    <th>Kantor Cabang</th>
                                    <th>Tanggal Penyelenggaraan</th>
                                    <th>Jenis</th>
                                    <th>Nama</th>
                                    <th>ID Anggota</th>
                                    <th>Tipe Anggota</th>
                                    <th>Status</th>
                                    <th>Nama Anggota</th>
                                    <th>Prov (Dom)</th>
                                    <th>Kota (Dom)</th>
                                    <th>Telp</th>
                                </tr>
                            </thead>
                        </table>
                    </div>   
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

@endsection
{{-- Content Page End--}}

{{-- Content Page JS Begin--}}
@section('contentjs')
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.4/js/dataTables.responsive.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.10/flatpickr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr@latest/dist/plugins/monthSelect/index.js"></script>
<script src="{{ asset('outside/plugins/notification/snackbar/snackbar.min.js') }}"></script>
<script src="{{ asset('outside/plugins/blockui/jquery.blockUI.min.js') }}"></script>
<script src="{{ asset('canvasjs.min.js') }}"></script>
@if(\Session::has('success'))
    <script>
        var success = "{{ Session::get('success') }}"
        Snackbar.show({
            text: success,
            pos: 'top-center'
        });

    </script>
@endif

<script type="text/javascript">

var x = window.matchMedia("(max-width: 991px)")

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

function addSymbols(e) {
	var suffixes = ["", "K", "M", "B"];
	var order = Math.max(Math.floor(Math.log(e.value) / Math.log(1000)), 0);

	if(order > suffixes.length - 1)
		order = suffixes.length - 1;

	var suffix = suffixes[order];
	return CanvasJS.formatNumber(e.value / Math.pow(1000, order)) + suffix;
}

function toggleDataSeries(e) {
	if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	} else {
		e.dataSeries.visible = true;
	}
	e.chart.render();
}

function toggleDataPointVisibility(e) {
	if(e.dataPoint.hasOwnProperty("actualYValue") && e.dataPoint.actualYValue !== null) {
    e.dataPoint.y = e.dataPoint.actualYValue;
    e.dataPoint.actualYValue = null;
    e.dataPoint.indexLabelFontSize = null;
    e.dataPoint.indexLabelLineThickness = null;
    e.dataPoint.legendMarkerType = "circle";
  } 
  else {
    e.dataPoint.actualYValue = e.dataPoint.y;
    e.dataPoint.y = 0;
    e.dataPoint.indexLabelFontSize = 0;
    e.dataPoint.indexLabelLineThickness = 0; 
    e.dataPoint.legendMarkerType = "cross";
  }
	e.chart.render();
}

function showDefaultText(chart, text) {
  var dataPoints = chart.options.data[0].dataPoints;
  var isEmpty = !(dataPoints && dataPoints.length > 0);

  if (!isEmpty) {
    for (var i = 0; i < dataPoints.length; i++) {
      isEmpty = !dataPoints[i].y;
      if (!isEmpty)
        break;
    }
  }

  if (!chart.options.subtitles)
    chart.options.subtitles = [];
  if (isEmpty) {
    chart.options.subtitles.push({
      text: text,
      verticalAlign: 'center',
    });
    chart.options.data[0].showInLegend = false;
  } else {
    chart.options.data[0].showInLegend = false;
  }
}

function getPieChart(title, label, dp, container){
    var pie_chart = new CanvasJS.Chart(container, {
	    animationEnabled: true,
        title: {
            text: title,
            fontFamily: "Calibri",
            fontSize: 20
        },
        subtitles:[
            {
                text: label,
                fontFamily: "Calibri",
                fontColor: "red",
                fontSize: 12
            }
        ],
        exportEnabled: true,
        theme: "light2",
        exportEnabled: true,
		legend: {
			itemclick: toggleDataPointVisibility
		},
        data: [{

            type: "pie",
            click: onClick1,
            percentFormatString: "#0.##",
            indexLabel: "{label} #percent%",
            indexLabelFontSize: 12,
			showInLegend: true

        }]
    });
    pie_chart.options.data[0].dataPoints = dp;
    // showDefaultText(pie_chart, "No Data Found!");

    if (x.matches) {

        for(var i = 0; i < pie_chart.options.data.length; i++){
            pie_chart.options.data[i].indexLabelFontSize = 8;
        }
        pie_chart.render();
    }
    pie_chart.render();
}

function getChartStacked(title, label, dp, dp_penuh, container){
    console.log(dp, dp_penuh);
    var chart = new CanvasJS.Chart(container, 
                {
                    animationEnabled: true,
                    title: {
                        text: title
                    },
                    subtitles:[
                        {
                            text: label,
                            fontFamily: "Calibri",
                            fontColor: "red",
                            fontSize: 12
                        }
                    ],
                    axisX: {
                        title : "KORDA",
                        includeZero: false
                    },
                    axisY: {
                        title : "(Total)",
                    },
                    exportEnabled: true,
                    toolTip: {
                        shared: true,
                        content: toolTipContent,
                        enabled: true
                    },
                    data: [
                        {        
                            type: "stackedColumn",
                            showInLegend: true,
                            name: "Penuh",
                            color: "#ff2e17",
                            dataPoints: dp
                        },
                        {
                            type: "stackedColumn",
                            showInLegend: true,
                            color: "#1b3098",
                            name: "Afiliasi",
                            dataPoints: dp_penuh
                        },
                    ]
                });
    chart.render();
}

function toolTipContent(e) {
    var str = "";
	var total = 0;
	var str2, str3;
	for (var i = 0; i < e.entries.length; i++){
		var  str1 = "<span style= \"color:"+e.entries[i].dataSeries.color + "\"> "+e.entries[i].dataSeries.name+"</span>: <strong>"+e.entries[i].dataPoint.y+"</strong><br/>";
		total = e.entries[i].dataPoint.y + total;
		str = str.concat(str1);
	}
	str2 = "<span style = \"color:DodgerBlue;\"><strong>"+(e.entries[0].dataPoint.label)+"</strong></span><br/>";
    // str2 = "<span>"+e.entries[i].dataSeries.label+"</span>";
	total = Math.round(total * 100) / 100;
	str3 = "<span style = \"color:Tomato\">Total:</span><strong>"+total+"</strong><br/>";
	return (str2.concat(str)).concat(str3);
}

function getChart1(title, label, dp, type, container, click){
    var chart = new CanvasJS.Chart(container, {
	    animationEnabled: true,
        exportEnabled: true,
        theme: "light2",
        title: {
            text: title,
            fontFamily: "Calibri",
            fontSize: 20
        },
        subtitles:[
            {
                text: label,
                fontFamily: "Calibri",
                fontColor: "red",
                fontSize: 12
            }
        ],
        exportEnabled: true,
        axisY: {
            crosshair: {
			    enabled: true,
                snapToDataPoint: true
		    },
            title: "Jumlah Aplikator",
            labelFormatter: addSymbols,
        },
        toolTip:{
		    shared:true
	    },
        legend: {
            cursor: "pointer",
            itemclick: toggleDataSeries
	    },
        data: [
            {
                type: type,
                click: click,
                name: "Aplikator",
                showInLegend: true,
                indexLabel: "{y}",
                indexLabelPlacement: "outside",
                // indexLabelOrientation: "vertical",
                // indexLabelFontColor: "#fff",
                indexLabelFontWeight: "bold",
                indexLabelFontSize: 12,
                indexLabelFontFamily: "calibri",
                color: "#00b7c2"
            }
        ]
    });
    chart.options.data[0].dataPoints = dp;
    // showDefaultText(chart, "No Data Found!");

    if (x.matches) {

        for(var i = 0; i < chart.options.data.length; i++){
            chart.options.data[i].indexLabelFontSize = 8;
        }
        chart.render();
    }
    chart.render();
}

function getChart2(title, label, sublabel, dp1, dp2, type1, type2, name1, name2, f1, f2, container){
    var chart = new CanvasJS.Chart(container, {
	    animationEnabled: true,
        exportEnabled: true,
        theme: "light2",
        title: {
            text: title,
            fontFamily: "Calibri",
            fontSize: 20
        },
        subtitles:[
            {
                text: label,
                fontFamily: "Calibri",
                fontColor: "red",
                fontSize: 12
            }
        ],
        exportEnabled: true,
        axisY: {
            crosshair: {
			    enabled: true,
                snapToDataPoint: true
		    },
            title: sublabel,
            labelFormatter: addSymbols,
        },
        toolTip:{
		    shared:true
	    },
        legend: {
            cursor: "pointer",
            itemclick: toggleDataSeries
	    },
        data: [
            {
                type: type1,
                click: f1,
                name: name1,
                showInLegend: true,
                indexLabel: "{y}",
                indexLabelPlacement: "outside",
                // indexLabelOrientation: "vertical",
                // indexLabelFontColor: "#fff",
                indexLabelFontWeight: "bold",
                indexLabelFontSize: 12,
                indexLabelFontFamily: "calibri",
                color: "#00b7c2"
            },
            {
                type: type2,
                click: f2,
                name: name2,
                showInLegend: true,
                indexLabel: "{y}",
                indexLabelPlacement: "outside",
                // indexLabelOrientation: "vertical",
                // indexLabelFontColor: "#fff",
                indexLabelFontWeight: "bold",
                indexLabelFontSize: 12,
                indexLabelFontFamily: "calibri",
                color: "#b52b65"
            }
        ]
    });
    chart.options.data[0].dataPoints = dp1;
    chart.options.data[1].dataPoints = dp2;
    // showDefaultText(chart, "No Data Found!");

    if (x.matches) {

        for(var i = 0; i < chart.options.data.length; i++){
            chart.options.data[i].indexLabelFontSize = 8;
        }
        chart.render();
    }
    chart.render();
}

function initDashboard() {

    blockUI();

    $.ajax({
        type: "POST",
        url: "{{ url('getDashboard') }}",
        data: {
            '_token': '{{ csrf_token() }}',
        },
        success: function(data) {

            //Jumlah total anggota penuh & afiliasi (mungkin dijadikan satu diagram, dengan 2 tipe anggota)

                if (data['total_anggota'].length > 0) { 

                    var dp = [];

                    for (var i = 0; i < data['total_anggota'].length; i++) {

                        dp.push({ label: data['total_anggota'][i].tipe_anggota, y: parseFloat(data['total_anggota'][i].jml_anggota), legendText: data['total_anggota'][i].tipe_anggota });
                    }

                    getPieChart('Total: '+data['total'], '', dp, 'chartContainer1')
                }

                else if (data['total_anggota'].length < 1 ) {

                    var dp = [];
                    dp.push({ y: 0 });
                    getPieChart('', '', dp, 'chartContainer1')

                }


            
            //Jumlah aplikator per wilayah / per kota 

                if (data['anggota_per_wilayah'].length > 0) { 

                    var dp = [];

                    for (var i = 0; i < data['anggota_per_wilayah'].length; i++) {

                        dp.push({ label: data['anggota_per_wilayah'][i].province1, y: parseFloat(data['anggota_per_wilayah'][i].jml_aplikator) });
                    }

                    getChart1('', 'by Provinsi (Domisili)', dp, 'line', 'chartContainer2', onClick2)
                }

                else if (data['anggota_per_wilayah'].length < 1 ) {

                    var dp = [];
                    dp.push({ y: 0 });
                    getChart1('', 'by Provinsi (Domisili)', dp, 'line', 'chartContainer2', onClick2)

                }

            //Jumlah aplikator yang telah mengikuti pelatihan & tersertifikasi (mungkin bisa dijadikan satu diagram, dengan 2 tipe anggota)

                if (data['pelatihan_sertifikasi_penuh'].length > 0 && data['pelatihan_sertifikasi_afiliasi'].length > 0) { 

                    var dp1 = [], dp2 = [];

                    for (var i = 0; i < data['pelatihan_sertifikasi_penuh'].length; i++) {

                        dp1.push({ label: data['pelatihan_sertifikasi_penuh'][i].keterangan, y: parseFloat(data['pelatihan_sertifikasi_penuh'][i].val) });
                    }

                    for (var i = 0; i < data['pelatihan_sertifikasi_afiliasi'].length; i++) {

                        dp2.push({ label: data['pelatihan_sertifikasi_afiliasi'][i].keterangan, y: parseFloat(data['pelatihan_sertifikasi_afiliasi'][i].val) });
                    
                    }

                    getChart2('', 'Aplikator yang telah mengikuti: ', 'Jumlah Aplikator', dp1, dp2, 'spline', 'spline', 'Anggota Penuh', 'Anggota Afiliasi', onClick3_1, onClick3_2, 'chartContainer3')
                }

                else if (data['pelatihan_sertifikasi_penuh'].length < 1 && data['pelatihan_sertifikasi_afiliasi'].length < 1) { 

                    var dp1 = [], dp2 = [];
                    dp1.push({ y: 0 });
                    dp2.push({ y: 0 });
                    getChart2('', 'Aplikator yang telah mengikuti: ', 'Jumlah Aplikator', dp1, dp2, 'spline', 'spline', 'Anggota Penuh', 'Anggota Afiliasi', onClick3_1, onClick3_2, 'chartContainer3')

                }

            //Jumlah Pelatihan & Sertifikasi Bulanan/Tahunan

            
                if (data['jml_pelatihan'].length > 0 && data['jml_sertifikasi'].length > 0) { 

                    var dp1 = [], dp2 = [];

                    for (var i = 0; i < data['jml_pelatihan'].length; i++) {

                        dp1.push({ label: data['jml_pelatihan'][i].Periode, y: parseFloat(data['jml_pelatihan'][i].val) });
                    }

                    for (var i = 0; i < data['jml_sertifikasi'].length; i++) {

                        dp2.push({ label: data['jml_sertifikasi'][i].Periode, y: parseFloat(data['jml_sertifikasi'][i].val) });
                    
                    }

                    getChart2('', 'periode (bulan dan tahun)', 'Jumlah Pelatihan/Sertifikasi', dp1, dp2, 'line', 'line', 'Pelatihan', 'Sertifikasi', onClick4_1, onClick4_2, 'chartContainer4')
                }

                else if (data['jml_pelatihan'].length < 1 && data['jml_sertifikasi'].length < 1) { 

                    var dp1 = [], dp2 = [];
                    dp1.push({ y: 0 });
                    dp2.push({ y: 0 });
                    getChart2('', 'periode (bulan dan tahun)', 'Jumlah Pelatihan/Sertifikasi', dp1, dp2, 'line', 'line', 'Pelatihan', 'Sertifikasi', onClick4_1, onClick4_2, 'chartContainer4')

                }


            //Jumlah Peserta Pelatihan & Sertifikasi Bulanan/Tahunan


                if (data['peserta_pelatihan'].length > 0 && data['peserta_sertifikasi'].length > 0) { 

                    var dp1 = [], dp2 = [];

                    for (var i = 0; i < data['peserta_pelatihan'].length; i++) {

                        dp1.push({ label: data['peserta_pelatihan'][i].Periode, y: parseFloat(data['peserta_pelatihan'][i].val) });
                    }

                    for (var i = 0; i < data['peserta_sertifikasi'].length; i++) {

                        dp2.push({ label: data['peserta_sertifikasi'][i].Periode, y: parseFloat(data['peserta_sertifikasi'][i].val) });
                    
                    }

                    getChart2('', 'periode (bulan dan tahun)', 'Jumlah Peserta Pelatihan/Sertifikasi', dp1, dp2, 'line', 'line', 'Pelatihan', 'Sertifikasi', onClick5_1, onClick5_2, 'chartContainer5')
                }

                else if (data['peserta_pelatihan'].length < 1 && data['peserta_sertifikasi'].length < 1) { 

                    var dp1 = [], dp2 = [];
                    dp1.push({ y: 0 });
                    dp2.push({ y: 0 });
                    getChart2('', 'periode (bulan dan tahun)', 'Jumlah Peserta Pelatihan/Sertifikasi', dp1, dp2, 'line', 'line', 'Pelatihan', 'Sertifikasi', onClick5_1, onClick5_2, 'chartContainer5')

                }
        
        $.unblockUI();
        
        
        }
    });
}

function getListAnggotaKorda(period) {

    $.ajax({
        type: "POST",
        url: "{{ url('getListAnggotaKorda') }}",
        data: {
            '_token': '{{ csrf_token() }}',
            period: period
        },
        success: function(data) {

            // console.log(data.datas);

            var dp = [];
            var dp_penuh = [];

            var office_penuh = [];
            var office_afiliasi = [];

            var name = ''
            var st_anggota = ''

            for (var i = 0; i < data.datas.length; i++) {
                
                if (name == data.datas[i].office_name) {
                    // console.log(data.datas[i].office_name, data.datas[i].st_anggota, i);
                    var index = i - 1;
                    // console.log(index);
                    // console.log(dp[index]);
                    // if (index !== -1) {
                    dp[index] = {label: data.datas[i].office_name, y: parseFloat(data.datas[i].total_anggota), st_anggota: data.datas[i].st_anggota};
                    // }
                    // console.log(dp[index]);

                } else {
                    name = data.datas[i].office_name;
                    st_anggota = data.datas[i].st_anggota;

                    if (data.datas[i].st_anggota == 'Anggota Penuh') {
                        dp.push({ label: data.datas[i].office_name, y: parseFloat(data.datas[i].total_anggota), st_anggota: data.datas[i].st_anggota });
                        dp_penuh.push({ label: data.datas[i].office_name, y: 0, st_anggota: 'Anggota Afiliasi' });
                    }

                    if (data.datas[i].st_anggota == 'Anggota Afiliasi') {
                        dp.push({ label: data.datas[i].office_name, y: 0, st_anggota: 'Anggota Penuh'});
                        dp_penuh.push({ label: data.datas[i].office_name, y: parseFloat(data.datas[i].total_anggota), st_anggota: data.datas[i].st_anggota });
                    }
                }
                
            }

            // merge = dp.concat(dp_penuh);

            // console.log(dp, dp_penuh);

            getChartStacked('', 'Total Anggota Penuh & Afiliasi HAPI (KORDA)', dp, dp_penuh, 'chartContainerKorda')

        }
    });
}

function getListAnggotaKordaSertifikasi(period) {

    $.ajax({
        type: "POST",
        url: "{{ url('getListAnggotaKordaTersertifikasi') }}",
        data: {
            '_token': '{{ csrf_token() }}',
            period: period
        },
        success: function(data) {
            console.log(data.datas);

            var dp = [];
            var dp_penuh = [];

            var office_penuh = [];
            var office_afiliasi = [];

            var name = ''
            var st_anggota = ''

            for (var i = 0; i < data.datas.length; i++) {
                
                if (name == data.datas[i].city) {
                    // console.log(data.datas[i].city, data.datas[i].st_anggota, i);
                    var index = i - 1;
                    // console.log(index);
                    // console.log(dp[index]);
                    // if (index !== -1) {
                    dp[index] = {label: data.datas[i].city, y: parseFloat(data.datas[i].total_anggota), st_anggota: data.datas[i].st_anggota};
                    // }
                    // console.log(dp[index]);

                } else {
                    name = data.datas[i].city;
                    st_anggota = data.datas[i].st_anggota;

                    if (data.datas[i].st_anggota == 'Anggota Penuh') {
                        dp.push({ label: data.datas[i].city, y: parseFloat(data.datas[i].total_anggota), st_anggota: data.datas[i].st_anggota });
                        dp_penuh.push({ label: data.datas[i].city, y: 0, st_anggota: 'Anggota Afiliasi' });
                    }

                    if (data.datas[i].st_anggota == 'Anggota Afiliasi') {
                        dp.push({ label: data.datas[i].city, y: 0, st_anggota: 'Anggota Penuh'});
                        dp_penuh.push({ label: data.datas[i].city, y: parseFloat(data.datas[i].total_anggota), st_anggota: data.datas[i].st_anggota });
                    }
                }
                
            }

            getChartStacked('', 'Total Anggota Tersertifikasi (KORDA)', dp, dp_penuh, 'chartContainerKordaSertifikasi')

        }
    });
}

function getlistTop5AnggotaSertifikasi(period) {

    $.ajax({
        type: "POST",
        url: "{{ url('listTop5AnggotaSertifikasi') }}",
        data: {
            '_token': '{{ csrf_token() }}',
            period: period
        },
        success: function(data) {
            console.log(period);
            if (period == undefined) {
                var rows = '';
                $.each(data.datas, function(index, item) {
                    rows += '<tr><td>' + item.st_anggota + '</td><td>' + item.city + '</td><td class="text-center">' + item.total_anggota + '</td></tr>';
                });
                $('#listTop5AnggotaSertifikasi').html(rows);
                
            } else{
                $('#listTop5AnggotaSertifikasi').html('');

                var rows = '';
                $.each(data.datas, function(index, item) {
                    rows += '<tr><td>' + item.st_anggota + '</td><td>' + item.city + '</td><td class="text-center">' + item.total_anggota + '</td></tr>';
                });
                $('#listTop5AnggotaSertifikasi').html(rows);
                
            }
            
        }
    });

}

function getlistTop5AnggotaKorda(period) {

    $.ajax({
        type: "POST",
        url: "{{ url('listTop5AnggotaKorda') }}",
        data: {
            '_token': '{{ csrf_token() }}',
            period: period
        },
        success: function(data) {
            console.log(period);
            if (period == undefined) {
                var rows = '';
                $.each(data.datas, function(index, item) {
                    rows += '<tr><td>' + item.st_anggota + '</td><td>' + item.office_name + '</td><td class="text-center">' + item.total_anggota + '</td></tr>';
                });
                $('#listTop5AnggotaKorda').html(rows);
                
            } else{
                $('#listTop5AnggotaKorda').html('');

                var rows = '';
                $.each(data.datas, function(index, item) {
                    rows += '<tr><td>' + item.st_anggota + '</td><td>' + item.office_name + '</td><td class="text-center">' + item.total_anggota + '</td></tr>';
                });
                $('#listTop5AnggotaKorda').html(rows);
                
            }
            
        }
    });

}

function onClick1(e){

    var param = e.dataPoint.label
    $("#headerModal").html('<h4>Daftar '+param+'</h4>')
    $('#detailModal').modal('show');
    document.getElementById("Cstep1").style.display = "block";
    document.getElementById("Cstep2").style.display = "none";
    document.getElementById("Cstep3").style.display = "none";
    document.getElementById("Cstep4").style.display = "none";  
    document.getElementById("Cstep5").style.display = "none";   


    listMemberTable(param);


}

function onClick2(e){

    var param = e.dataPoint.label
    $("#headerModal").html('<h4>Daftar Anggota Domisili '+param+'</h4>')
    $('#detailModal').modal('show');
    document.getElementById("Cstep1").style.display = "none";
    document.getElementById("Cstep2").style.display = "block";
    document.getElementById("Cstep3").style.display = "none";
    document.getElementById("Cstep4").style.display = "none";  
    document.getElementById("Cstep5").style.display = "none";  
    
    $.ajax({
        type: "POST",
        url: "{{ url('chartCityPerProv') }}",
        data: {
            '_token': '{{ csrf_token() }}',
            'qProv' : param
        },
        success: function(data) {

         
            if (data.length > 0) { 

                var dp = [];

                for (var i = 0; i < data.length; i++) {

                    dp.push({ label: data[i].city1, y: parseFloat(data[i].jml_aplikator)});
                }

                getChart1('', '', dp, 'column', 'chartContainer7', '')
            }

            else  {

                var dp = [];
                dp.push({ y: 0 });
                getChart1('', '', dp, 'column', 'chartContainer7', '')

            }
        }
    });

    listMemberTable2(param);


}

function onClick3_1(e){

    var param = e.dataPoint.label
    var type = 'Anggota Penuh';
    $("#headerModal").html('<h4>Daftar Anggota Penuh Yang Mengikuti '+param+'</h4>')
    $('#detailModal').modal('show');
    document.getElementById("Cstep1").style.display = "none";
    document.getElementById("Cstep2").style.display = "none";
    document.getElementById("Cstep3").style.display = "block";
    document.getElementById("Cstep4").style.display = "none";  
    document.getElementById("Cstep5").style.display = "none";   

    listMemberTable3(param, type);


}

function onClick3_2(e){

    var param = e.dataPoint.label
    var type = 'Anggota Afiliasi';
    $("#headerModal").html('<h4>Daftar Anggota Afiliasi Yang Mengikuti '+param+'</h4>')
    $('#detailModal').modal('show');
    document.getElementById("Cstep1").style.display = "none";
    document.getElementById("Cstep2").style.display = "none";
    document.getElementById("Cstep3").style.display = "block";
    document.getElementById("Cstep4").style.display = "none";  
    document.getElementById("Cstep5").style.display = "none";   

    listMemberTable3(param, type);


}

function onClick4_1(e){

    var param = e.dataPoint.label
    var type = '01';
    $("#headerModal").html('<h4>Daftar Pelatihan Periode '+param+'</h4>')
    $('#detailModal').modal('show');
    document.getElementById("Cstep1").style.display = "none";
    document.getElementById("Cstep2").style.display = "none";
    document.getElementById("Cstep3").style.display = "none";
    document.getElementById("Cstep4").style.display = "block";  
    document.getElementById("Cstep5").style.display = "none";   
    
    listTraineeTable(param, type)


}

function onClick4_2(e){

    var param = e.dataPoint.label
    var type = '02';
    $("#headerModal").html('<h4>Daftar Sertifikasi Periode '+param+'</h4>')
    $('#detailModal').modal('show');
    document.getElementById("Cstep1").style.display = "none";
    document.getElementById("Cstep2").style.display = "none";
    document.getElementById("Cstep3").style.display = "none";
    document.getElementById("Cstep4").style.display = "block";  
    document.getElementById("Cstep5").style.display = "none";   
    
    listTraineeTable(param, type)


}

function onClick5_1(e){

    var param = e.dataPoint.label
    var type = '01';
    $("#headerModal").html('<h4>Daftar Peserta Pelatihan Periode '+param+'</h4>')
    $('#detailModal').modal('show');
    document.getElementById("Cstep1").style.display = "none";
    document.getElementById("Cstep2").style.display = "none";
    document.getElementById("Cstep3").style.display = "none";
    document.getElementById("Cstep4").style.display = "none";  
    document.getElementById("Cstep5").style.display = "block";   

    $.ajax({
        type: "POST",
        url: "{{ url('chartDtlTraineePeriodic') }}",
        data: {
            '_token': '{{ csrf_token() }}',
            'qPeriode' : param,
            'qTrainingID' : type
        },
        success: function(data) {

         
            if (data.length > 0) { 

                var dp = [];

                for (var i = 0; i < data.length; i++) {

                    dp.push({ label: data[i].st_anggota, y: parseFloat(data[i].jml_peserta)});
                }

                getChart1('', '', dp, 'column', 'chartContainer6')
            }

            else  {

                var dp = [];
                dp.push({ y: 0 });
                getChart1('', '', dp, 'column', 'chartContainer6')

            }
        }
    });
    
    listDtlTraineeTable(param, type)


}

function onClick5_2(e){

    var param = e.dataPoint.label
    var type = '02';
    $("#headerModal").html('<h4>Daftar Peserta Sertifikasi Periode '+param+'</h4>')
    $('#detailModal').modal('show');
    document.getElementById("Cstep1").style.display = "none";
    document.getElementById("Cstep2").style.display = "none";
    document.getElementById("Cstep3").style.display = "none";
    document.getElementById("Cstep4").style.display = "none";  
    document.getElementById("Cstep5").style.display = "block";   


    $.ajax({
        type: "POST",
        url: "{{ url('chartDtlTraineePeriodic') }}",
        data: {
            '_token': '{{ csrf_token() }}',
            'qPeriode' : param,
            'qTrainingID' : type
        },
        success: function(data) {

         
            if (data.length > 0) { 

                var dp = [];

                for (var i = 0; i < data.length; i++) {

                    dp.push({ label: data[i].st_anggota, y: parseFloat(data[i].jml_peserta)});
                }

                getChart1('', '', dp, 'column', 'chartContainer6','')
            }

            else  {

                var dp = [];
                dp.push({ y: 0 });
                getChart1('', '', dp, 'column', 'chartContainer6','')

            }
        }
    });
    
    listDtlTraineeTable(param, type)


}

function listMemberTable(param) {

    blockUI();

    var dataTable = $('#Member').DataTable({
        "oLanguage": {
            "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
            "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
            "sSearchPlaceholder": "Search",
            "sLengthMenu": "Show :  _MENU_ entries",
            },
        // order: [ [0, 'desc'] ],
        stripeClasses: [],
        lengthMenu: [5, 10, 20, 50],
        pageLength: 5,
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
                    'qTipeAnggota' : param
                }
        },
        columns: [
            {data: 'member_id', name: 'member_id'},
            {data: 'st_anggota', name: 'st_anggota'},
            {data: 'member_name', name: 'member_name'},
            // {data: 'province', name: 'province'},
            // {data: 'city', name: 'city'},
            {data: 'province1', name: 'province1'},
            {data: 'city1', name: 'city1'},
            {data: 'active_flag', name: 'active_flag'},
            {data: 'dt_created', name: 'dt_created'},
            {data: 'st_pelatihan', name: 'st_pelatihan'},
            {data: 'st_bnsp', name: 'st_bnsp'}
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

function listMemberTable2(param) {

    blockUI();

    var dataTable = $('#Member2').DataTable({
        "oLanguage": {
            "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
            "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
            "sSearchPlaceholder": "Search",
            "sLengthMenu": "Show :  _MENU_ entries",
            },
        // order: [ [0, 'desc'] ],
        stripeClasses: [],
        lengthMenu: [5, 10, 20, 50],
        pageLength: 5,
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
                    'qProv' : param
                }
        },
        columns: [
            {data: 'member_id', name: 'member_id'},
            {data: 'st_anggota', name: 'st_anggota'},
            {data: 'member_name', name: 'member_name'},
            // {data: 'province', name: 'province'},
            // {data: 'city', name: 'city'},
            {data: 'province1', name: 'province1'},
            {data: 'city1', name: 'city1'},
            {data: 'active_flag', name: 'active_flag'},
            {data: 'dt_created', name: 'dt_created'},
            {data: 'st_pelatihan', name: 'st_pelatihan'},
            {data: 'st_bnsp', name: 'st_bnsp'}
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

function listMemberTable3(param, type) {

    blockUI();

    var dataTable = $('#Member3').DataTable({
        "oLanguage": {
            "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
            "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
            "sSearchPlaceholder": "Search",
            "sLengthMenu": "Show :  _MENU_ entries",
            },
        // order: [ [0, 'desc'] ],
        stripeClasses: [],
        lengthMenu: [5, 10, 20, 50],
        pageLength: 5,
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
                    'qTipeAnggota' : type,
                    'qTrainee': param
                }
        },
        columns: [
            {data: 'member_id', name: 'member_id'},
            {data: 'st_anggota', name: 'st_anggota'},
            {data: 'member_name', name: 'member_name'},
            // {data: 'province', name: 'province'},
            // {data: 'city', name: 'city'},
            {data: 'province1', name: 'province1'},
            {data: 'city1', name: 'city1'},
            {data: 'active_flag', name: 'active_flag'},
            {data: 'dt_created', name: 'dt_created'},
            {data: 'st_pelatihan', name: 'st_pelatihan'},
            {data: 'st_bnsp', name: 'st_bnsp'}
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

function listTraineeTable(param, type){

    blockUI();

    var dataTable = $('#Trainee').DataTable({
        "oLanguage": {
            "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
            "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
            "sSearchPlaceholder": "Search",
            "sLengthMenu": "Show :  _MENU_ entries",
            },
        // order: [ [1, 'asc'] ],
        stripeClasses: [],
        lengthMenu: [5, 10, 20, 50],
        pageLength: 5,
        destroy : true,
        responsive: true,
        processing: true,
        serverSide: true,
        autoWidth: false,
        ajax: {
            'url':'{!!url("listTraineePeriodic")!!}',
            'type': 'post',
            data: {
                    '_token': '{{ csrf_token() }}',
                    'qPeriode' : param,
                    'qTrainingID' : type
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
            {data: 'agency', name: 'agency'},
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

function listDtlTraineeTable(param, type){

    blockUI();

    var dataTable = $('#TraineeDtl').DataTable({
        "oLanguage": {
            "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
            "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
            "sSearchPlaceholder": "Search",
            "sLengthMenu": "Show :  _MENU_ entries",
            },
        // order: [ [1, 'asc'] ],
        stripeClasses: [],
        lengthMenu: [5, 10, 20, 50],
        pageLength: 5,
        destroy : true,
        responsive: true,
        processing: true,
        serverSide: true,
        autoWidth: false,
        ajax: {
            'url':'{!!url("listDtlTraineePeriodic")!!}',
            'type': 'post',
            data: {
                    '_token': '{{ csrf_token() }}',
                    'qPeriode' : param,
                    'qTrainingID' : type
                }
        },
        columns: [
            {data: 'trx_id', name: 'trx_id'},
            {data: 'office_name', name: 'office_name'},
            {data: 'dt_trx', name: 'dt_trx'},
            {data: 'descr_mst_training', name: 'descr_mst_training'},
            {data: 'descr_mst_training_type', name: 'descr_mst_training_type'},
            {data: 'member_id', name: 'member_id'},
            {data: 'st_anggota', name: 'st_anggota'},
            {data: 'stat', name: 'stat'},
            {data: 'member_name', name: 'member_name'},
            {data: 'prov_dom', name: 'prov_dom'},
            {data: 'city_dom', name: 'city_dom'},
            {data: 'phone', name: 'phone'}
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

    
    initDashboard();
    getListAnggotaKorda();
    getListAnggotaKordaSertifikasi();
    getlistTop5AnggotaSertifikasi();
    getlistTop5AnggotaKorda();

    var f1 = flatpickr(document.getElementById('start'), {
        static: true,
        altInput: true,
        plugins: [new monthSelectPlugin({shorthand: false, dateFormat: "Ym", altFormat: "Ym"})],
        disableMobile: "true",
    });

    var f2 = flatpickr(document.getElementById('period_sertificate'), {
        static: true,
        altInput: true,
        plugins: [new monthSelectPlugin({shorthand: false, dateFormat: "Ym", altFormat: "Ym"})],
        disableMobile: "true",
    });

    var f3 = flatpickr(document.getElementById('period_top_sertificate'), {
        static: true,
        altInput: true,
        plugins: [new monthSelectPlugin({shorthand: false, dateFormat: "Ym", altFormat: "Ym"})],
        disableMobile: "true",
    });

    var f4 = flatpickr(document.getElementById('period_top_korda'), {
        static: true,
        altInput: true,
        plugins: [new monthSelectPlugin({shorthand: false, dateFormat: "Ym", altFormat: "Ym"})],
        disableMobile: "true",
    });

    

    $( "#start" ).change(function() {
        var period = $('#start').val()
        getListAnggotaKorda(period)
    });
    

    $( "#period_sertificate" ).change(function() {
        var period = $('#period_sertificate').val()
        getListAnggotaKordaSertifikasi(period)
    });

    $( "#period_top_sertificate" ).change(function() {
        var period = $('#period_top_sertificate').val()
        getlistTop5AnggotaSertifikasi(period)
    });

    $( "#period_top_korda" ).change(function() {
        var period = $('#period_top_korda').val()
        getlistTop5AnggotaKorda(period)
    });

});

</script>



@endsection
{{-- Content Page JS End--}}