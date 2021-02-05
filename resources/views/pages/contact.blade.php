@include('layout.header', ['PageTitle' => __('titles.contact-us')])
<body>
    @include('layout.navbar')

    <section class="contact_area p_120 mt-5">
        <div class="container">
            <div class="row justify-content-center mb-4">
                <h1>Contact Us</h1>
            </div>
            <div class="row">
                <div class="col-lg-4" id="contact1">
                  
                </div>
                <div class="col-lg-8">
                    <form class="row contact_form" action="{{route('contact.post')}}" method="post">
                        @csrf
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" id="name" name="name" value="{{old('name' ?? '')}}" placeholder="@lang('pages.name-placeholder') *" required>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" id="email" name="email" value="{{old('email' ?? '')}}" placeholder="@lang('pages.email-placeholder') *" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="subject" name="subject" value="{{old('subject' ?? '')}}" placeholder="@lang('pages.subject-placeholder')">
                            </div>
                            <div class="form-group">
                              <input type="number" class="form-control" name="phone_number" value="{{old('phone_number' ?? '')}}" placeholder="@lang('pages.phone-number-placeholder') *" required>
                            </div>
                            <div class="form-group">
                                <select class="form-control" name="country" required>
                                    <option value="">@lang('pages.country-placeholder') *</option>
                                    <option value="Denmark">Denmark</option>
                                    <option value="Germany">Germany</option>
                                    <option value="Netherlands">Netherlands</option>
                                    <option value="Sweden">Sweden</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" name="post_number" value="{{old('post_number' ?? '')}}" placeholder="Post Number / PLZ and City">
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="message" id="message" rows="10" placeholder="@lang('pages.message-placeholder') *" required>{{old('message' ?? '')}}</textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn submit_btn">@lang('pages.send-message')</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-lg-4">
                    <div class="contact_info">
                        <div class="info_item">
                            <i class="lnr lnr-home"></i>
                            <h6>@lang('pages.location-1')</h6>
                            <p>@lang('pages.location-2')</p>
                        </div>
                        <div class="info_item">
                            <i class="lnr lnr-phone-handset"></i>
                            <h6>
                                <a href="tel:004542222842">+45 4222 2842</a>
                            </h6>
                            <p>@lang('pages.working-hours')</p>
                        </div>
                        <div class="info_item">
                            <i class="lnr lnr-envelope"></i>
                            <h6>
                                <a href="mailto:xl@xlsofa.dk">xl@xlsofa.dk</a>
                            </h6>
                            <p>@lang('pages.email-subheader')</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    @include('layout.footer')
    @include('layout.scripts')
</body>
</html>
