
<!DOCTYPE html>
 
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
  <title>User Profile</title>
  <meta charset="utf-8" />
  @include('user.user_include.header-css-js')
</head>

<body id="kt_app_body" data-kt-app-layout="dark-sidebar" data-kt-app-header-fixed="true"
  data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true"
  data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true"
  data-kt-app-toolbar-enabled="true" class="app-default">
 


  <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
    <div class="app-page  flex-column flex-column-fluid " id="kt_app_page">

      @include('user.user_include.top-navbar')












      <!--begin::Wrapper-->
      <div class="app-wrapper  flex-column flex-row-fluid " id="kt_app_wrapper">

        @include('user.user_include.left-navbar')


        <!--begin::Main-->
        <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
          <!--begin::Content wrapper-->
          <div class="d-flex flex-column flex-column-fluid">

            <!--begin::Toolbar-->
            <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">

              <!--begin::Toolbar container-->
              <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack ">



                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                  <!--begin::Title-->
                  <h1 class="page-heading d-flex text-dark fw-bold  flex-column justify-content-center my-0" style=" font-size: xx-large; ">
                    <a href="{{ route('user-profile') }}">User Profile</a>
                  </h1>
                  <!--end::Title-->

                </div>
                <!--end::Page title-->
                


                <div class="d-flex align-items-center gap-2 gap-lg-3 ">
     
                          <a href="#" class="badge badge-light-success fs-base" data-bs-toggle="modal" data-bs-target="#kt_modal_create_project" style="font-size:x-large !important ">
                         {{date('M d, Y h:i A')}}
                        </a>
              </div>






              </div>
              <!--end::Toolbar container-->
            </div>
            <!--end::Toolbar-->


            <style>
                .table{
                    background: white;
                }
                .table thead{
                    background: #3e8ba5 !important;
                    color: white !important;
                }
                .table tbody tr:nth-child(even) {background-color: #f8f8f8;}
            </style>


            <!--begin::Content-->
            <div id="kt_app_content" class="app-content  flex-column-fluid ">
    
           
              <!--begin::Content container-->
              <div id="kt_app_content_container" class="app-container  container-xxl ">
                  
      <!--begin::Navbar-->
      <div class="card card-flush mb-9" id="kt_user_profile_panel">
          <!--begin::Hero nav-->
          <div class="card-header rounded-top bgi-size-cover h-200px" style="background-position: 100% 50%; background-image:url('{{ url('/assets/media/misc/profile-head-bg.jpg') }}')">
          </div>
          <!--end::Hero nav--> 
      
          <!--begin::Body-->
          <div class="card-body mt-n19">
              <!--begin::Details-->
              <div class="m-0">
                  <!--begin: Pic-->
                  <div class="d-flex flex-stack align-items-end pb-4 mt-n19">
                      <div class="symbol symbol-125px symbol-lg-150px symbol-fixed position-relative mt-n3">
                        @if (!empty($user_details->photo))
                        @if (file_exists(public_path('/users/'.$user_details->photo)))
                          <img alt="Logo" src="{{ url('/') }}/users/{{ $user_details->photo }}" />
                          @else
                          <img alt="Logo" src="{{ url('/') }}/assets/images/user-unknow.jpg" class="border border-white border-4" style="border-radius: 20px"/>
                        @endif
                        @else
                        <img alt="Logo" src="{{ url('/') }}/assets/images/user-unknow.jpg" class="border border-white border-4" style="border-radius: 20px"/>
                      @endif
                         

                          {{-- <div class="position-absolute translate-middle bottom-0 start-100 ms-n1 mb-9 bg-success rounded-circle h-15px w-15px"></div> --}}
                      </div>
      
                      <!--begin::Toolbar-->
                      <div class="me-0">
                          <button class="btn btn-icon btn-sm btn-active-color-primary  justify-content-end pt-3" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                              <i class="fonticon-settings fs-2"></i>
                          </button>
                          
    
                      </div>    
                      <!--end::Toolbar-->
                  </div>
                  <!--end::Pic-->
      
                  <!--begin::Info-->
                  <div class="d-flex flex-stack flex-wrap align-items-end">
                      <!--begin::User-->
                      <div class="d-flex flex-column">
                          <!--begin::Name-->
                          <div class="d-flex align-items-center mb-2">
                              <a href="#" class="text-gray-800 text-hover-primary fs-2 fw-bolder me-1">{{ $user_details->name }}</a>
                              <a href="#" class="" data-bs-toggle="tooltip" data-bs-placement="right" aria-label="Account is verified" data-bs-original-title="Account is verified" data-kt-initialized="1">
                                  <i class="ki-duotone ki-verify fs-1 text-primary"><span class="path1"></span><span class="path2"></span></i>                        </a>    
                          </div>
                          <!--end::Name-->
      
                      
                          
                      </div>
                      <!--end::User-->
      
                     
                  </div>
                  <!--end::Info-->
              </div>
              <!--end::Details-->
          </div>
      </div>
      <!--end::Navbar-->
     <form action="{{ route('update-personal-details') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <!--begin::details View'-->
      <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
          <!--begin::Card header--> 
          <div class="card-header cursor-pointer">
              <!--begin::Card title-->
              <div class="card-title m-0">
                  <h3 class="fw-bold m-0">Edit Personal Details</h3>
              </div>
              <!--end::Card title-->
      
          </div>
          <!--begin::Card header-->
      
          <!--begin::Card body-->
          <div class="card-body p-9">

            @if(session()->has('ad_danger1'))
            <div class="alert alert-danger show" role="alert"  id="ad_danger1" >
             {{ session()->get('ad_danger1') }}
             <button type="button" class="btn btn-danger close" style="padding: 5px 10px; margin-top: -6px;" data-dismiss="alert" aria-label="Close" onclick="{$('#ad_danger1').fadeOut('slow');}">
               <span aria-hidden="true" >&times;</span>
             </button>
            </div>
            <script>
              $(document).ready(()=>{
                setTimeout(() => {
                  $('#ad_danger1').fadeOut('slow');
                }, 3000);
                setTimeout(() => {
                  $('#ad_danger1').remove();
                }, 4000);
                
              })
            </script>
           @endif
            @if(session()->has('ad_massage1'))
            <div class="alert alert-success show" role="alert"  id="ad_massage1" >
             {{ session()->get('ad_massage1') }}
             <button type="button" class="btn btn-success close" style="padding: 5px 10px; margin-top: -6px;" data-dismiss="alert" aria-label="Close" onclick="{$('#ad_massage1').fadeOut('slow');}">
               <span aria-hidden="true" >&times;</span>
             </button>
            </div>
            <script>
              $(document).ready(()=>{
                setTimeout(() => {
                  $('#ad_massage1').fadeOut('slow');
                }, 3000);
                setTimeout(() => {
                  $('#ad_massage1').remove();
                }, 4000);
                
              })
            </script>
           @endif 
              <!--begin::Row-->
              <div class="row mb-7">
                  <!--begin::Label-->
                  <label class="col-lg-4 fw-semibold text-muted">Full Name</label>
                  <!--end::Label-->
      
                  <!--begin::Col-->
                  <div class="col-lg-8">                    
                      <input type="text" class="form-control" name="name" id="name" value="{{ $user_details->name }}" required>   
                      <span class="text-danger">@error('name') {{$message}} @enderror</span>      
                  </div>
                  <!--end::Col-->
              </div>
              <!--end::Row-->
      
              <!--begin::Input group-->
              <div class="row mb-7">
                  <!--begin::Label-->
                  <label class="col-lg-4 fw-semibold text-muted">Profile Photo</label>
                  <!--end::Label-->
      
                  <!--begin::Col-->
                  <div class="col-lg-8 fv-row"> 
                    <input type="file" id="photo" name="photo" class="form-control" style="padding: 5px 5px;" onchange="checkimages()"  accept="image/png, image/jpeg"/>      
                    <span class="text-danger">@error('photo') {{$message}} @enderror</span>                  
                  </div>
                  <!--end::Col-->
              </div>
             <div style="text-align: center;"> <input type="submit" name="submit" value="Update" class="btn btn-success"></div>
              <!--end::Input group-->
          </div>
          <!--end::Card body-->     
      </div>
      <!--end::details View-->
    </form>






    <form action="{{ route('update-email') }}" method="POST" >
    @csrf
      <!--begin::details View-->
      <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
        <!--begin::Card header-->
        <div class="card-header cursor-pointer">
            <!--begin::Card title-->
            <div class="card-title m-0">
                <h3 class="fw-bold m-0">Edit Email Id</h3>
            </div>
            <!--end::Card title-->
    
        </div>
        <!--begin::Card header-->
    
        <!--begin::Card body-->
        <div class="card-body p-9">
          @if(session()->has('ad_danger2'))
            <div class="alert alert-danger show" role="alert"  id="ad_danger2" >
             {{ session()->get('ad_danger2') }}
             <button type="button" class="btn btn-danger close" style="padding: 5px 10px; margin-top: -6px;" data-dismiss="alert" aria-label="Close" onclick="{$('#ad_danger2').fadeOut('slow');}">
               <span aria-hidden="true" >&times;</span>
             </button>
            </div>
            <script>
              $(document).ready(()=>{
                setTimeout(() => {
                  $('#ad_danger2').fadeOut('slow');
                }, 3000);
                setTimeout(() => {
                  $('#ad_danger2').remove();
                }, 4000);
                
              })
            </script>
           @endif
            @if(session()->has('ad_massage2'))
            <div class="alert alert-success show" role="alert"  id="ad_massage2" >
             {{ session()->get('ad_massage2') }}
             <button type="button" class="btn btn-success close" style="padding: 5px 10px; margin-top: -6px;" data-dismiss="alert" aria-label="Close" onclick="{$('#ad_massage2').fadeOut('slow');}">
               <span aria-hidden="true" >&times;</span>
             </button>
            </div>
            <script>
              $(document).ready(()=>{
                setTimeout(() => {
                  $('#ad_massage2').fadeOut('slow');
                }, 3000);
                setTimeout(() => {
                  $('#ad_massage2').remove();
                }, 4000);
                
              })
            </script>
           @endif 
            <!--begin::Row-->
            <div class="row mb-7">
                <!--begin::Label-->
                <label class="col-lg-4 fw-semibold text-muted">Email Id</label>
                <!--end::Label-->
    
                <!--begin::Col-->
                <div class="col-lg-8">                    
                    <input type="email" class="form-control" name="email" id="email" value="{{ $user_details->email }}" required>  
                    <span class="text-danger">@error('email') {{$message}} @enderror</span>             
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
            <div style="text-align: center;"> <input type="submit" name="submit" value="Update" class="btn btn-success"></div>
           
        </div>
        <!--end::Card body-->     
    </div>
    <!--end::details View-->
</form>



<form action="{{ route('update-phone') }}" method="POST" >
  @csrf
    <!--begin::details View-->
    <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
      <!--begin::Card header-->
      <div class="card-header cursor-pointer">
          <!--begin::Card title-->
          <div class="card-title m-0">
              <h3 class="fw-bold m-0">Edit Phone Number</h3>
          </div>
          <!--end::Card title-->
  
      </div>
      <!--begin::Card header-->
  
      <!--begin::Card body-->
      <div class="card-body p-9">
        @if(session()->has('ad_danger4'))
          <div class="alert alert-danger show" role="alert"  id="ad_danger4" >
           {{ session()->get('ad_danger4') }}
           <button type="button" class="btn btn-danger close" style="padding: 5px 10px; margin-top: -6px;" data-dismiss="alert" aria-label="Close" onclick="{$('#ad_danger4').fadeOut('slow');}">
             <span aria-hidden="true" >&times;</span>
           </button>
          </div>
          <script>
            $(document).ready(()=>{
              setTimeout(() => {
                $('#ad_danger4').fadeOut('slow');
              }, 3000);
              setTimeout(() => {
                $('#ad_danger4').remove();
              }, 4000);
              
            })
          </script>
         @endif
          @if(session()->has('ad_massage4'))
          <div class="alert alert-success show" role="alert"  id="ad_massage4" >
           {{ session()->get('ad_massage4') }}
           <button type="button" class="btn btn-success close" style="padding: 5px 10px; margin-top: -6px;" data-dismiss="alert" aria-label="Close" onclick="{$('#ad_massage4').fadeOut('slow');}">
             <span aria-hidden="true" >&times;</span>
           </button>
          </div>
          <script>
            $(document).ready(()=>{
              setTimeout(() => {
                $('#ad_massage4').fadeOut('slow');
              }, 3000);
              setTimeout(() => {
                $('#ad_massage4').remove();
              }, 4000);
              
            })
          </script>
         @endif 
          <!--begin::Row-->
          <div class="row mb-7">
              <!--begin::Label-->
              <label class="col-lg-4 fw-semibold text-muted">Phone Number</label>
              <!--end::Label-->
  
              <!--begin::Col-->
              <div class="col-lg-8">                    
                  <input type="number" class="form-control" name="phone" id="phone" value="{{ $user_details->phone }}" required onkeypress="return isNumberKey(event)">  
                  <span class="text-danger">@error('phone') {{$message}} @enderror</span>             
              </div> 
              <!--end::Col-->
          </div>
          <!--end::Row-->
          <div style="text-align: center;"> <input type="submit" name="submit" value="Update" class="btn btn-success"></div>
         
      </div>
      <!--end::Card body-->     
  </div>
  <!--end::details View-->
</form>



<form action="{{ route('update-password') }}" method="POST" >
  @csrf
    <!--begin::details View-->
    <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
      <!--begin::Card header-->
      <div class="card-header cursor-pointer">
          <!--begin::Card title-->
          <div class="card-title m-0">
              <h3 class="fw-bold m-0">Change Password</h3>
          </div>
          <!--end::Card title-->
  
      </div>
      <!--begin::Card header-->
  
      <!--begin::Card body-->
      <div class="card-body p-9">
        @if(session()->has('ad_danger3'))
            <div class="alert alert-danger show" role="alert"  id="ad_danger3" >
             {{ session()->get('ad_danger3') }}
             <button type="button" class="btn btn-danger close" style="padding: 5px 10px; margin-top: -6px;" data-dismiss="alert" aria-label="Close" onclick="{$('#ad_danger3').fadeOut('slow');}">
               <span aria-hidden="true" >&times;</span>
             </button>
            </div>
            <script>
              $(document).ready(()=>{
                setTimeout(() => {
                  $('#ad_danger3').fadeOut('slow');
                }, 3000);
                setTimeout(() => {
                  $('#ad_danger3').remove();
                }, 4000);
                
              })
            </script>
           @endif
            @if(session()->has('ad_massage3'))
            <div class="alert alert-success show" role="alert"  id="ad_massage3" >
             {{ session()->get('ad_massage3') }}
             <button type="button" class="btn btn-success close" style="padding: 5px 10px; margin-top: -6px;" data-dismiss="alert" aria-label="Close" onclick="{$('#ad_massage3').fadeOut('slow');}">
               <span aria-hidden="true" >&times;</span>
             </button>
            </div>
            <script>
              $(document).ready(()=>{
                setTimeout(() => {
                  $('#ad_massage3').fadeOut('slow');
                }, 3000);
                setTimeout(() => {
                  $('#ad_massage3').remove();
                }, 4000);
                
              })
            </script>
           @endif 
          <!--begin::Row-->
          <div class="row mb-7">
              <!--begin::Label-->
              <label class="col-lg-4 fw-semibold text-muted">Current Password</label>
              <!--end::Label-->
  
              <!--begin::Col-->
              <div class="col-lg-8">                    
                  <input type="password" class="form-control" name="password" id="password" value="{{ old('password') }}" required>  
                  <span class="text-danger">@error('password') {{$message}} @enderror</span>                          
              </div>
              <!--end::Col-->
          </div>
          <!--end::Row-->
  
            <!--begin::Row-->
            <div class="row mb-7">
              <!--begin::Label-->
              <label class="col-lg-4 fw-semibold text-muted">New Password</label>
              <!--end::Label-->
  
              <!--begin::Col-->
              <div class="col-lg-8">                    
                <input type="password" class="form-control" name="new_password" id="new_password" value="{{ old('new_password') }}" required>  
                <span class="text-danger">@error('new_password') {{$message}} @enderror</span>                    
              </div>
              <!--end::Col-->
          </div>
          <!--end::Row-->

          
          <!--end::Row-->
          <div style="text-align: center;"> <input type="submit" name="submit" value="Update"  class="btn btn-success"></div>
      </div>
      <!--end::Card body-->     
  </div>
  <!--end::details View-->
</form>



   
      <!--end::Row-->         </div>
              <!--end::Content container-->
          </div>

            <!--end::Content-->
          </div>
          <!--end::Content wrapper-->


          @include('user.user_include.footer')
        </div>
        <!--end:::Main-->


      </div>
      <!--end::Wrapper-->


    </div>
    <!--end::Page-->
  </div>
  <!--end::App-->


<script>
  function checkimages(){
    let photo = document.getElementById('photo');
    if (photo.value == "") {
        return false;
    }
    checkimg = photo.value.toLowerCase();
    if (!checkimg.match(/(\.jpg|\.png|\.JPG|\.PNG|\.jpeg|\.JPEG)$/)) {
        alert("Please select jpg, png file..!!");
        photo.value = "";
        return false;
    }
    //console.log(photo.files[0].size);//original size
    //console.log(parseFloat(photo.files[0].size / 1024).toFixed(2));//kb
    //console.log(parseFloat(photo.files[0].size / (1024 * 1024)).toFixed(2));//mb
    let size = parseFloat(photo.files[0].size / 1024).toFixed(2);
    if (size > 500) {
        alert("Image size should be size less than 500 kb");
        photo.value = "";
        return false;
    } 
}
</script>



  @include('user.user_include.footer-css-js')
</body>

</html>