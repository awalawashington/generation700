@extends('Layouts.Public.app')
@section('content')
  <!-- ======= Header ======= -->
  @include('Layouts.Public.Includes.navbar')
  <!-- End Header -->

  <main id="main">

    <!-- ======= Blog Grid ======= -->
    <div id="journal-blog" class="text-left  paddsections">

      <div class="container">
        <div class="section-title text-center">
          <h2>BLOG</h2>
        </div>
      </div>

      <div class="container">
        <div class="journal-block">
          <div class="row">
            @foreach($blogs as $blog)
            <div class="col-lg-4 col-md-6">
              <div class="journal-info mb-30">

                <a href="blog/{{$blog->slug}}"><img src="{{asset('public/assets/img/blog-post-1.jpg')}}" class="img-responsive" alt="img"></a>

                <div class="journal-txt">

                  <h4><a href="blog-single.html">{{$blog->title}}</a></h4>
                  <p class="separator">{{$blog->description}}
                  </p>

                </div>

              </div>
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </div><!-- End Blog Grid -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  @include('Layouts.Public.Includes.footer')
  <!-- End Footer -->

  
  @include('Layouts.Public.Includes.js')
  @endsection
  
