@extends('customerViews.layouts.customercontact')
@section('content')
    <section class="hero" style="display: flex; flex-direction: column; padding: 100px 80px;">
        <div class="background-image"></div>
        <div class="hero-content-area">
            <h1>Drop Us a Mail</h1>
            <h3>If you have any questions about our services, please do not hesitate to contact us.</h3>
            <a href="#contact" class="btn">Send Us a Message</a>
        </div>
    </section>

    <br><br>
    <section class="section2 clearfix" id="contact">
        <div class="col2 column1 first" id="map" style="padding-left:50%;">
            <script src="{{ URL::asset('js/customer/contact-map.js') }}"></script>
            <script async src="https://maps.googleapis.com/maps/api/js?key={{ env('MAPPING_API_KEY') }}&callback=initMap"></script>
        </div>

        <div class="col2 column2 last" style="background-color: #fff;">
            <div class="sec2innercont">
                <div class="sec2addr" style="color:#000; font-weight: bold; text-align: left; ">
                    <a id='#contact'></a>
                    <img src="{{ URL::asset('images/mrjams/logowithname.png') }}" class="center">
                    <p>Taguig City, Metro Manila Philippines</p>
                    <p><span class="collig">Phone :</span> +63 1234567890</p>
                    <p><span class="collig">Email :</span> mrjams.tup@gmail.com</p>
                </div>
            </div>

            <div class="sec2contactform">
                <h3 class="sec2frmtitle">Want to Know More?? Drop Us a Mail</h3>
                <form action="">

                    <div class="clearfix">
                        <input class="col2 first" type="text" placeholder="FirstName">
                        <input class="col2 last" type="text" placeholder="LastName">
                    </div>

                    <div class="clearfix">
                        <input class="col2 first" type="Email" placeholder="Email">
                        <input class="col2 last" type="text" placeholder="Contact Number">
                    </div>

                    <div class="clearfix">
                        <textarea name="textarea" id="" cols="30" rows="7">Your message here...</textarea>
                    </div>

                    <div class="clearfix"><input type="submit" value="Send"></div>
                </form>
            </div>

        </div>
    </section>

    <br><br><br><br>
@endsection
