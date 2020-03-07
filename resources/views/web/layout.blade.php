<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=0.80, shrink-to-fit=no">
    <title>CV World</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ url('assets/web/css/web.app.css') }}"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="image/x-icon"
          href="{{url('')}}/assets/web/img/Icons/fav_icon.png">
    <script>
        window.App = {'locale': '{{ app()->getLocale() }}'};
    </script>
</head>
<body>
<!-- Start Nave -->
@include('web.navbar')
<!-- End Nave -->

@yield('content')



<!-- start footer -->
<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="foot-content1">
                    <img src="{{url('')}}/assets/web/img/Icons/logo_ar_white.png" alt="">
                    <p>خدمات جديدة ومبتكرة في عالم التوظيف نسعى لتحقيق تجربة وظيفية أفضل</p>

                </div>
            </div>
            <div class="col-md-4">
                <div class="foot-header">
                    <h2>خريطة الموقع</h2>
                </div>
                <div class="row">
                    <div class="col-md-6 col-6">
                        <ul class="list-unstyled list">
                            <li>
                                <a href="">الرئيسية</a>
                            </li>
                            <li>
                                <a href="">تصفح السير</a>
                            </li>
                            <li>
                                <a href="">مكاتب العمل</a>
                            </li>
                            <li>
                                <a href="">المدونة</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6 col-6">
                        <ul class="list-unstyled list">
                            <li>
                                <a href="">الابلاغ عن مشكلة</a>
                            </li>
                            <li>
                                <a href="">الحماية و الخصوصية</a>
                            </li>
                            <li>
                                <a href="">الشروط و الاحكام</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="foot-header">
                    <h2>التواصل الاجتماعي</h2>
                </div>
                <div class="row">
                    <div class="img-footer mt-3">
                        <a target="_blank" href="https://www.facebook.com/cv.world1/">
                            <img src="{{url('')}}/assets/web/img/Icons/facebook.png" alt="">
                        </a>
                        <a target="_blank" href="#">
                            <img src="{{url('')}}/assets/web/img/Icons/linkedin.png" alt="">
                        </a>
                        <a target="_blank" href="https://twitter.com/Cv_World1">
                            <img src="{{url('')}}/assets/web/img/Icons/twitter.png" alt="">
                        </a>
                        <a target="_blank" href="https://www.instagram.com/cv.world1/?hl=en">
                            <img src="{{url('')}}/assets/web/img/Icons/instgram.png" alt="">
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="img-footer">
                        <a target="_blank" href="https://www.youtube.com/channel/UCXSVwvgNE6i9MaMI3uJIM8w">
                            <img src="{{url('')}}/assets/web/img/Icons/youtube.png" alt="">
                        </a>
                        <img src="{{url('')}}/assets/web/img/Icons/behance.png" alt="">
                        <img src="{{url('')}}/assets/web/img/Icons/pinterest.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright">
        <p>جميع الحقوق محفوظة CV World </p>
    </div>
</footer>
<!-- end footer -->
<script src="{{ url('assets/web/js/web.app.js') }}"></script>
<script>
    $('#parent_location').on('change', function () {
        var parent = this.value;
        $.ajax({
            url: '{{ route("api.locations") }}',
            type: 'get',
            data: {_token: '{{ csrf_token() }}', 'parent': parent},
            success: function (data) {
                var html = '<option value ="">{{ trans("select_city") }}</option>';
                var i;
                for (i = 0; i < data.length; i++) {
                    html +=
                        '<option value ="' + data[i].id + '" >' + data[i].name + '</option>';
                }
                $('#location_id').html(html);
            },
            error: function () {
            }
        });
    });
</script>
@if(auth()->user())
    <script type="text/javascript">
        $(document).ready(function () {
            $('.job').on('click', function () {
                var job_id = $(this).attr('value');
                var user_id = '{{auth()->user()->id}}';
                $.ajax({
                    url: '{{route("owner.addSeekerToJob")}}',
                    type: 'post',
                    data: {_token: '{{ csrf_token() }}', 'job_id': job_id, 'user_id': user_id},

                    success: function (data) {
                        console.log('success');
                    },
                    error: function () {
                        console.log('error');
                    }
                });
            });
        });
    </script>
@endif
<script type="text/javascript">
    $(document).ready(function () {
        const emailValidation = document.querySelector('#email');
        const mailFormat = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        emailValidation.addEventListener('keyup', e => {
            var alert1 = document.getElementById('emailError');

            if (emailValidation.value.match(mailFormat)) {
                $.ajax({
                    type: 'get',
                    url: '{{route("web.validation")}}',
                    _token: "{{ csrf_token() }}",
                    data: {
                        'email': emailValidation.value,
                    },
                    success: function (data) {
                        alert1.style.visibility = "visible";
                        alert1.textContent = "valid email";
                    },
                    error: function (error) {
                        alert1.style.visibility = "visible";
                        alert1.textContent = "email already taken";
                    }
                });
            } else {
                alert1.style.visibility = "visible";
                alert1.textContent = "invalid email ";
            }
        });
    });

</script>


<script>
    (function ($) {
        $(document).ready(function () {
            $(".user-box-chat").click(function () {

                if (!$(this).hasClass("active")) {
                    $(".user-box-chat").removeClass("active");
                    $(this).addClass("active");
                    var str = $(this).attr("id");
                    var ids = str.split("_");
                    var chat_id = ids[0];
                    var user_id = ids[1];

                    $("#send_messaged_input_chat_id").val(chat_id);
                    $.ajax({
                        url: '{{route("web.chat.messages_user")}}',
                        data: {
                            chat_id: chat_id,
                            user_id: user_id
                        },
                        success: function (data) {

                            if (data.status) {
                                $(".content-chat").html(data.result);
                            }
                        }
                    });
                }
            });

            $("#btn_send_message").click(function (e) {
                var user_id = $("#send_messaged_input_chat_id").val();
                $.ajax({
                    url: '{{route("web.chat.add_message")}}',
                    type: "get",
                    data: $("#send_new_message").serialize(),
                    success: function (data) {

                        if (data.status) {
                            $(".content-chat").append(data.result);
                            $("#msg_text").val("");
                            if (data.isNew) {
                                $("#send_messaged_input_chat_id").attr("f_name", "chat_id");
                                $("#send_messaged_input_chat_id").val(data.chat_id);
                                $(".new_receiver").attr("id", data.chat_id + "_" + user_id);
                                $(".user-box-chat").removeClass("new_receiver");
                            }
                        }
                    },
                    error: function (data) {
                        console.log(data);
                    }
                });
            });

        }); //End Document.Ready
    })(jQuery);

</script>
@yield('scripts')


</body>

</html>



