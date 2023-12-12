<!DOCTYPE html>
<html lang="en">
<x-ic::head/>
<body>
    <style>
        .chat-content-leftside {
    text-align: left;
}

.chat-content-rightside {
    text-align: right;
}

.chat-time {
    font-size: 12px;
    color: #999;
    margin-bottom: 5px;
}

.chat-left-msg {
    background-color: #F2F2F2;
    padding: 10px;
    border-radius: 10px;
    display: inline-block;
}

.chat-right-msg {
    background-color: #DCF8C6;
    padding: 10px;
    border-radius: 10px;
    display: inline-block;
}
</style>
<x-ic::header/>
<x-ic::sidebar/>
<div class="app-content content chat-application">
        @if(session()->has('success'))
            <div id="toast-container" class="toast-container toast-top-right">
                <div class="toast toast-success" aria-live="polite" style>
                    <button type="button" class="toast-close-button" role="button">×</button>
                    <div class="toast-title">👋{{session('success')}}!</div>
                    <div class="toast-message">You have successfully regostered your claim.</div>
                </div>
            </div>
        @endif
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Comments</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">IC</a>
                                    </li>
                                    <li class="breadcrumb-item active"><a href="#">Claims</a>
                                    </li>
                                    <li class="breadcrumb-item active"><a href="#">Comments</a>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    <!-- BEGIN: Content-->
        <div class="content-area-wrapper container-xxl p-0">
            <div class="sidebar-left">
                <div class="sidebar">
                    <!-- Admin user profile area -->
                    <div class="chat-profile-sidebar">
                        <header class="chat-profile-header">
                            <span class="close-icon">
                                <i data-feather="x"></i>
                            </span>
                            <!-- User Information -->
                            <div class="header-profile-sidebar">
                                <div class="avatar box-shadow-1 avatar-xl avatar-border">
                                    <img src="../../../app-assets/images/portrait/small/avatar-s-11.jpg" alt="user_avatar" />
                                    <span class="avatar-status-online avatar-status-xl"></span>
                                </div>
                                <h4 class="chat-user-name">John Doe</h4>
                                <span class="user-post">Admin</span>
                            </div>
                            <!--/ User Information -->
                        </header>

                    </div>
                    <!--/ Admin user profile area -->

                    <!-- Chat Sidebar area -->
                    <div class="sidebar-content">
                        <span class="sidebar-close-icon">
                            <i data-feather="x"></i>
                        </span>
                        <!-- Sidebar header start -->
                        <div class="chat-fixed-search">
                            <div class="d-flex align-items-center w-100">
                                <div class="sidebar-profile-toggle">
                                    <div class="avatar avatar-border">
                                        <img src="../../../app-assets/images/portrait/small/avatar-s-11.jpg" alt="user_avatar" height="42" width="42" />
                                        <span class="avatar-status-online"></span>
                                    </div>
                                </div>
                                <div class="input-group input-group-merge ml-1 w-100">
                                    {{getCompanyById(Auth::user()->company_id)->name}}
                                </div>
                            </div>
                        </div>
                        <!-- Sidebar header end -->

                        <!-- Sidebar Users start -->
                        <div id="users-list" class="chat-user-list-wrapper list-group">
                            <h4 class="chat-list-title">Chats</h4>
                            <ul class="chat-users-list chat-list media-list">
                            <?php
								$claimid=Request::segment(3);
								$companyid=DB::table('claims')->where('id',$claimid)->select('company_id')->first();
								$claims=DB::table('claims')->where('company_id',Auth::user()->company_id)->select('id','company_id')->get();
								// $comments=DB::table('claim_comments')->where('claim_id',18)->select('comment','status','updated_at','update_by')->get();
								?>
											@foreach($claims as $claim)
                                            <li>
                                                <a href="{{url('ic/comment/'.$claim->id)}}" class="list-group-item">
                                                    <div class="d-flex">
                                                        <!-- <div class="chat-user-online">
                                                            <img src="assets/images/avatars/avatar-2.png" width="42" height="42" class="rounded-circle" alt="" />
                                                        </div> -->
                                                        <div class="flex-grow-1 ms-2">

                                                            <h6 class="mb-0 chat-title" style="padding-left:100px; padding-right:100px;">GGI00{{$claim->id}}</h6>
                                                            <p class="mb-0 chat-msg">
                                                            </p>

                                                        </div>
                                                        <!-- <div class="chat-time">9:51 AM</div> -->
                                                    </div>
                                                </a>
                                            </li>
											@endforeach
                            </ul>
                        </div>
                        <!-- Sidebar Users end -->
                    </div>
                    <!--/ Chat Sidebar area -->

                </div>
            </div>
            <div class="content-right">
                <div class="content-wrapper container-xxl p-0">
                    <div class="content-header row">
                    </div>
                    <div class="content-body">
                        <div class="body-content-overlay"></div>
                        <!-- Main chat area -->
                        <section class="chat-app-window">
                            <!-- To load Conversation -->
                            <div class="start-chat-area">
                                <div class="mb-1 start-chat-icon">
                                    <i data-feather="message-square"></i>
                                </div>
                                <h4 class="sidebar-toggle start-chat-text">Start Conversation</h4>
                            </div>
                            <!--/ To load Conversation -->

                            <!-- Active Chat -->
                            <div class="active-chat d-none">
                                <!-- Chat Header -->
                                <div class="chat-navbar">
                                    <header class="chat-header">
                                        <div class="d-flex align-items-center">
                                            <div class="sidebar-toggle d-block d-lg-none mr-1">
                                                <i data-feather="menu" class="font-medium-5"></i>
                                            </div>
                                            <div class="avatar avatar-border user-profile-toggle m-0 mr-1">
                                                <img src="../../../app-assets/images/portrait/small/avatar-s-7.jpg" alt="avatar" height="36" width="36" />
                                                <span class="avatar-status-busy"></span>
                                            </div>
                                            <h6 class="mb-0">Kristopher Candy</h6>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <i data-feather="phone-call" class="cursor-pointer d-sm-block d-none font-medium-2 mr-1"></i>
                                            <i data-feather="video" class="cursor-pointer d-sm-block d-none font-medium-2 mr-1"></i>
                                            <i data-feather="search" class="cursor-pointer d-sm-block d-none font-medium-2"></i>
                                            <div class="dropdown">
                                                <button class="btn-icon btn btn-transparent hide-arrow btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i data-feather="more-vertical" id="chat-header-actions" class="font-medium-2"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="chat-header-actions">
                                                    <a class="dropdown-item" href="javascript:void(0);">View Contact</a>
                                                    <a class="dropdown-item" href="javascript:void(0);">Mute Notifications</a>
                                                    <a class="dropdown-item" href="javascript:void(0);">Block Contact</a>
                                                    <a class="dropdown-item" href="javascript:void(0);">Clear Chat</a>
                                                    <a class="dropdown-item" href="javascript:void(0);">Report</a>
                                                </div>
                                            </div>
                                        </div>
                                    </header>
                                </div>
                                <!--/ Chat Header -->

                                <!-- User Chat messages -->
                                <div class="active-chats">
                                    <div class="chats">
                                        <div class="chat">
                                            <div class="chat-avatar">
                                                <span class="avatar box-shadow-1 cursor-pointer">
                                                    <img src="../../../app-assets/images/portrait/small/avatar-s-11.jpg" alt="avatar" height="36" width="36" />
                                                </span>
                                            </div>
                                            <div class="chat-body">
                                                <div class="chat-content">
                                                    <p>How can we help? We're here for you! 😄</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="chat chat-left">
                                            <div class="chat-avatar">
                                                <span class="avatar box-shadow-1 cursor-pointer">
                                                    <img src="../../../app-assets/images/portrait/small/avatar-s-7.jpg" alt="avatar" height="36" width="36" />
                                                </span>
                                            </div>
                                            <div class="chat-body">
                                                <div class="chat-content">
                                                    <p>Hey John, I am looking for the best admin template.</p>
                                                    <p>Could you please help me to find it out? 🤔</p>
                                                </div>
                                                <div class="chat-content">
                                                    <p>It should be Bootstrap 4 compatible.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="divider">
                                            <div class="divider-text">Yesterday</div>
                                        </div>
                                        <div class="chat">
                                            <div class="chat-avatar">
                                                <span class="avatar box-shadow-1 cursor-pointer">
                                                    <img src="../../../app-assets/images/portrait/small/avatar-s-11.jpg" alt="avatar" height="36" width="36" />
                                                </span>
                                            </div>
                                            <div class="chat-body">
                                                <div class="chat-content">
                                                    <p>Absolutely!</p>
                                                </div>
                                                <div class="chat-content">
                                                    <p>Vuexy admin is the responsive bootstrap 4 admin template.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="chat chat-left">
                                            <div class="chat-avatar">
                                                <span class="avatar box-shadow-1 cursor-pointer">
                                                    <img src="../../../app-assets/images/portrait/small/avatar-s-7.jpg" alt="avatar" height="36" width="36" />
                                                </span>
                                            </div>
                                            <div class="chat-body">
                                                <div class="chat-content">
                                                    <p>Looks clean and fresh UI. 😃</p>
                                                </div>
                                                <div class="chat-content">
                                                    <p>It's perfect for my next project.</p>
                                                </div>
                                                <div class="chat-content">
                                                    <p>How can I purchase it?</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="chat">
                                            <div class="chat-avatar">
                                                <span class="avatar box-shadow-1 cursor-pointer">
                                                    <img src="../../../app-assets/images/portrait/small/avatar-s-11.jpg" alt="avatar" height="36" width="36" />
                                                </span>
                                            </div>
                                            <div class="chat-body">
                                                <div class="chat-content">
                                                    <p>Thanks, from ThemeForest.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="chat chat-left">
                                            <div class="chat-avatar">
                                                <span class="avatar box-shadow-1 cursor-pointer">
                                                    <img src="../../../app-assets/images/portrait/small/avatar-s-7.jpg" alt="avatar" height="36" width="36" />
                                                </span>
                                            </div>
                                            <div class="chat-body">
                                                <div class="chat-content">
                                                    <p>I will purchase it for sure. 👍</p>
                                                </div>
                                                <div class="chat-content">
                                                    <p>Thanks.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="chat">
                                            <div class="chat-avatar">
                                                <span class="avatar box-shadow-1 cursor-pointer">
                                                    <img src="../../../app-assets/images/portrait/small/avatar-s-11.jpg" alt="avatar" height="36" width="36" />
                                                </span>
                                            </div>
                                            <div class="chat-body">
                                                <div class="chat-content">
                                                    <p>Great, Feel free to get in touch on</p>
                                                </div>
                                                <div class="chat-content">
                                                    <p>https://pixinvent.ticksy.com/</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- User Chat messages -->

                                <!-- Submit Chat form -->
                                <form class="chat-app-form" action="javascript:void(0);" onsubmit="enterChat();">
                                    <div class="input-group input-group-merge mr-1 form-send-message">
                                        <div class="input-group-prepend">
                                            <span class="speech-to-text input-group-text"><i data-feather="mic" class="cursor-pointer"></i></span>
                                        </div>
                                        <input type="text" class="form-control message" />
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <label for="attach-doc" class="attachment-icon mb-0">
                                                    <i data-feather="image" class="cursor-pointer lighten-2 text-secondary"></i>
                                                    <input type="file" id="attach-doc" hidden /> </label></span>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-primary send" onclick="enterChat();">
                                        <i data-feather="send" class="d-lg-none"></i>
                                        <span class="d-none d-lg-block">Send</span>
                                    </button>
                                </form>
                                <!--/ Submit Chat form -->
                            </div>
                            <!--/ Active Chat -->
                        </section>
                        <!--/ Main chat area -->

                        <!-- User Chat profile right area -->
                        <div class="user-profile-sidebar">
                            <header class="user-profile-header">
                                <span class="close-icon">
                                    <i data-feather="x"></i>
                                </span>
                                <!-- User Profile image with name -->
                                <div class="header-profile-sidebar">
                                    <div class="avatar box-shadow-1 avatar-border avatar-xl">
                                        <img src="../../../app-assets/images/portrait/small/avatar-s-7.jpg" alt="user_avatar" height="70" width="70" />
                                        <span class="avatar-status-busy avatar-status-lg"></span>
                                    </div>
                                    <h4 class="chat-user-name">Kristopher Candy</h4>
                                    <span class="user-post">UI/UX Designer 👩🏻‍💻</span>
                                </div>
                                <!--/ User Profile image with name -->
                            </header>
                            <div class="user-profile-sidebar-area">
                                <!-- About User -->
                                <h6 class="section-label mb-1">About</h6>
                                <p>Toffee caramels jelly-o tart gummi bears cake I love ice cream lollipop.</p>
                                <!-- About User -->
                                <!-- User's personal information -->
                                <div class="personal-info">
                                    <h6 class="section-label mb-1 mt-3">Personal Information</h6>
                                    <ul class="list-unstyled">
                                        <li class="mb-1">
                                            <i data-feather="mail" class="font-medium-2 mr-50"></i>
                                            <span class="align-middle">kristycandy@email.com</span>
                                        </li>
                                        <li class="mb-1">
                                            <i data-feather="phone-call" class="font-medium-2 mr-50"></i>
                                            <span class="align-middle">+1(123) 456 - 7890</span>
                                        </li>
                                        <li>
                                            <i data-feather="clock" class="font-medium-2 mr-50"></i>
                                            <span class="align-middle">Mon - Fri 10AM - 8PM</span>
                                        </li>
                                    </ul>
                                </div>
                                <!--/ User's personal information -->

                                <!-- User's Links -->
                                <div class="more-options">
                                    <h6 class="section-label mb-1 mt-3">Options</h6>
                                    <ul class="list-unstyled">
                                        <li class="cursor-pointer mb-1">
                                            <i data-feather="tag" class="font-medium-2 mr-50"></i>
                                            <span class="align-middle">Add Tag</span>
                                        </li>
                                        <li class="cursor-pointer mb-1">
                                            <i data-feather="star" class="font-medium-2 mr-50"></i>
                                            <span class="align-middle">Important Contact</span>
                                        </li>
                                        <li class="cursor-pointer mb-1">
                                            <i data-feather="image" class="font-medium-2 mr-50"></i>
                                            <span class="align-middle">Shared Media</span>
                                        </li>
                                        <li class="cursor-pointer mb-1">
                                            <i data-feather="trash" class="font-medium-2 mr-50"></i>
                                            <span class="align-middle">Delete Contact</span>
                                        </li>
                                        <li class="cursor-pointer">
                                            <i data-feather="slash" class="font-medium-2 mr-50"></i>
                                            <span class="align-middle">Block Contact</span>
                                        </li>
                                    </ul>
                                </div>
                                <!--/ User's Links -->
                            </div>
                        </div>
                        <!--/ User Chat profile right area -->

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->
    <x-ic::footer/>
    <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
<script>

    $(function(){
    var dtToday = new Date();
    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();
    var hour=  dtToday.getHours();
    var min=dtToday.getMinutes();
    if(month < 10)
        month = '0' + month.toString();
    if(day < 10)
        day = '0' + day.toString();
        console.log(day)
    var maxDate = year + '-' + month + '-' + day ;

   // alert(maxDate);
    $('#accidentDate').attr('max',maxDate );
    $('#inspection-date-from').attr('min',maxDate );

  });
    </script>
<script>
	$('#debtorType').on('change',function(){
		if($('#debtorType').val() == 'insured'){
			$('#recoveryReason').removeClass('d-none')
		}
		else if($('#debtorType').val() == 'thirdparty'){
			$('#recoveryReason').addClass('d-none')
		}
        else if($('#debtorType').val() == 'third party'){
			$('#recoveryReason').addClass('d-none')
		}
	})

	   $('input[type=radio][name=claim_type]').change(function() {
    if (this.value == 'yes') {
        $('#divIqama').hide();
        $('#divphone').hide();
        $('#deb_iqama').removeAttr('required');
        $('#deb_phone').removeAttr('required');

    }
    else if (this.value == 'no') {
        $('#divIqama').show();
        $('#divphone').show();
        $('#deb_iqama').attr('required',true);
        $('#deb_phone').attr('required',true);
    }
    })
</script>
{{--<script>--}}
{{--const excel_file = document.getElementById('excel_file');--}}
{{--excel_file.addEventListener('change', (event) => {--}}
{{--    if(!['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.ms-excel'].includes(event.target.files[0].type))--}}
{{--    {--}}
{{--        document.getElementById('excel_data').innerHTML = '<div class="alert alert-danger">Only .xlsx or .xls file format are allowed</div>';--}}
{{--        excel_file.value = '';--}}
{{--        return false;--}}
{{--    }--}}
{{--    var reader = new FileReader();--}}
{{--    reader.readAsArrayBuffer(event.target.files[0]);--}}
{{--    reader.onload = function(event){--}}
{{--        var data = new Uint8Array(reader.result);--}}
{{--        var work_book = XLSX.read(data, {type:'array'});--}}
{{--        var sheet_name = work_book.SheetNames;--}}
{{--        var sheet_data = XLSX.utils.sheet_to_json(work_book.Sheets[sheet_name[0]], {header:1});--}}
{{--        if(sheet_data.length > 0)--}}
{{--        {--}}
{{--            if(sheet_data[0][0].toUpperCase() == 'MAKE' && sheet_data[0][1].toUpperCase() == 'MODEL' && sheet_data[0][2].toUpperCase() == 'YEAR' && sheet_data[0][3].toUpperCase() == 'TYPE' && sheet_data[0][4].toUpperCase() == 'COLOR' && sheet_data[0][5].toUpperCase() == 'CLAIM NO' && sheet_data[0][6].toUpperCase() == 'PLATE NO' )--}}
{{--            {--}}
{{--            var table_output = '<table class="table table-striped table-bordered">';--}}
{{--            for(var row = 0; row < sheet_data.length; row++)--}}
{{--            {--}}
{{--                table_output += '<tr>';--}}
{{--                for(var cell = 0; cell < sheet_data[row].length; cell++)--}}
{{--                {--}}
{{--                    if(row == 0)--}}
{{--                    {--}}
{{--                        table_output += '<th>'+sheet_data[row][cell]+'</th>';--}}
{{--                    }--}}
{{--                    else--}}
{{--                    {--}}
{{--                        table_output += '<td>'+sheet_data[row][cell]+' <input type="hidden" name="data[]" value="'+sheet_data[row][cell]+'" >    '+'</td>';--}}
{{--                    }--}}
{{--                }--}}
{{--                if(!row == 0){--}}
{{--              table_output += '<td> <input type="file" name="data[]" value="Upload" required multiple>  </td>';--}}
{{--                }--}}
{{--                table_output += '</tr>';--}}
{{--            }--}}
{{--            table_output += '</table>';--}}
{{--            console.log(table_output);--}}
{{--             document.getElementById('excel_data').innerHTML = table_output;--}}
{{--              }else{--}}
{{--              document.getElementById('excel_data').innerHTML = '<div class="alert alert-danger">Only recomended format are allowed</div>';--}}
{{--        }--}}
{{--        }--}}
{{--        excel_file.value = '';--}}
{{--    }--}}
{{--});--}}
{{--</script>--}}
<script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
<script>

    function convertExcelDate(excelDate) {
      var date = new Date((excelDate - 25569) * 86400 * 1000);
      var day = date.getDate();
      var month = date.getMonth() + 1; // Months are zero-based
      var year = date.getFullYear();

      // Format the date as desired (e.g., DD-MM-YYYY)
      var formattedDate = ("0" + day).slice(-2) + "-" + ("0" + month).slice(-2) + "-" + year;
      var formattedDate = year + "-" + ("0" + month).slice(-2) + "-" + ("0" + day).slice(-2);
      return formattedDate;
    }


    const excel_file = document.getElementById('excel_file');
    excel_file.addEventListener('change', (event) => {
        if(!['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.ms-excel'].includes(event.target.files[0].type))
        {
            document.getElementById('excel_data').innerHTML = '<div class="alert alert-danger">Only .xlsx or .xls file format are allowed</div>';
            excel_file.value = '';
            return false;
        }
        var reader = new FileReader();
        reader.readAsArrayBuffer(event.target.files[0]);
        reader.onload = function(event){
            var data = new Uint8Array(reader.result);
            var work_book = XLSX.read(data, {type:'array'});
            var sheet_name = work_book.SheetNames;
            var sheet_data = XLSX.utils.sheet_to_json(work_book.Sheets[sheet_name[0]], {header:1});
            if(sheet_data.length > 0)
            {
                if(sheet_data[0][0] === 'rec_amt' &&  sheet_data[0][1] === 'acc_location' && sheet_data[0][2] === 'rec_reason' && sheet_data[0][3] === 'deb_iqama' && sheet_data[0][4] === 'deb_name' && sheet_data[0][5] === 'deb_age' && sheet_data[0][6] === 'deb_mob'  && sheet_data[0][7] === 'deb_type' && sheet_data[0][8] === 'claim_no' &&  sheet_data[0][9] === 'ic_email'
                 && sheet_data[0][10] === 'accident_date' && sheet_data[0][11] === 'liability percentage' && sheet_data[0][12] === 'type')
                {
                    console.log(sheet_data.length);
                    var table_output = '<table class="table table-striped table-bordered">';
                    for(var row = 0; row < sheet_data.length; row++) {
                        table_output += '<tr>';
                        for (var cell = 0; cell < sheet_data[row].length; cell++) {
                            if (row == 0) {
                                table_output += '<th>' + sheet_data[row][cell] + '</th>';
                            } else {
                                if(cell == 10){
                                    table_output += '<td>'+convertExcelDate(sheet_data[row][cell])+  ' <input type="hidden" name="data[]" value=" ' + convertExcelDate(sheet_data[row][cell])+ ' " >    ' + '</td>';
                                } else if(cell == 11){
                                    table_output += '<td>'+100*sheet_data[row][cell]+  ' <input type="hidden" name="data[]" value=" ' + 100*sheet_data[row][cell] + ' " >    ' + '</td>';
                                }
                                else{
                                    table_output += '<td>' + sheet_data[row][cell] + ' <input type="hidden" name="data[]" value="' + sheet_data[row][cell] + '" >    ' + '</td>';
                                }
                            }
                        }
                        if (!row == 0) {
                            table_output += '<td> <input type="file" name="data'+row+'[]"    value="Upload" required multiple accept="image/png, image/jpeg ,application/pdf" >  </td>';

                        }
                        table_output += '</tr>';

                    }
                    table_output += '</table>';
                    console.log(table_output);
                    document.getElementById('excel_data').innerHTML = table_output;
                }else{
                    document.getElementById('excel_data').innerHTML = '<div class="alert alert-danger">Only recomended format are allowed</div>';
                }
            }
            excel_file.value = '5r5r';
        }
    });

    function hel()
    {
        var dtToday = new Date();
    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();
    var hour=  dtToday.getHours();
    var min=dtToday.getMinutes();
    if(month < 10)
        month = '0' + month.toString();
    if(day < 10)
        day = '0' + day.toString();
        console.log(day)
    var maxDate = year + '-' + month + '-' + day ;

   // alert(maxDate);
    $('.accidentDate2').attr('max',maxDate );
        console.log
    }
</script>
</body>
</html>
