<div id="portfolio" class="paddsection">

    <div class="container">
    <div class="section-title text-center">
        <h2>My Portfolio</h2>
    </div>
    </div>

    <div class="container">

    <div class="row">
        <div class="col-lg-12 d-flex justify-content-center">
        <ul id="portfolio-flters">
            <li data-filter="*" class="filter-active">All</li>
            @foreach($portfolio_categories as $portfolio_category)
            <li data-filter=".{{$portfolio_category->slug}}">{{$portfolio_category->name}} </li>
            @endforeach
        </ul>
        </div>
    </div>

    <div class="row portfolio-container">

    @foreach($portfolio_categories as $portfolios)
        @foreach($portfolios->portfolios as $portfolio)
        <div class="col-lg-4 col-md-6 portfolio-item {{$portfolios->slug}}">
        <img src="{{asset('storage/uploads/portfolios/original/'.$portfolio->image)}}" class="img-fluid" alt="">
        <div class="portfolio-info">
            <h4>{{$portfolio->title}} </h4>
            <p>{{$portfolio->description}}</p>
            <a href="{{asset('storage/uploads/portfolios/original/'.$portfolio->image)}}" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Web 3"><i class="bx bx-plus"></i></a>
        </div>
        </div>
        @endforeach
    @endforeach
    </div>

    </div>

</div>