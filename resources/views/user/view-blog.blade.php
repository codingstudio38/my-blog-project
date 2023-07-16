
@php
$loggedin_user = session()->get('user_data');
$user = GetRowById($loggedin_user->id);
@endphp
<!DOCTYPE html>

<html lang="en"> 
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
  <title>User Blog List</title>
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
                    <a href="{{route('user-home') }}">Dashboard</a>
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
            @if(session()->has('failed_'))
            <div class="alert alert-danger show col-md-6 mb-3" role="alert"  id="failed" style="margin: auto;">
             {{ session()->get('failed_') }}
             <button type="button" class="btn btn-danger close" style="margin-top: -2px;padding: 2px 8px;" data-dismiss="alert" aria-label="Close" onclick="{$('#failed').fadeOut('slow');}">
               <span aria-hidden="true" >&times;</span>
             </button>
            </div>
            <script>
              $(document).ready(()=>{
                setTimeout(() => {
                  $('#failed').fadeOut('slow');
                }, 3000);
                setTimeout(() => {
                  $('#failed').remove();
                }, 4000);
                
              })
            </script>
           @endif
            @if(session()->has('success_'))
            <div class="alert alert-success show col-md-6 mb-3" role="alert"  id="success" style="margin: auto;">
             {{ session()->get('success_') }}
             <button type="button" class="btn btn-success close" style="margin-top: -2px;padding: 2px 8px;" data-dismiss="alert" aria-label="Close" onclick="{$('#success').fadeOut('slow');}">
               <span aria-hidden="true" >&times;</span>
             </button>
            </div>
            <script>
              $(document).ready(()=>{
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
                  <div class="row">
                  @if(count($blog_list) <= 0)
                  <div class="col-md-8" style="margin:auto;">
                    <div class="alert alert-primary" role="alert" style="text-align:center;">
                      Please add some blog. <a href="{{ route('add-new-blog') }}" style="text-decoration: underline;">Click here</a> 
                    </div>
                  </div>
                  @else   
                    @foreach ($blog_list as $row)
                    <div class="col-md-4 mt-1 mb-1">
                        <div class="card" style=" border: 1px solid #919191; padding: 5px; ">
                            <div class="card-header p-0">
                                <table style="width:100%;">
                                    <tr>
                                        <td align="right">
                                        <a href="{{ route('edit-blog',['id'=>base64_encode($row->id)]) }}" class="btn btn btn-primary" style=" padding: 5px 10px; " title="Add"><center><i class="fa fa-pencil-square-o" aria-hidden="true"></i></center></a>

                                        @if ($row->status==1)
                                            <a href="{{ route('blog-status',['id'=>base64_encode($row->id),'status'=>0]) }}" class="btn btn btn-success" style=" padding: 5px 10px;" title="Click here to disable"><center><i class="fa fa-ban" aria-hidden="true"></i></center></a>
                                          @else
                                          <a href="{{ route('blog-status',['id'=>base64_encode($row->id),'status'=>1]) }}" class="btn btn btn-danger" style=" padding: 5px 10px;" title="Click here to enable"><center><i class="fa fa-ban" aria-hidden="true"></i></center></a>
                                        @endif
                                       

                                        <a href="javascript:void(0)" onclick="deleteconfirmation('{{ route('delete-blog',['id'=>base64_encode($row->id)]) }}')" class="btn btn btn-danger" style=" padding: 5px 10px;" title="Enable"><center><i class="fa fa-trash" aria-hidden="true"></i></center></a>
                                        </td>
                                    </tr>
                                </table>
                                @if (!empty($row->photo))
                                @if (file_exists(public_path('/blog/'.$row->photo)))
                                <img class="card-img-top mb-2 bt-2" src="{{ url('/blog/') }}/{{ $row->photo }}" alt="{{ $row->title }}" title="{{ $row->title }}">
                                  @else
                                  <img class="card-img-top mb-2 bt-2" src="{{ url('/assets/images/no-image.png') }}" alt="{{ $row->title }}" title="{{ $row->title }}">
                                @endif
                                @else
                                <img class="card-img-top mb-2 bt-2" src="{{ url('/assets/images/no-image.png') }}" alt="{{ $row->title }}" title="{{ $row->title }}">
                                @endif
                                

                                
                            </div> 
                           
                            <div class="card-body p-0">
                              <h5 class="card-title"> 
                              @if(strlen($row->title) <= 80)
                                {{ $row->title }}
                              @else
                              {{ substr($row->title,0,80) }}..
                            @endif
                            </h5>
                          <p class="card-text">
                            @if(strlen(remove_html_tag($row->description)) <= 180)
                                {{ remove_html_tag($row->description) }}
                              @else
                              {{ substr(remove_html_tag($row->description),0,180) }}..
                            @endif
                          </p> 
                              <a href="{{ route('show-blog',['title'=>urlencode($row->title)]) }}" target="_blank" class="btn btn-success btn-sm mb-2 bt-2" style="float: right;">Read more</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                  @endif

                </div>
                <div class="col-md-6 mt-5 mb-5" style="margin: auto;">
                    {{ $blog_list->links('paginate.paginate') }}
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
  function deleteconfirmation(u){
    if(confirm('Are you sure ?')){
      window.location.href = `${u}`;
    }
    return false;
  }
</script>



  @include('user.user_include.footer-css-js')
</body>

</html>