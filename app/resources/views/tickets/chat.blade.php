<!DOCTYPE html>
<html lang="fa">

<head>
    <title>چیت چت - قالب html پیام رسان - پیام رسانی</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="Chitchat">
    <meta name="keywords" content="Chitchat">
    <meta name="author" content="Chitchat">
    <link rel="icon" href="{{asset('assets/images/favicon/favicon.png')}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{asset('assets/images/favicon/favicon.png')}}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600,700,800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,300i,400,400i,500,500i,700,700i,900,900i&display=swap"
          rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/date-picker.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/magnific-popup.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}" media="screen" id="color">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/tour.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/js/ckeditor/skins/moono-lisa/editor.css?t=HBDD')}}">
    <link rel="stylesheet" type="text/css"
          href="{{asset('assets/js/ckeditor/plugins/scayt/skins/moono-lisa/scayt.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/js/ckeditor/plugins/scayt/dialogs/dialog.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{asset('assets/js/ckeditor/plugins/tableselection/styles/tableselection.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/js/ckeditor/plugins/wsc/skins/moono-lisa/wsc.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{asset('assets/js/ckeditor/plugins/copyformatting/styles/copyformatting.css')}}">
    <!-- Farsi fonts stylesheet ; for more information ; https://rastikerdar.github.io/vazirmatn/ -->
    <link rel="stylesheet" href="{{asset('assets/fonts/vazir/Farsi')}}-Digits/Vazirmatn-FD-font-face.css">
    <link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">
    <!-- Persian date-time picker -->
    <link rel="stylesheet" href="{{asset('assets/css/jquery.md')}}.bootstrap.datetimepicker.style.css">
    <style>
        .replies .media .media-body .contact-name,
        .replies .media .media-body .contact-name h5,
        .replies .media .media-body .contact-name h6 {
            direction: ltr;
            text-align: left;
        }

        .msg-setting-main .msg-dropdown-main .msg-dropdown {
            right: unset;
            left: 0;
            text-align: right;
        }

        .sent .media .media-body .msg-box .msg-setting-main .msg-dropdown-main .msg-dropdown ul li a {
            color: #595959;
            width: 100%;
            display: flex;
            flex-direction: row;
            align-content: space-between;
            justify-content: space-between;
        }

        .sent .media .media-body .msg-box .msg-setting-main .msg-dropdown-main .msg-dropdown ul li a i {
            font-size: 16px;
            display: inline;
            margin-left: 15px;
            margin-right: unset;
        }

        .replies .media .media-body .msg-box .msg-setting-main .msg-dropdown-main .msg-dropdown ul li a {
            color: #595959;
            width: 100%;
            display: flex;
            flex-direction: row-reverse;
            align-content: space-between;
            justify-content: space-between;
        }

        .replies .media .media-body .msg-box .msg-setting-main .msg-dropdown-main .msg-dropdown ul li a i {
            font-size: 16px;
            display: inline;
            margin-left: 15px;
            margin-right: unset;
        }

        .app-list-ul .title {
            border-bottom: 1px solid #eff1f2;
            padding-bottom: 15px;
            cursor: pointer;
            display: flex;
            flex-direction: column;
            align-content: center;
            justify-content: center;
            align-items: center;
        }

        .app-list-ul li {
            margin-bottom: 20px;
            display: flex;
            flex-direction: column;
            align-content: center;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>

<body class="rtl sidebar-active">
{{--<div class="chitchat-loader">--}}
{{--    <div><img src="{{asset('assets/images/logo/logo_big.png')}}" alt=""/>--}}
{{--        <h3>اپلیکیشنی سریع و ایمن برای پیام رسانی ..!</h3>--}}
{{--    </div>--}}
{{--</div>--}}

<div class="chitchat-container sidebar-toggle center">
    <div class="chitchat-main small-sidebar" id="content">
        <div class="chat-content tabto active">
            <div class="messages custom-scroll active" id="chating">
                <div class="contact-chat">
                    <ul class="chatappend">
                        <li class="sent">
                            <div class="media">
                                <div class="profile mr-4"><img class="bg-img" src="{{asset('assets/images/contact/2.jpg')}}" alt="Avatar" /></div>
                                <div class="media-body">
                                    <div class="contact-name">
                                        <h5>سعید مظفری</h5>
                                        <h6>01:42 صبح</h6>
                                        <ul class="msg-box">
                                            <li class="msg-setting-main">
                                                <h5>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم</h5>
                                                <div class="msg-dropdown-main">
                                                    <div class="msg-setting"><i class="ti-more-alt"></i></div>
                                                    <div class="msg-dropdown">
                                                        <ul>
                                                            <li><a href="#"><i class="fa fa-share"></i>فروارد</a></li>
                                                            <li><a href="#"><i class="fa fa-clone"></i>کپی</a></li>
                                                            <li><a href="#"><i class="fa fa-star-o"></i>امتیاز</a></li>
                                                            <li><a href="#"><i class="ti-trash"></i>حذف</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="replies">
                            <div class="media">
                                <div class="profile mr-4"><img class="bg-img" src="{{asset('assets/images/avtar/1.jpg')}}" alt="Avatar" /></div>
                                <div class="media-body">
                                    <div class="contact-name">
                                        <h5>الهام جعفری</h5>
                                        <h6>01:45 صبح</h6>
                                        <ul class="msg-box">
                                            <li class="msg-setting-main">
                                                <h5>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم</h5>
                                                <div class="msg-dropdown-main">
                                                    <div class="msg-setting"><i class="ti-more-alt"></i></div>
                                                    <div class="msg-dropdown">
                                                        <ul>
                                                            <li><a href="#"><i class="fa fa-share"></i>فروارد</a></li>
                                                            <li><a href="#"><i class="fa fa-clone"></i>کپی</a></li>
                                                            <li><a href="#"><i class="fa fa-star-o"></i>امتیاز</a></li>
                                                            <li><a href="#"><i class="ti-trash"></i>حذف </a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="messages custom-scroll" id="blank">
                <div class="contact-details">
                    <div class="row">
                        <form class="form-inline search-form">
                            <div class="form-group">
                                <input class="form-control-plaintext" type="search" placeholder="جستجو.." />
                                <div class="icon-close close-search"> </div>
                            </div>
                        </form>
                        <div class="col-7">
                            <div class="media left">
                                <div class="media-left mr-3">
                                    <div class="profile online menu-trigger"><img class="bg-img" src="{{asset('assets/images/contact/2.jpg')}}"
                                                                                  alt="Avatar" /></div>
                                </div>
                                <div class="media-body">
                                    <h5>سعید مظفری</h5>
                                    <h6>آخرین حضور؛ 5 ساعت پیش</h6>
                                </div>
                                <div class="media-right">
                                    <ul>
                                        <li><a class="icon-btn btn-light button-effect mute" href="#"><i class="fa fa-volume-up"></i></a>
                                        </li>
                                        <li><a class="icon-btn btn-light search search-right" href="#"> <i data-feather="search"></i></a>
                                        </li>
                                        <li><a class="icon-btn btn-light button-effect mobile-sidebar" href="#"><i
                                                    data-feather="chevron-left"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="message-input">
                    <input type="text" placeholder="پیام خود را اینجا بنویسید..." /><a
                        class="icon-btn btn-outline-primary button-effect mr-3 ml-3" href="#"><i data-feather="mic"> </i></a>
                    <button class="submit icon-btn btn-primary disabled" id="send-msg" disabled="disabled"><i
                            data-feather="send">
                        </i></button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{asset('assets/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('assets/js/owl.carousel.js')}}"></script>
<script src="{{asset('assets/js/popper.min.js')}}"></script>
<script src="{{asset('assets/js/tippy-bundle.iife.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.js')}}"></script>
<script src="{{asset('assets/js/switchery.js')}}"></script>
<script src="{{asset('assets/js/easytimer.min.js')}}"></script>
<script src="{{asset('assets/js/index.js')}}"></script>
<script src="{{asset('assets/js/feather-icon/feather.min.js')}}"></script>
<script src="{{asset('assets/js/feather-icon/feather-icon.js')}}"></script>
<script src="{{asset('assets/js/ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('assets/js/ckeditor/styles.js')}}"></script>
<script src="{{asset('assets/js/ckeditor/adapters/jquery.js')}}"></script>
<script src="{{asset('assets/js/ckeditor/ckeditor.custom.js')}}"></script>
<script src="{{asset('assets/js/date-picker/datepicker.js')}}"></script>
<script src="{{asset('assets/js/date-picker/datepicker.en.js')}}"></script>
<script src="{{asset('assets/js/date-picker/datepicker.custom.js')}}"></script>
<script src="{{asset('assets/js/tour/intro.js')}}"></script>
<script src="{{asset('assets/js/tour/intro-init.js')}}"></script>
<script src="{{asset('assets/js/jquery.magnific-popup.js')}}"></script>
<script src="{{asset('assets/js/zoom-gallery.js')}}"></script>
<script src="{{asset('assets/js/script.js')}}"></script>
<script src="{{asset('assets/js/jquery.md.bootstrap.datetimepicker.js')}}"></script>
<script>
    $(document).ready(function () {
        $(".datepicker-persian").MdPersianDateTimePicker({
            enableTimePicker: false, // set true if you want to enable time picking inputs in picker
            targetTextSelector: ".datepicker-persian",// target DOM element to display date-time to user
            textFormat: "yyyy-MM-dd",
            isGregorian: false,
            modalMode: true,// set false to enable popover mode instead modal
            englishNumber: false // set true if you want to show english digits
        });

        /*=====================
  05. Search js
  ==========================*/
        $(".search").on("click", function (e) {
            $(this).siblings().toggleClass("open");
            $(this).parent().find(".form-inline").toggleClass("open");
        });
        $(".close-search").on("click", function (e) {
            $(this).parent().parent().removeClass("open");
        });
        $(".search-right").on("click", function (e) {
            try {
                $(this)
                    .parent()
                    .parent()
                    .parent()
                    .parent()
                    .parent()
                    .find(".form-inline")
                    .toggleClass("open");
                $(this)
                    .parent()
                    .parent()
                    .parent()
                    .parent()
                    .parent()
                    .parent()
                    .find(".form-inline")
                    .toggleClass("open");
                $(this)
                    .parent()
                    .parent()
                    .parent()
                    .parent()
                    .parent()
                    .parent()
                    .parent()
                    .find(".form-inline")
                    .toggleClass("open");
            } catch (error) {
            }
        });
        $(".close-search").on("click", function (e) {
            $(this).parent().parent().removeClass("open");
        });

    });
</script>
</body>

</html>
