@extends('layout')
@section('content')
<div class="features_items"><!--features_items-->
	<h2 class="title text-center">Liên Hệ Với Chúng Tôi</h2>
	<div class="row">
        @foreach($contact as $key => $cont)
        <div class="col-md-12">
            {!!$cont -> info_contact!!}
            <div id="fb-root"></div>

            <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v15.0&appId=353299343441844&autoLogAppEvents=1" nonce="RMdniC14">

            </script>

            <div class="fb-page" data-href="https://www.facebook.com/tinhocngoisaolon/" data-tabs="message" data-width="" data-height="" data-small-header="false"

            data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/tinhocngoisaolon/"

            class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/tinhocngoisaolon/">TIN HỌC NGÔI SAO</a></blockquote>

            </div>
        </div>
        <div class="col-md-12">
            <h4>Bản Đồ</h4>
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3918.4205909626717!2d106.78290765057979!3d10.855580360657605!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!
                    4f13.1!3m3!1m2!1s0x3175276e812813e1%3A0x6e4c23af96c88480!2zVHJ1bmcgVMOibSDEkMOgbyBU4bqhbyBOaMOibiBM4buxYyBDaOG6pXQgTMaw4bujbmcgQ2FvIC0gSFVURUNI!5e0!3m2!1svi!
                    2s!4v1669258331072!5m2!1svi!2s" 
                width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </div>
    @endforeach
</div>
@endsection
