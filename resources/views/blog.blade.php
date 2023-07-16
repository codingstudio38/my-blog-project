<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>My Blog - {{ $blog->title }}</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  @include('./include_index/header-css-js')
</head>

<body>
    @include('./include_index/header')
  

  <main id="main">

   
    
    <!-- ======= Culture Category Section ======= -->
    <section class="category-section">
      <div class="container" data-aos="fade-up">
 
        <div class="row">
          <div class="col-md-9 post-content aos-init aos-animate" data-aos="fade-up">

            <!-- ======= Single Post Content ======= -->
            <div class="single-post">
              <div class="post-meta"><span class="date">Business</span> <span class="mx-1">•</span> <span>Jul 5th '22</span></div>
              <h1 class="mb-5">
                {{ $blog->title }}
              </h1>
             
              <figure class="my-4">
                @if (!empty($blog->photo))
                @if (file_exists(public_path('/blog/'.$blog->photo)))
                <img class="img-fluid" src="{{ url('/blog/') }}/{{ $blog->photo }}" alt="{{ $blog->title }}" title="{{ $blog->title }}" style="display: block; margin-left: auto; margin-right: auto;">
                  @else
                  <img class="img-fluid" src="{{ url('/assets/images/no-image.png') }}" alt="{{ $blog->title }}" title="{{ $row->title }}" style="display: block; margin-left: auto; margin-right: auto;">
                @endif
                @else
                <img class="img-fluid" src="{{ url('/assets/images/no-image.png') }}" alt="{{ $blog->title }}" title="{{ $row->title }}" style="display: block; margin-left: auto; margin-right: auto;">
                @endif
              </figure>
             <?php 
              echo $blog->description;
             ?>
              
            </div><!-- End Single Post Content -->

         

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