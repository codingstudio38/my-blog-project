<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>My Map</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
 
  
<!-- Favicons -->
{{-- <link href="{{ url('/') }}/assets/img/favicon.png" rel="icon">
<link href="{{ url('/') }}/assets/img/apple-touch-icon.png" rel="apple-touch-icon"> --}}

<!-- Google Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=EB+Garamond:wght@400;500&family=Inter:wght@400;500&family=Playfair+Display:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">

<!-- Vendor CSS Files -->
<link href="{{ url('/') }}/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="{{ url('/') }}/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
<link href="{{ url('/') }}/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
<link href="{{ url('/') }}/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
<link href="{{ url('/') }}/assets/vendor/aos/aos.css" rel="stylesheet">

<!-- Template Main CSS Files -->
<link href="{{ url('/') }}/assets/css-new/variables.css" rel="stylesheet">
<link href="{{ url('/') }}/assets/css-new/main.css" rel="stylesheet">

 {{-- <link rel="stylesheet" href="https://fontawesome.com/v4/assets/font-awesome/css/font-awesome.css"> --}}
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="{{ url('/') }}/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="{{ url('/') }}/js/jquery.slim.min.js"></script>
<script src="{{ url('/') }}/js/popper.min.js"></script>
<script src="{{ url('/') }}/js/bootstrap.bundle.min.js"></script>
<script src="{{ url('/') }}/js/jquery.min.js"></script>
{{-- <script src="https://www.gstatic.com/charts/loader.js"></script> --}}
<script src="https://www.google.com/jsapi"></script>
 <style>
    input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    margin: 0; 
}

a:hover {
    text-decoration: none ;
}
.js-search-open{
    display: none;
} 
.title{
	display: inline-block;
    width: 247px;
    white-space: nowrap;
    overflow: hidden !important;
    text-overflow: ellipsis;
}
 </style>
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
          <h2>Map</h2>
          <div><a href="{{ route('all-blog') }}" class="more">See All</a></div>
        </div>

        <div class="row">
          <div class="col-md-12">
         
            

            <div class="row">

              <main id="main">
                <div align="center">
                  <div id="visualization">

                  </div>
                </div>
                <script>
  google.load('visualization', '1', {'packages': ['geochart']});
  google.setOnLoadCallback(drawVisualization);
function drawVisualization() {
  var data=google.visualization.arrayToDataTable([
    ['State Code', 'State', 'AQI PM2.5'], 
    ['IN-UP', 'Uttar Pradesh', 780],
    ['IN-MH', 'Maharashtra', 920],
    ['IN-BR', 'Bihar', 510],
    ['IN-WB', 'West Bengal', 620], 
    ['IN-MP', 'Madhya Pradesh', 700], 
    ['IN-TN', 'Tamil Nadu', 930],
    ['IN-RJ', 'Rajasthan', 1030],
    ['IN-KA', 'Karnataka', 1290],
    ['IN-GJ', 'Gujarat', 1304],
    ['IN-AP', 'Andhra Pradesh', 320],
    ['IN-OR', 'Orissa', 133],
    ['IN-TG', 'Telangana', 233],
    ['IN-KL', 'Kerala', 311],
    ['IN-JH', 'Jharkhand', 290],
    ['IN-AS', 'Assam', 280], 
    ['IN-PB', 'Punjab', 300],
    ['IN-CT', 'Chhattisgarh', 330], 
    ['IN-HR', 'Haryana', 300],
    ['IN-JK', 'Jammu and Kashmir', 200], 
    ['IN-UT', 'Uttarakhand', 208], 
    ['IN-HP', 'Himachal Pradesh', 107],
    ['IN-TR', 'Tripura', 301],
    ['IN-ML', 'Meghalaya', 210],
    ['IN-MN', 'Manipur', 220],
    ['IN-NL', 'Nagaland', 201],
    ['IN-GA', 'Goa', 1121],
    ['IN-AR', 'Arunachal Pradesh', 343],
    ['IN-MZ', 'Mizoram', 423],
    ['IN-SK', 'Sikkim', 724],
    ['IN-DL', 'Delhi', 231], 
    ['IN-PY', 'Puducherry', 233],
    ['IN-CH', 'Chandigarh', 230],
    ['IN-AN', 'Andaman and Nicobar Islands', 230], 
    ['IN-DN', 'Dadra and Nagar Haveli', 230],
    ['IN-DD', 'Daman and Diu', 229],
    ['IN-LD', 'Lakshadweep', 231]
  ]);

  var opts={ 
    region: 'IN',
    domain: 'IN',
    displayMode: 'regions',
    colorAxis: {colors: ['#008000', '#FFFF00', '#0000FF']},
    resolution: 'provinces',
    backgroundColor: '#81d4fa',
    defaultColor: '#f5f5f5',
    width:940, height:680,
};
var geochart = new google.visualization.GeoChart(
  document.getElementById('visualization')
);
geochart.draw(data,opts)

};
                </script>
              </main>


            </div>
          
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