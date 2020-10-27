
@extends('layouts.body')

@section('css')
    <!-- Page -->
    <link rel="stylesheet" href="{{asset('dashboard_assets/quill/typography.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard_assets/quill/editor.css')}}">
@endsection

@section('contenido_page')
    <!-- [ Layout content ] Start -->
    <div class="layout-content">
        <!-- [ content ] Start -->
        <div class="container-fluid flex-grow-1 container-p-y">
            <h4 class="font-weight-bold py-3 mb-0">User Management</h4>
            <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i class="feather icon-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="#!">Membership</a></li>
                    <li class="breadcrumb-item active"><a href="#!">User Management</a></li>
                </ol>
            </div>
            <div class="row justify-content-center">
                <!-- liveline-section start -->
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="row align-items-center m-l-0">
                                <div class="col-sm-6 text-left">
                                    <h5>User Management</h5>
                                </div>
                                <div class="col-sm-6 text-right">
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-report"><i class="feather icon-plus"></i>New User</button>
                                </div>
                            </div>
                            <ul class="list-inline">
                                <li class="list-inline-item border-right m-0"><a href="#!" class="pr-2 pl-1 text-muted"> Sorting Options </a></li>
                                <li class="list-inline-item border-right m-0"><a href="#!" class="pr-2 pl-1 font-weight-bolder"> Reset </a></li>
                                <li class="list-inline-item border-right m-0"><a href="#!" class="pr-2 pl-1 text-muted"> Membership </a></li>
                                <li class="list-inline-item"><a href="#!" class="text-muted"> Username </a></li>
                            </ul>
                            <ul class="list-inline mb-0">
                                <li class="list-inline-item border-right m-0"><a href="#!" class="pr-2 pl-1 text-muted"> A </a></li>
                                <li class="list-inline-item border-right m-0"><a href="#!" class="pr-2 pl-1 text-muted"> B </a></li>
                                <li class="list-inline-item border-right m-0"><a href="#!" class="pr-2 pl-1 text-muted"> C </a></li>
                                <li class="list-inline-item border-right m-0"><a href="#!" class="pr-2 pl-1 text-muted"> D </a></li>
                                <li class="list-inline-item border-right m-0"><a href="#!" class="pr-2 pl-1 text-muted"> E </a></li>
                                <li class="list-inline-item border-right m-0"><a href="#!" class="pr-2 pl-1 text-muted"> F </a></li>
                                <li class="list-inline-item border-right m-0"><a href="#!" class="pr-2 pl-1 text-muted"> G </a></li>
                                <li class="list-inline-item border-right m-0"><a href="#!" class="pr-2 pl-1 text-muted"> H </a></li>
                                <li class="list-inline-item border-right m-0"><a href="#!" class="pr-2 pl-1 text-muted"> I </a></li>
                                <li class="list-inline-item border-right m-0"><a href="#!" class="pr-2 pl-1 text-muted"> J </a></li>
                                <li class="list-inline-item border-right m-0"><a href="#!" class="pr-2 pl-1 text-muted"> K </a></li>
                                <li class="list-inline-item border-right m-0"><a href="#!" class="pr-2 pl-1 text-muted"> L </a></li>
                                <li class="list-inline-item border-right m-0"><a href="#!" class="pr-2 pl-1 text-muted"> M </a></li>
                                <li class="list-inline-item border-right m-0"><a href="#!" class="pr-2 pl-1 text-muted"> N </a></li>
                                <li class="list-inline-item border-right m-0"><a href="#!" class="pr-2 pl-1 text-muted"> O </a></li>
                                <li class="list-inline-item border-right m-0"><a href="#!" class="pr-2 pl-1 text-muted"> P </a></li>
                                <li class="list-inline-item border-right m-0"><a href="#!" class="pr-2 pl-1 text-muted"> Q </a></li>
                                <li class="list-inline-item border-right m-0"><a href="#!" class="pr-2 pl-1 text-muted"> R </a></li>
                                <li class="list-inline-item border-right m-0"><a href="#!" class="pr-2 pl-1 text-muted"> S </a></li>
                                <li class="list-inline-item border-right m-0"><a href="#!" class="pr-2 pl-1 text-muted"> T </a></li>
                                <li class="list-inline-item border-right m-0"><a href="#!" class="pr-2 pl-1 text-muted"> U </a></li>
                                <li class="list-inline-item border-right m-0"><a href="#!" class="pr-2 pl-1 text-muted"> V </a></li>
                                <li class="list-inline-item border-right m-0"><a href="#!" class="pr-2 pl-1 text-muted"> W </a></li>
                                <li class="list-inline-item border-right m-0"><a href="#!" class="pr-2 pl-1 text-muted"> X </a></li>
                                <li class="list-inline-item border-right m-0"><a href="#!" class="pr-2 pl-1 text-muted"> Y </a></li>
                                <li class="list-inline-item border-right m-0"><a href="#!" class="pr-2 pl-1 text-muted"> Z </a></li>
                                <li class="list-inline-item"><a href="#!" class="font-weight-bolder"> All </a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card user-card user-card-1 mt-4">
                        <div class="card-body">
                            <div class="user-about-block text-center">
                                <div class="row align-items-start">
                                    <div class="col text-left pb-3">
                                        <span class="badge badge-success">Active</span>
                                    </div>
                                    <div class="col"><img class="img-radius img-fluid wid-80" src="assets/img/user/avatar-2.jpg" alt="User image"></div>
                                    <div class="col text-right pb-3">
                                        <div class="dropdown">
                                            <a class="drp-icon dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-more-horizontal"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="#">Edit</a>
                                                <a class="dropdown-item" href="#">History</a>
                                                <a class="dropdown-item" href="#">Trash</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <a href="#!" data-toggle="modal" data-target="#modal-report">
                                    <h4 class="mb-1 mt-3">Andrew Burns</h4>
                                </a>
                                <p class="mb-3 text-muted"><i class="feather icon-calendar"> </i> 19 Jul 2016</p>
                                <p class="mb-1"><b>Email : </b><a href="mailto:dummy@example.com">andrew.burns@example.com</a></p>
                                <p class="mb-0"><b>Membership : </b>Platinum <span class="badge badge-warning">member</span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card user-card user-card-1 mt-4">
                        <div class="card-body">
                            <div class="user-about-block text-center">
                                <div class="row align-items-start">
                                    <div class="col text-left pb-3">
                                        <span class="badge badge-success">Active</span>
                                    </div>
                                    <div class="col"><img class="img-radius img-fluid wid-80" src="assets/img/user/avatar-3.jpg" alt="User image"></div>
                                    <div class="col text-right pb-3">
                                        <div class="dropdown">
                                            <a class="drp-icon dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-more-horizontal"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="#">Edit</a>
                                                <a class="dropdown-item" href="#">History</a>
                                                <a class="dropdown-item" href="#">Trash</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <a href="#!" data-toggle="modal" data-target="#modal-report">
                                    <h4 class="mb-1 mt-3">Keith Butler</h4>
                                </a>
                                <p class="mb-3 text-muted"><i class="feather icon-calendar"> </i> 27 Apr 2016</p>
                                <p class="mb-1"><b>Email : </b><a href="mailto:dummy@example.com">Keith.butler@example.com</a></p>
                                <p class="mb-0"><b>Membership : </b>TRIAL <span class="badge badge-warning">member</span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card user-card user-card-1 mt-4">
                        <div class="card-body">
                            <div class="user-about-block text-center">
                                <div class="row align-items-start">
                                    <div class="col text-left pb-3">
                                        <span class="badge badge-success">Active</span>
                                    </div>
                                    <div class="col"><img class="img-radius img-fluid wid-80" src="assets/img/user/avatar-4.jpg" alt="User image"></div>
                                    <div class="col text-right pb-3">
                                        <div class="dropdown">
                                            <a class="drp-icon dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-more-horizontal"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="#">Edit</a>
                                                <a class="dropdown-item" href="#">History</a>
                                                <a class="dropdown-item" href="#">Trash</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <a href="#!" data-toggle="modal" data-target="#modal-report">
                                    <h4 class="mb-1 mt-3">Christina Bowman</h4>
                                </a>
                                <p class="mb-3 text-muted"><i class="feather icon-calendar"> </i> 17 Apr 2016</p>
                                <p class="mb-1"><b>Email : </b><a href="mailto:dummy@example.com">Christina.Bowman@example.com</a></p>
                                <p class="mb-0"><b>Membership : </b>- <span class="badge badge-primary">staff</span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card user-card user-card-1 mt-4">
                        <div class="card-body">
                            <div class="user-about-block text-center">
                                <div class="row align-items-start">
                                    <div class="col text-left pb-3">
                                        <span class="badge badge-danger">Banned</span>
                                    </div>
                                    <div class="col"><img class="img-radius img-fluid wid-80" src="assets/img/user/avatar-1.jpg" alt="User image"></div>
                                    <div class="col text-right pb-3">
                                        <div class="dropdown">
                                            <a class="drp-icon dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-more-horizontal"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="#">Edit</a>
                                                <a class="dropdown-item" href="#">History</a>
                                                <a class="dropdown-item" href="#">Trash</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <a href="#!" data-toggle="modal" data-target="#modal-report">
                                    <h4 class="mb-1 mt-3">Kelly Montgomery</h4>
                                </a>
                                <p class="mb-3 text-muted"><i class="feather icon-calendar"> </i> 23 Mar 2016</p>
                                <p class="mb-1"><b>Email : </b><a href="mailto:dummy@example.com">Kelly.Montgomery@example.com</a></p>
                                <p class="mb-0"><b>Membership : </b>Bronze <span class="badge badge-warning">member</span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card user-card user-card-1 mt-4">
                        <div class="card-body">
                            <div class="user-about-block text-center">
                                <div class="row align-items-start">
                                    <div class="col text-left pb-3">
                                        <span class="badge badge-dark">Pending</span>
                                    </div>
                                    <div class="col"><img class="img-radius img-fluid wid-80" src="assets/img/user/avatar-2.jpg" alt="User image"></div>
                                    <div class="col text-right pb-3">
                                        <div class="dropdown">
                                            <a class="drp-icon dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-more-horizontal"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="#">Edit</a>
                                                <a class="dropdown-item" href="#">History</a>
                                                <a class="dropdown-item" href="#">Trash</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <a href="#!" data-toggle="modal" data-target="#modal-report">
                                    <h4 class="mb-1 mt-3">Steve Castillo</h4>
                                </a>
                                <p class="mb-3 text-muted"><i class="feather icon-calendar"> </i> 23 Mar 2016</p>
                                <p class="mb-1"><b>Email : </b><a href="mailto:dummy@example.com">Steve.Castillo@example.com</a></p>
                                <p class="mb-0"><b>Membership : </b>GOLD <span class="badge badge-warning">member</span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card user-card user-card-1 mt-4">
                        <div class="card-body">
                            <div class="user-about-block text-center">
                                <div class="row align-items-start">
                                    <div class="col text-left pb-3">
                                        <span class="badge badge-info">Inactive</span>
                                    </div>
                                    <div class="col"><img class="img-radius img-fluid wid-80" src="assets/img/user/avatar-3.jpg" alt="User image"></div>
                                    <div class="col text-right pb-3">
                                        <div class="dropdown">
                                            <a class="drp-icon dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-more-horizontal"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="#">Edit</a>
                                                <a class="dropdown-item" href="#">History</a>
                                                <a class="dropdown-item" href="#">Trash</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <a href="#!" data-toggle="modal" data-target="#modal-report">
                                    <h4 class="mb-1 mt-3">Kenneth Hart</h4>
                                </a>
                                <p class="mb-3 text-muted"><i class="feather icon-calendar"> </i> 25 Dec 2015</p>
                                <p class="mb-1"><b>Email : </b><a href="mailto:dummy@example.com">Steve.Castillo@example.com</a></p>
                                <p class="mb-0"><b>Membership : </b>BRONZE <span class="badge badge-warning">member</span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card user-card user-card-1 mt-4">
                        <div class="card-body">
                            <div class="user-about-block text-center">
                                <div class="row align-items-start">
                                    <div class="col text-left pb-3">
                                        <span class="badge badge-success">Active</span>
                                    </div>
                                    <div class="col"><img class="img-radius img-fluid wid-80" src="assets/img/user/avatar-2.jpg" alt="User image"></div>
                                    <div class="col text-right pb-3">
                                        <div class="dropdown">
                                            <a class="drp-icon dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-more-horizontal"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="#">Edit</a>
                                                <a class="dropdown-item" href="#">History</a>
                                                <a class="dropdown-item" href="#">Trash</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <a href="#!" data-toggle="modal" data-target="#modal-report">
                                    <h4 class="mb-1 mt-3">Henry Reyes</h4>
                                </a>
                                <p class="mb-3 text-muted"><i class="feather icon-calendar"> </i> 19 Jan 2016</p>
                                <p class="mb-1"><b>Email : </b><a href="mailto:dummy@example.com">Henry.Reyes@example.com</a></p>
                                <p class="mb-0"><b>Membership : </b>- <span class="badge badge-danger">editor</span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card user-card user-card-1 mt-4">
                        <div class="card-body">
                            <div class="user-about-block text-center">
                                <div class="row align-items-start">
                                    <div class="col text-left pb-3">
                                        <span class="badge badge-danger">Banned</span>
                                    </div>
                                    <div class="col"><img class="img-radius img-fluid wid-80" src="assets/img/user/avatar-3.jpg" alt="User image"></div>
                                    <div class="col text-right pb-3">
                                        <div class="dropdown">
                                            <a class="drp-icon dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-more-horizontal"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="#">Edit</a>
                                                <a class="dropdown-item" href="#">History</a>
                                                <a class="dropdown-item" href="#">Trash</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <a href="#!" data-toggle="modal" data-target="#modal-report">
                                    <h4 class="mb-1 mt-3">Adam Dean</h4>
                                </a>
                                <p class="mb-3 text-muted"><i class="feather icon-calendar"> </i> 27 Oct 2015</p>
                                <p class="mb-1"><b>Email : </b><a href="mailto:dummy@example.com">Adam.Dean@example.com</a></p>
                                <p class="mb-0"><b>Membership : </b>TRIAL <span class="badge badge-warning">member</span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- liveline-section end -->
            </div>
        </div>
        <!-- [ content ] End -->
        <!-- [ Layout footer ] Start -->
        <nav class="layout-footer footer footer-light">
            <div class="container-fluid d-flex flex-wrap justify-content-between text-center container-p-x pb-3">
                <div class="pt-3">
                    <span class="float-md-right d-none d-lg-block">&copy; Exclusive on Themeforest | Hand-crafted &amp; Made with <i class="fas fa-heart text-danger mr-2"></i></span>
                </div>
                <div>
                    <a href="javascript:" class="footer-link pt-3">About Us</a>
                    <a href="javascript:" class="footer-link pt-3 ml-4">Help</a>
                    <a href="javascript:" class="footer-link pt-3 ml-4">Contact</a>
                    <a href="javascript:" class="footer-link pt-3 ml-4">Terms &amp; Conditions</a>
                </div>
            </div>
        </nav>
        <!-- [ Layout footer ] End -->
    </div>
    <!-- [ Layout content ] Start -->
@endsection


@section('script')

@endsection
