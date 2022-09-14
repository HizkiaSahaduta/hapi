<div class="sidebar-wrapper sidebar-theme">

            <nav id="sidebar">
                <div class="shadow-bottom"></div>


                <ul class="list-unstyled menu-categories ps">
                    <li class="menu">
                        <a href="javascript:void(0);" id="homeNav" data-active="true" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle" onclick="window.location.href='{{ url("home") }}'">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                                <span>Beranda</span>
                            </div>
                            <div>
                                {{-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg> --}}
                            </div>
                        </a>
                    </li>

                    <li class="menu" id="Master">
                        <a href="#submenuMaster" data-toggle="collapse" class="dropdown-toggle" id="MasterNav">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layers"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
                                <span>Master</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="MasterTreeView collapse submenu list-unstyled" id="submenuMaster" data-parent="#submenuMaster">
                            @if(session()->has('mnuMasterPekerjaan'))
                            <li id='MasterPekerjaan'>
                                <a href="{{ route('MasterPekerjaan') }}">Pekerjaan</a>
                            </li>
                            @endif

                            @if(session()->has('mnuMasterOffice'))
                            <li id='MasterOffice'>
                                <a href="{{ route('MasterOffice') }}">Office</a>
                            </li>
                            @endif
                        </ul>
                    </li>

                    <li class="menu" id="MemberMgt">
                        <a href="#submenu1" data-toggle="collapse" class="dropdown-toggle" id="MemberMgtNav">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                                <span>Keanggotaan</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="MemberMgtTreeView collapse submenu list-unstyled" id="submenu1" data-parent="#submenu1">
                            @if(session()->has('mnuMemberMgt'))
                            <li id='MemberMgtSub'>
                                <a href="{{ url('MemberMgt') }}">Manajemen Anggota</a>
                            </li>
                            @endif
                            @if(session()->has('mnuMemberTrainee'))
                            <li id='MemberTrainee'>
                                <a href="{{ url('MemberTrainee') }}">Pelatihan dan Sertifikasi Anggota</a>
                            </li>
                            @endif
                            {{-- @if(session()->has('mnuMemberCert'))
                            <li id='MemberCert'>
                                <a href="{{ url('MemberCert') }}">Sertifikasi Anggota</a>
                            </li>
                            @endif --}}
                        </ul>
                    </li>

                    <li class="menu" id="UserMgmt">
                        <a href="#submenu2" data-toggle="collapse" class="dropdown-toggle" id="UserMgmtNav">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
                                <span>Manajemen User</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="UserMgmtTreeView collapse submenu list-unstyled" id="submenu2" data-parent="#submenu2">
                            @if(session()->has('mnuMyAccount'))
                            <li id='MyAccount'>
                                <a href="{{ url('MyAccount') }}">Akun Saya</a>
                            </li>
                            @endif
                            @if(session()->has('mnuChangePass'))
                            <li id='ChangePass'>
                                <a href="{{ url('ChangePass') }}">Ganti Password</a>
                            </li>
                            @endif
                            @if(session()->has('mnuAddUser'))
                            <li id='AddUser'>
                                <a href="{{ url('AddUser') }}">Tambah User</a>
                            </li>
                            @endif
                        </ul>
                    </li>


                    {{-- <li class="menu" id="MasterData">
                        <a href="#submenu3" data-toggle="collapse" class="dropdown-toggle" id="MasterDataNav">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-database"><ellipse cx="12" cy="5" rx="9" ry="3"></ellipse><path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"></path><path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"></path></svg>
                                <span>Master Data</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="MasterDataTreeView collapse submenu list-unstyled" id="submenu3" data-parent="#submenu3">
                            @if(session()->has('mnuMasterTraining'))
                            <li id='MasterTraining'>
                                <a href="{{ url('MasterTraining') }}">Master Training</a>
                            </li>
                            @endif
                            @if(session()->has('mnuMstTrainingType'))
                            <li id='MasterTrainingType'>
                                <a href="{{ url('MasterTrainingType') }}">Master Training Type</a>
                            </li>
                            @endif
                        </ul>
                    </li> --}}

                </ul>

            </nav>

        </div>
