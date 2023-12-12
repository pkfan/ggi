<!DOCTYPE html>
<html lang="en">
<x-ic::head/>

<body>
    <x-ic::header/>
    <x-ic::sidebar/>
            <div class="app-content content ">
                 <div class="content-overlay"></div>
                    <div class="header-navbar-shadow"></div>
                        <div class="content-wrapper container-xxl p-0">
                            <div class="content-header row">
                                <div class="content-header-left col-md-9 col-12 mb-2">
                                    <div class="row breadcrumbs-top">
                                        <div class="col-12">
                                            <h2 class="content-header-title float-left mb-0">Request Form</h2>
                                            <div class="breadcrumb-wrapper">
                                                <ol class="breadcrumb">
                                                    <li class="breadcrumb-item"><a href="index.html">Home</a>
                                                    </li>
                                                    <li class="breadcrumb-item"><a href="#">IC</a>
                                                    </li>
                                                    <li class="breadcrumb-item active"><a href="#">Claims</a>
                                                    </li>
                                                    <li class="breadcrumb-item active"><a href="#">Add Claims</a>
                                                    </li>
                                                </ol>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                                    <div class="form-group breadcrumb-right">
                                        <div class="dropdown">
                                            <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="grid"></i></button>
                                            <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="app-todo.html"><i class="mr-1" data-feather="check-square"></i><span class="align-middle">Todo</span></a><a class="dropdown-item" href="app-chat.html"><i class="mr-1" data-feather="message-square"></i><span class="align-middle">Chat</span></a><a class="dropdown-item" href="app-email.html"><i class="mr-1" data-feather="mail"></i><span class="align-middle">Email</span></a><a class="dropdown-item" href="app-calendar.html"><i class="mr-1" data-feather="calendar"></i><span class="align-middle">Calendar</span></a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="content-body">
                                <section id="multiple-column-form">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4 class="card-title">ADD CLAIM REQUEST</h4>
                                                </div>
                                                <hr>
                                                <div class="card-header">
                                                    <h5>Please File Your Claim in Full Form</h5>
                                                </div>
                                                <div class="col-12 " , align = "center">
                                                    <a href = "{{url('ic/addclaim')}}"><button class="btn btn-primary mr-1">Full Form</button>
                                                </div>
                                                <h1><h1>
                                            </div>

                                        </div>
                                    </div>
                                </section>
                            </div>
                    </div>
                </div>
            </div>
    <x-ic::footer/>
</body>
</html>
