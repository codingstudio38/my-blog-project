@php
    $loggedin_user = session()->get('user_data');
    $user = GetRowById($loggedin_user->id);
@endphp
<!DOCTYPE html>

<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <title>Edit Blog</title>
    <meta charset="utf-8" />

    @include('user.user_include.header-css-js')
    
</head>

<body id="kt_app_body" data-kt-app-layout="dark-sidebar" data-kt-app-header-fixed="true" data-kt-app-sidebar-enabled="true"
    data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true" data-kt-app-sidebar-push-header="true"
    data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true"
    class="app-default">



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
                                    <h1 class="page-heading d-flex text-dark fw-bold  flex-column justify-content-center my-0"
                                        style=" font-size: xx-large; ">
                                        <a href="{{ route('user-home') }}">Dashboard</a>
                                    </h1>
                                    <!--end::Title-->

                                </div>
                                <!--end::Page title-->



                                <div class="d-flex align-items-center gap-2 gap-lg-3 ">

                                    <a href="#" class="badge badge-light-success fs-base" data-bs-toggle="modal"
                                        data-bs-target="#kt_modal_create_project" style="font-size:x-large !important ">
                                        {{ date('M d, Y h:i A') }}
                                    </a>
                                </div>






                            </div>
                            <!--end::Toolbar container-->
                        </div>
                        <!--end::Toolbar-->
                        @if (session()->has('failed_'))
                            <div class="alert alert-danger show col-md-6 mb-3" role="alert" id="failed"
                                style="margin: auto;">
                                {{ session()->get('failed_') }}
                                <button type="button" class="btn btn-danger close"
                                    style="margin-top: -2px;padding: 2px 8px;" data-dismiss="alert" aria-label="Close"
                                    onclick="{$('#failed').fadeOut('slow');}">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <script>
                                $(document).ready(() => {
                                    setTimeout(() => {
                                        $('#failed').fadeOut('slow');
                                    }, 3000);
                                    setTimeout(() => {
                                        $('#failed').remove();
                                    }, 4000);

                                }) 
                            </script>
                        @endif
                        @if (session()->has('success_'))
                            <div class="alert alert-success show col-md-6 mb-3" role="alert" id="success"
                                style="margin: auto;">
                                {{ session()->get('success_') }}
                                <button type="button" class="btn btn-success close"
                                    style="margin-top: -2px;padding: 2px 8px;" data-dismiss="alert" aria-label="Close"
                                    onclick="{$('#success').fadeOut('slow');}">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <script>
                                $(document).ready(() => {
                                    setTimeout(() => {
                                        $('#success').fadeOut('slow');
                                    }, 3000);
                                    setTimeout(() => {
                                        $('#success').remove();
                                    }, 4000);

                                })
                            </script>
                        @endif

                        <!--begin::Content-->
                        <div id="kt_app_content" class="app-content  flex-column-fluid ">


                            <!--begin::Content container-->
                            <div id="kt_app_content_container" class="app-container  container-xxl ">

                                <!--begin::Row-->
                                <div class="col-md-12" style="margin: auto;background: white;">

 
                                    <!--begin::Content-->
                                    <div class="col-md-12 p-3" style="margin:auto;">
                                        @if (session()->has('ad_danger'))
                                            <div class="alert alert-danger show" role="alert" id="sxd1">
                                                {{ session()->get('ad_danger') }}
                                                <button type="button" class="btn btn-danger close"
                                                    style="padding: 5px 10px; margin-top: -6px;" data-dismiss="alert"
                                                    aria-label="Close" onclick="{$('#sxd1').fadeOut('slow');}">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <script>
                                                $(document).ready(() => {
                                                    setTimeout(() => {
                                                        $('#sxd1').fadeOut('slow');
                                                    }, 3000);
                                                    setTimeout(() => {
                                                        $('#sxd1').remove();
                                                    }, 4000);

                                                })
                                            </script>
                                        @endif
                                        @if (session()->has('ad_massage'))
                                            <div class="alert alert-success show" role="alert" id="sxd1">
                                                {{ session()->get('ad_massage') }}
                                                <button type="button" class="btn btn-success close"
                                                    style="padding: 5px 10px; margin-top: -6px;" data-dismiss="alert"
                                                    aria-label="Close" onclick="{$('#sxd1').fadeOut('slow');}">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <script>
                                                $(document).ready(() => {
                                                    setTimeout(() => {
                                                        $('#sxd1').fadeOut('slow');
                                                    }, 3000);
                                                    setTimeout(() => {
                                                        $('#sxd1').remove();
                                                    }, 4000);

                                                })
                                            </script>
                                        @endif
                                        <form action="{{ route('update-blog',['id'=>base64_encode($blog->id)]) }}" method="POST"
                                            style="background: white; border: 1px solid #bfbdbd; border-radius: 5px;" enctype="multipart/form-data">
                                            @csrf

                                            <br>
                                            @if (!empty($blog->photo))
                                            @if (file_exists(public_path('/blog/'.$blog->photo)))
                                            <img class="card-img-top mb-2 bt-2" src="{{ url('/blog/') }}/{{ $blog->photo }}" alt="{{ $blog->title }}" title="{{ $blog->title }}" style="width: 320px; height: 182px; display: block; margin-left: auto; margin-right: auto;">
                                              @else
                                              <img class="card-img-top mb-2 bt-2" src="{{ url('/assets/images/no-image.png') }}" alt="{{ $blog->title }}" title="{{ $blog->title }}" style="width: 320px; height: 182px; display: block; margin-left: auto; margin-right: auto;">
                                            @endif
                                            @else
                                            <img class="card-img-top mb-2 bt-2" src="{{ url('/assets/images/no-image.png') }}" alt="{{ $blog->title }}" title="{{ $blog->title }}" style="width: 320px; height: 182px; display: block; margin-left: auto; margin-right: auto;">
                                            @endif
                                            <div class="form-outline mb-4 col-md-12" style="margin:auto;">
                                                <label class="form-label">Blog Title</label>
                                                <input type="text" id="title" name="title"
                                                    value="{{ $blog->title }}" class="form-control"  required/>
                                                <span class="text-danger">
                                                    @error('title')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                            <div class="form-outline mb-4 col-md-12" style="margin:auto;">
                                                <label class="form-label">Description</label>
                                                <textarea name="description" id="description" class="form-control"  rows="10" required>
                                                  {{ $blog->description  }}
                                                </textarea>
                                                <span class="text-danger">
                                                  @error('description')
                                                      {{ $message }}
                                                  @enderror
                                              </span>
                                              <script type="text/javascript">
                                                CKEDITOR.replace('description');
                                              </script> 
                                            </div>
                                            <div class="form-outline mb-4 col-md-12" style="margin:auto;">
                                                <label class="form-label">Blog Image</label> 
                                                <input type="file" id="photo" name="photo" onchange="checkimages()" class="form-control p-1"  accept="image/png, image/jpeg" />
                                                <span class="text-danger">
                                                    @error('photo')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                           
                                            
                                         
                                            <div class="col-md-12" style="margin:auto;">
                                                <button type="submit" id="blog-save-btn" name="blog-save-btn" class="btn btn-primary btn-block mb-4">Save</button>
                                            </div>
                                        </form>
                                    </div>


                                </div>
                                <!--end::Row-->






                            </div>
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


 

var blog_save_btn = document.getElementById('blog-save-btn');
blog_save_btn.addEventListener('click',(event)=>{
  let title = $('#title').val();
  let description = $('#description').val();
  let photo = $('#photo').val();
    if(title==""){
        alert('Please enter blog title');
        $('#title').focus();
        event.preventDefault();
    } else if(description==""){
        alert('Please enter blog description');
        $('#description').focus();
        event.preventDefault();
    }
    //  else if(photo==""){
    //     alert('Please select blog photo');
    //     $('#photo').focus();
    //     event.preventDefault();
    // }
})
</script>

    @include('user.user_include.footer-css-js')
</body>

</html>
