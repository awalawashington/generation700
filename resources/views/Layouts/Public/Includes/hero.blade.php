<div id="hero" class="home" style="background: url('{{asset('storage/uploads/banners/original/'.$banner->image)}}') repeat scroll center center/cover;">

    <div class="container">
        <div class="hero-content">
        <h1>I'm <span class="typed" data-typed-items="{{$banner->title}}"></span></h1>
        <p>{{$banner->description}}</p>

        <ul class="list-unstyled list-social">
            <li><a href="https://www.facebook.com/{{$social_media->facebook}}" target="_blank"><i class="bi bi-facebook"></i></a></li>
            <li><a href="https://www.twitter.com/{{$social_media->twitter}}" target="_blank"><i class="bi bi-twitter"></i></a></li>
            <li><a href="https://www.instagram.com/{{$social_media->instagram}}" target="_blank"><i class="bi bi-instagram"></i></a></li>
            <li><a href="https://www.linkedin.com/{{$social_media->linked_in}}" target="_blank"><i class="bi bi-linkedin"></i></a></li>
        </ul>
        </div>
    </div>
</div>


