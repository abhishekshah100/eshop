@extends('frontend.other_theme')
@section('content')
<x-breadcrumb heading="Contact" />
<!-- product tab start -->
<div class="map">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d447986.8531463029!2d76.81115099336583!3d28.69271888103785!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390d047309fff32f%3A0xfc5606ed1b5d46c3!2sDelhi!5e0!3m2!1sen!2sin!4v1608124864328!5m2!1sen!2sin" width="800" height="600" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
</div>

<section class="contact-section pt-80 pb-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-12 mb-30">
                <!--  contact page side content  -->
                <div class="contact-page-side-content">
                    <h3 class="contact-page-title">Contact Us</h3>
                    <p class="contact-page-message mb-30">Claritas est etiam processus dynamicus, qui sequitur
                        mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum
                        claram anteposuerit litterarum formas human.</p>
                    <!--  single contact block  -->

                    <div class="single-contact-block">
                        <h4><i class="fa fa-fax"></i> Address</h4>
                        <p>123 Main Street, Anytown, CA 12345 – USA</p>
                    </div>

                    <!--  End of single contact block -->

                    <!--  single contact block -->

                    <div class="single-contact-block">
                        <h4><i class="fa fa-phone"></i> Phone</h4>
                        <p>
                            <a href="tel:123456789">Mobile: (08) 123 456 789</a>
                        </p>
                        <p><a href="tel:1009678456">Hotline: 1009 678 456</a></p>
                    </div>

                    <!-- End of single contact block -->

                    <!--  single contact block -->

                    <div class="single-contact-block">
                        <h4><i class="fas fa-envelope"></i> Email</h4>
                        <p>
                            <a href="mailto:yourmail@domain.com">yourmail@domain.com</a>
                        </p>
                        <p> <a href="mailto:support@hastech.company">support@hastech.company</a></p>
                    </div>

                    <!--=======  End of single contact block  =======-->
                </div>

                <!--=======  End of contact page side content  =======-->

            </div>
            <div class="col-lg-6 col-12 mb-30">
                <!--  contact form content -->
                <div class="contact-form-content">
                    <h3 class="contact-page-title">Tell Us Your Message</h3>
                    <div class="contact-form">
                        <form id="contact-form" action="{{ route('store-contact') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Your Name <span class="required">*</span></label>
                                <input type="text" name="contact_name" id="customername" value="{{ old('contact_name') }}">
                            </div>
                            <div class="form-group">
                                <label>Your Email <span class="required">*</span></label>
                                <input type="email" name="contact_email" id="customerEmail" value="{{ old('contact_email') }}">
                            </div>
                            <div class="form-group">
                                <label>Contact No<span class="required">*</span></label>
                                <input type="text" name="contact_no" id="contactSubject" value="{{ old('contact_no') }}">
                            </div>
                            <div class="form-group">
                                <label>Your Message</label>
                                <textarea name="contact_message" class="pb-10" id="contactMessage"
                                    > {{ old('contact_message') }}</textarea>
                            </div>
                            <div class="form-group mb-0">
                                <button type="submit" value="submit" id="submit" class="btn theme-btn--dark1 btn--lg"
                                    name="submit">submit</button>
                            </div>
                        </form>
                    </div>
                    <p class="form-messegemt-10"></p>
                </div>
                <!-- End of contact -->
            </div>
        </div>
    </div>
</section>
<!-- product tab end -->

@endsection