@extends('Layouts.Public.app')
@section('content')
  <!-- ======= Header ======= -->
  @include('Layouts.Public.Includes.navbar')
  <!-- End Header -->

  <main id="main">
    <!-- ======= Blog Single ======= -->
    <div class="main-content paddsection">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-8 col-md-offset-2">
            <div class="row">
              <div class="container-main single-main">
                <div class="col-md-12">
                  <div class="block-main mb-30">
                    <img src="{{asset('storage/uploads/blog_posts/large/'.$blog->image)}}" class="img-responsive" alt="reviews2">
                    <div class="content-main single-post padDiv">
                      <div class="journal-txt">
                        <h4><a href="#">{{$blog->title}}</a></h4>
                      </div>
                      <div class="post-meta">
                        <ul class="list-unstyled mb-0">
                          <li class="author">by:<a href="#">{{$blog->user->name}}</a></li>
                          <li class="date"><i class="clock"></i><a href="#">{{$blog->created_at->diffForHumans()}}</a></li>
                          <li class="commont"><i class="ion-ios-heart-outline"></i><a href="#">{{$blog->comments->count()}} Comments</a></li>
                        </ul>
                      </div>
                      <p class="mb-30">{{$blog->description}}</p>
                      <p class="mb-30">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type
                        specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages,
                        and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                      <blockquote>If you are still looking for that one person who will change your life, take a look in the mirror.</blockquote>
                      <p class="mb-30">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in
                        Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections
                        1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum,
                        "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-12" id="comments">
                  <div class="comments text-left padDiv mb-30">
                    <div class="entry-comments">
                      <h6 class="mb-30">{{$blog->comments->count()}} comments</h6>
                      <ul class="entry-comments-list list-unstyled">
                        @foreach($blog->comments as $comment)
                        <li>
                          <div class="entry-comments-item">
                            <img src="{{asset('public/assets/img/avatar.jpg')}}" class="entry-comments-avatar" alt="">
                            <div class="entry-comments-body">
                              <span class="entry-comments-author">{{$comment->name}}</span>
                              <span><a href="#">{{$comment->created_at->diffForHumans()}}</a></span>
                              <p class="mb-10">{{$comment->body}}</p>
                            </div>
                          </div>
                        </li>
                        @endforeach
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="cmt padDiv">
                    <form id="comment-form" method="post" action="{{ route('blog.comment',[$blog->slug]) }}" role="form">
                      @csrf
                      <div class="row">
                        <div class="col-lg-6">
                          <div class="form-group">
                            <input id="form_name" type="text" name="name" class="form-control" placeholder="Name *" required="required">
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group">
                            <input id="form_email" type="email" name="email" class="form-control" placeholder="email *" required="required">
                          </div>
                        </div>
                        <div class="col-lg-12">
                          <div class="form-group">
                            <textarea id="form_message" name="body" class="form-control" placeholder="Message *" style="height: 200px;" required="required"></textarea>
                          </div>
                        </div>
                        <div class="col-lg-12">
                          <input type="submit" class="btn btn-defeault btn-send" value="Comment">
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div><!-- End Blog Single -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  @include('Layouts.Public.Includes.footer')
  <!-- End Footer -->

  
  @include('Layouts.Public.Includes.js')
  @endsection



  
