<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>My Blog Page</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  @include('./include_index/header-css-js')
</head>

<body>
    @include('./include_index/header')
  

  <main id="main">

    <!-- ======= Hero Slider Section ======= -->
    <section id="hero-slider" class="hero-slider">
      <div class="container-md" data-aos="fade-in">
        <div class="row">
          <div class="col-12">
            <div class="swiper sliderFeaturedPosts">
              <div class="swiper-wrapper">
                @foreach ($banner_list as $row)
                <div class="swiper-slide">

                  
      @if (!empty($row->photo))
      @if (file_exists(public_path('/blog/'.$row->photo)))
      <a href="{{ route('show-blog',['title'=>urlencode($row->title)]) }}" class="img-bg d-flex align-items-end" style="background-image: url('{{ url('/blog/') }}/{{ $row->photo }}');" title="{{ $row->title }}" alt="{{ $row->title }}">
        @else
        <a href="{{ route('show-blog',['title'=>$row->title]) }}" class="img-bg d-flex align-items-end" style="background-image: url('{{ url('/assets/images/no-image.png') }}');" title="{{ $row->title }}" alt="{{ $row->title }}">
      @endif
      @else
      <a href="{{ route('show-blog',['title'=>$row->title]) }}" class="img-bg d-flex align-items-end" style="background-image: url('{{ url('/assets/images/no-image.png') }}');" title="{{ $row->title }}" alt="{{ $row->title }}">
      @endif
                    <div class="img-bg-inner">
                      <h2>
              @if(strlen($row->title) <= 100)
                {{ $row->title }}
              @else
              {{ substr($row->title,0,100) }}..
              @endif
                      </h2>
                      <p>
                        @if(strlen(remove_html_tag($row->description)) <= 200)
                        {{ remove_html_tag($row->description) }}
                      @else
                      {{ substr(remove_html_tag($row->description),0,200) }}..
                    @endif
                      </p>
                    </div>
                  </a>
                </div>
                @endforeach
                
  
              </div>
              <div class="custom-swiper-button-next">
                <span class="bi-chevron-right"></span>
              </div>
              <div class="custom-swiper-button-prev">
                <span class="bi-chevron-left"></span>
              </div>
 
              <div class="swiper-pagination"></div>
            </div>
          </div>
        </div>
      </div> 
    </section><!-- End Hero Slider Section -->

    
    <!-- ======= Culture Category Section ======= -->
    <section class="category-section">
      <div class="container" data-aos="fade-up">

        <div class="section-header d-flex justify-content-between align-items-center mb-5">
          <h2>Blog</h2>
          <div><a href="{{ route('all-blog') }}" class="more">See All</a></div>
        </div>

        <div class="row">
          <div class="col-md-9">
          @if($total_single_blog > 0)
          <div class="d-lg-flex post-entry-2">
            <a href="{{ route('show-blog',['title'=>urlencode($single_blog->title)]) }}" class="me-4 thumbnail mb-4 mb-lg-0 d-inline-block">
              @if (!empty($single_blog->photo))
              @if (file_exists(public_path('/blog/'.$single_blog->photo)))
              <img src="{{ url('/blog/') }}/{{ $single_blog->photo }}" alt="{{ $single_blog->title }}" title="{{ $single_blog->title }}" class="img-fluid">
                @else
                <img src="{{ url('/assets/images/no-image.png') }}" alt="{{ $single_blog->title }}" title="{{ $single_blog->title }}" class="img-fluid">
              @endif
              @else
              <img src="{{ url('/assets/images/no-image.png') }}" alt="{{ $single_blog->title }}" title="{{ $single_blog->title }}" class="img-fluid">
              @endif
            </a>
            <div>
              <div class="post-meta"><span class="mx-1">
                <i class="fa fa-clock-o" aria-hidden="true"></i>
              </span> <span>{{date('M d, Y H:i',strtotime($single_blog->created_at)) }}</span></div>
              <h3><a href="{{ route('show-blog',['title'=>$single_blog->title]) }}">
                @if(strlen($single_blog->title) <= 120)
                {{ $single_blog->title }}
              @else
              {{ substr($single_blog->title,0,120) }}..
            @endif</a>
              </p>
              <div class="d-flex align-items-center author">
                <div class="photo">
                  @if (!empty($single_blog->user_photo))
                  @if (file_exists(public_path('/users/'.$single_blog->user_photo)))
                  <img src="{{ url('/users/') }}/{{ $single_blog->user_photo }}" alt="{{ $single_blog->name }}" title="{{ $single_blog->name }}" class="img-fluid" style="height: 40px;">
                    @else 
                    <img src="{{ url('/assets/images/no-image.png') }}" alt="{{ $single_blog->name }}" title="{{ $single_blog->name }}" class="img-fluid" style="height: 40px;">
                  @endif
                  @else
                  <img src="{{ url('/assets/images/no-image.png') }}" alt="{{ $single_blog->name }}" title="{{ $single_blog->name }}" class="img-fluid" style="height: 40px;">
                  @endif

                  
                </div>
                <div class="name">
                  <h3 class="m-0 p-0">{{ $single_blog->name }}</h3>
                </div>
              </div>
            </div>
          </div>
          @endif
            

            <div class="row">

              @foreach ($all_blog_list as $row)
              <div class="col-md-4 mt-1 mb-1">
                  <div class="card" style=" border: 1px solid #919191; padding: 5px; ">
                      <div class="card-header p-0" >
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
                          <a href="{{ route('show-blog',['title'=>urlencode($row->title)]) }}">
                            @if(strlen($row->title) <= 80)
                                {{ $row->title }}
                              @else 
                              {{ substr($row->title,0,80) }}..
                            @endif
                          </a>
                      </h5>
                      <p class="card-text">
                        @if(strlen(remove_html_tag($row->description)) <= 165)
                            {{ remove_html_tag($row->description) }}
                          @else
                          {{ substr(remove_html_tag($row->description),0,165) }}..
                        @endif
                      </p>
                        <a href="{{ route('show-blog',['title'=>urlencode($row->title)]) }}" class="btn btn-success btn-sm mb-2 bt-2" style="float: right;">Read more</a>
                      </div>
                  </div>
              </div>
              @endforeach


            </div>
            <div class="col-md-10  mt-5 mb-5" style="margin: auto; text-align: center;">
              <a class="btn btn-success btn-sm" href="{{ route('all-blog') }}">See All</a>
            </div>
          </div>

          <div class="col-md-3">
            @foreach ($left_blog_list as $row)
            <div class="post-entry-1 border-bottom">
              <div class="post-meta"><span class="mx-1">
                <i class="fa fa-clock-o" aria-hidden="true"></i>
              </span> <span>{{date('M d, Y H:i',strtotime($row->created_at)) }}</span></div>
              <h2 class="mb-2"><a href="{{ route('show-blog',['title'=>urlencode($row->title)]) }}">
              @if(strlen($row->title) <= 80)
                {{ $row->title }}
              @else
              {{ substr($row->title,0,80) }}..
            @endif  
              </a></h2>
              <span class="author mb-3 d-block">{{$row->name }}</span>
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </section><!-- End Culture Category Section -->

 
  </main><!-- End #main -->

  
  @include('./include_index/footer')
  <!-- Vendor JS Files -->
 
@include('./include_index/footer-css-js')
</body>

</html>