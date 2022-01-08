<div id="contact" class="paddsection">
    <div class="container">
    <div class="contact-block1">
        <div class="row">

        <div class="col-lg-6">
            <div class="contact-contact">

            <h2 class="mb-30">GET IN TOUCH</h2>

            <ul class="contact-details">
                <li><span>Tom Mboya Street</span></li>
                <li><span>Mombasa, Kenya</span></li>
                <li><span>+254 797 539 875</span></li>
                <li><span>dennisokanga@geration700.co.ke</span></li>
            </ul>

            </div>
        </div>

        <div class="col-lg-6">
                @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>{{ session('success') }}</strong>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                @endif
            <form action="{{ route('contact') }}" method="post" role="form" class="php-email-form">
            @csrf
            <div class="row gy-3">

                <div class="col-lg-6">
                <div class="form-group contact-block1">
                    <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
                </div>
                </div>

                <div class="col-lg-6">
                <div class="form-group">
                    <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                </div>
                </div>

                <div class="col-lg-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
                </div>
                </div>

                <div class="col-lg-12">
                <div class="form-group">
                    <textarea class="form-control" name="message" placeholder="Message" required></textarea>
                </div>
                </div>

                <div class="col-lg-12">
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">Your message has been sent. Thank you!</div>
                </div>

                <div class="mt-0">
                <input type="submit" class="btn btn-defeault btn-send" value="Send message">
                </div>

            </div>
            </form>
        </div>
        </div>
    </div>
    </div>
</div>