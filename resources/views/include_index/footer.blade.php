@php
  $post = GetRecentPost()
@endphp
<!-- ======= Footer ======= -->
<footer id="footer" class="footer">

    <div class="footer-content">
      <div class="container">

        <div class="row g-5">
          <div class="col-lg-4">
            <h3 class="footer-heading">About My Blog Page</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam ab, perspiciatis beatae autem deleniti voluptate nulla a dolores, exercitationem eveniet libero laudantium recusandae officiis qui aliquid blanditiis omnis quae. Explicabo?</p>
            <p><a href="{{ route('all-blog') }}" class="footer-link-more">Learn More</a></p>
          </div>
          <div class="col-6 col-lg-2">
            <h3 class="footer-heading">Navigation</h3>
            <ul class="footer-links list-unstyled">
              <li><a href="{{ route('indexpage') }}><i class="bi bi-chevron-right"></i> Home</a></li>
              <li><a href="{{ route('all-blog') }}"><i class="bi bi-chevron-right"></i> Blog</a></li>
              <li><a href="{{ route('all-blog') }}"><i class="bi bi-chevron-right"></i> Categories</a></li>
              <li><a href="{{ route('all-blog') }}"><i class="bi bi-chevron-right"></i> Single Post</a></li>
              <li><a href="{{ route('all-blog') }}"><i class="bi bi-chevron-right"></i> About us</a></li>
              <li><a href="{{ route('all-blog') }}"><i class="bi bi-chevron-right"></i> Contact</a></li>
            </ul>
          </div>
          <div class="col-6 col-lg-2">
            <h3 class="footer-heading">Categories</h3>
            <ul class="footer-links list-unstyled">
              <li><a href="{{ route('all-blog') }}"><i class="bi bi-chevron-right"></i> Business</a></li>
              <li><a href="{{ route('all-blog') }}"><i class="bi bi-chevron-right"></i> Culture</a></li>
              <li><a href="{{ route('all-blog') }}"><i class="bi bi-chevron-right"></i> Sport</a></li>
              <li><a href="{{ route('all-blog') }}"><i class="bi bi-chevron-right"></i> Food</a></li>
              <li><a href="{{ route('all-blog') }}"><i class="bi bi-chevron-right"></i> Politics</a></li>
              <li><a href="{{ route('all-blog') }}"><i class="bi bi-chevron-right"></i> Celebrity</a></li>
              <li><a href="{{ route('all-blog') }}"><i class="bi bi-chevron-right"></i> Startups</a></li>
              <li><a href="{{ route('all-blog') }}"><i class="bi bi-chevron-right"></i> Travel</a></li>

            </ul>
          </div>

          <div class="col-lg-4">
            <h3 class="footer-heading">Recent Posts</h3>

            <ul class="footer-links footer-blog-entry list-unstyled">
            @foreach($post['list'] as $key => $row)
              <li> 
                <a href="{{ route('show-blog',['title'=>urlencode($row->title)]) }}" class="d-flex align-items-center">
                  @if (!empty($row->photo))
                  @if (file_exists(public_path('/blog/'.$row->photo)))
                  <img class="img-fluid me-3" src="{{ url('/blog/') }}/{{ $row->photo }}" alt="{{ $row->title }}" title="{{ $row->title }}">
                    @else
                    <img class="img-fluid me-3" src="{{ url('/assets/images/no-image.png') }}" alt="{{ $row->title }}" title="{{ $row->title }}">
                  @endif
                  @else
                  <img class="img-fluid me-3" src="{{ url('/assets/images/no-image.png') }}" alt="{{ $row->title }}" title="{{ $row->title }}">
                  @endif 
                  <div>
                    <div class="post-meta d-block">
                    <span class="mx-1">
                      <i class="fa fa-clock-o" aria-hidden="true"></i>
                    </span> {{date('M d, Y H:i',strtotime($row->created_at)) }}</div>
                    <span>
                      @if(strlen($row->title) <= 40)
                                {{ $row->title }}
                        @else 
                        {{ substr($row->title,0,40) }}..
                      @endif
                    </span>
                  </div>
                </a>
              </li>
              @endforeach
            </ul>

          </div>
        </div>
      </div>
    </div>

    <div class="footer-legal">
      <div class="container">

        <div class="row justify-content-between">
          <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
            <div class="copyright">
              © Copyright <strong><span>Blog</span></strong>. All Rights Reserved
            </div>

            {{-- <div class="credits">
              <!-- All the links in the footer should remain intact. -->
              <!-- You can delete the links only if you purchased the pro version. -->
              <!-- Licensing information: https://bootstrapmade.com/license/ -->
              <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/herobiz-bootstrap-business-template/ -->
              Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div> --}}

          </div>

          <div class="col-md-6">
            <div class="social-links mb-3 mb-lg-0 text-center text-md-end">
              <a href="https://www.facebook.com/" target="_blank" class="facebook"><i class="bi bi-facebook"></i></a>
              <a href="https://www.facebook.com/" target="_blank" class="twitter"><i class="bi bi-twitter"></i></a>
              <a href="https://www.instagram.com/" target="_blank" class="instagram"><i class="bi bi-instagram"></i></a>
            </div>

          </div>

        </div>

      </div>
    </div>

  </footer>

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>