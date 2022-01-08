@extends('Layouts.Public.app')
@section('content')
  <!-- ======= Header ======= -->
  @include('Layouts.Public.Includes.navbar')
  <!-- End Header -->

  <!-- ======= Hero Section ======= -->
  @include('Layouts.Public.Includes.hero')
  <!-- End Hero -->

  <main id="main">

    <!-- ======= About Section ======= -->
    @include('Layouts.Public.Includes.about')
    <!-- End About Section -->

    <!-- ======= Portfolio Section ======= -->
    @include('Layouts.Public.Includes.portfolio')
    <!-- End Portfolio Section -->

    <!-- ======= Journal Section ======= -->
    @include('Layouts.Public.Includes.journal')
    <!-- End Journal Section -->

    <!-- ======= Contact Section ======= -->
    @include('Layouts.Public.Includes.contact')
    <!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  @include('Layouts.Public.Includes.footer')
  <!-- End Footer -->

  
  @include('Layouts.Public.Includes.js')
  @endsection
  
