<footer class="footer-area section_gap">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="single-footer-widget">
                    <h6 class="footer_title">Contact Information</h6>
                    <ul class="contact-information-footer">
                        <li><i class="fas fa-envelope"></i> <a href="mailto:xl@xlsofa.dk">xl@xlsofa.dk</a></li>
                        <li><i class="fas fa-phone"></i> <a href="tel:004542222842">0045 4222 2842</a></li>
                    </ul>
                    {{-- <p>@lang('layout.follow-us-sub-text')</p>
                    <div class="f_social">
                        <a href="#">
                            <i class="fa fa-facebook"></i>
                        </a>&nbsp;
                        <a href="#">
                            <i class="fa fa-twitter"></i>
                        </a>&nbsp;
                        <a href="#">
                            <i class="fa fa-dribbble"></i>
                        </a>&nbsp;
                        <a href="#">
                            <i class="fa fa-behance"></i>
                        </a>
                    </div> --}}
                </div>
            </div>

            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="single-footer-widget">
                    <h6 class="footer_title">Address</h6>
                    <p>XL Sofa</p>
                    <p>Vestergade 27, 7870 Roslev</p>
                    <p>Denmmark</p>
                    <p>CVR</p>
                    <br>
                    <a href="{{route('contact.get')}}" class="font-weight-bold">Write to Us</a>
                </div>
            </div>

            <div class="col-lg-5 col-md-6 col-sm-6">
                <div class="single-footer-widget f_social_wd">
                  <h6 class="footer_title">Showroom Opening Hours</h6>
                    <span>We always offer our customers to open the showroom outside the opening hours, contact us to arrange a visit to our showroom
                        <br>
                        <b>Monay - Thursday:</b> Open By Appointment<br>
                        <b>Friday & Saturady:</b> 12:00 - 17:00 <br>
                        <b>Sunday:</b> 12:00 - 15:00 
                    </span>
                </div>
                <div class="my-map">
                    <iframe class="w-75" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d2192.389060416527!2d9.0093097!3d56.6675592!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46497cbe6eafe25f%3A0x7dd6cd26484a7b04!2sVestergade%2027%2C%207870%20Roslev%2C%20Denmark!5e0!3m2!1sen!2seg!4v1612472079874!5m2!1sen!2seg" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                </div>
            </div>
        </div>
        <div class="row footer-bottom d-flex justify-content-between align-items-center">
            <p class="col-lg-12 footer-text text-center">
                @lang('layout.copyright') &copy; <script>document.write(new Date().getFullYear());</script> @lang('layout.copyright-2')</a>
            </p>
        </div>
    </div>
</footer>
