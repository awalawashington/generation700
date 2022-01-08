<div id="journal" class="text-left paddsection">

    <div class="container">
    <div class="section-title text-center">
        <h2>journal</h2>
    </div>
    </div>

    <div class="container">
    <div class="journal-block">
        <div class="row">
        @foreach($blogs as $blog)
        <div class="col-lg-4 col-md-6">
            <div class="journal-info">

            <a href="blog/{{$blog->slug}}"><img src="{{asset('storage/uploads/blog_posts/thumbnail/'.$blog->image)}}" class="img-responsive" alt="img"></a>

            <div class="journal-txt">
                <h4><a href="blog/{{$blog->slug}}">{{$blog->title}}</a></h4>
            </div>

            </div>
        </div>
        @endforeach

        </div>
    </div>
    </div>

</div>