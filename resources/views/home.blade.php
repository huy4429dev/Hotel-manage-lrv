<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Trang chủ</title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v5.12.1/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
    

    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <style>
        .masthead-subheading{
            font-weight: 400;
            color: #D5A576;
            font-style: normal;
            letter-spacing: 6px;

                       
        }
    </style>
</head>

<body id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand js-scroll-trigger" href="#page-top">SEA HOTEL </a><button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">Menu<i class="fas fa-bars ml-1"></i></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav text-uppercase ml-auto">
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#services">Dịch Vụ</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#portfolio">Tin tức</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#about">Giới thiệu</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#team">Thành viên</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#contact">Liên Hệ</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Masthead-->
    <header class="masthead">
    
        <div class="container f-over">
            <div class="masthead-heading text-uppercase">Chào mừng đến với SEAHOTEL</div>
            <div class='flex'>  <div class='border-line'></div>
            <div class="masthead-subheading">HOTEL & RESORTS</div><div class='border-line'></div></div>  
            
        </div>
        <div class="overlay"></div>
        
    </header>
    <!-- Services-->
    <section class="page-section" id="services">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">DỊCH VỤ</h2>
                <h3 class="section-subheading text-muted">KHÁCH SẠN HÀNG ĐẦU CỬA LÒ</h3>
            </div>
            <div class="row text-center">
                <div class="col-md-4">
                    <span class="fa-stack fa-4x"><i class="fas fa-circle fa-stack-2x text-primary"></i><i class="fas fa-utensils fa-stack-1x fa-inverse"></i></span>
                    <h4 class="my-3">Những trải nghiệm đáng nhớ cùng kỳ nghỉ sang trọng tại SEAHotel</h4>
                    <p class="text-muted">Nằm bên bờ Biển Cửa Lò, SEAHotel mang đến cảm giác yên bình. Tọa lạc ngay trong thị xã Cửa Lò, từ khách sạn SEAHotel bạn có thể dễ dàng khám khá những điểm đến hấp dẫn của Cửa Lò.</p>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x"><i class="fas fa-circle fa-stack-2x text-primary"></i><i class="fas fa-heart fa-stack-1x fa-inverse"></i></span>
                    <h4 class="my-3">Tại khách sạn SEAHotel chúng tôi phục vụ bằng cả trái tim!</h4>
                    <p class="text-muted">Tại khách sạn SEAHotel, đội ngũ nhân viên thân thiện và chuyên nghiệp của chúng tôi luôn sẵn sàng phục vụ quý khách với “lòng hiếu khách và yêu mến chân thành”.</p>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x"><i class="fas fa-circle fa-stack-2x text-primary"></i><i class="fas fa-hotel fa-stack-1x fa-inverse"></i></span>
                    <h4 class="my-3">Nơi nghỉ dưỡng sang trọng hoàn hảo cho kỳ nghỉ của bạn tại Cửa Lò</h4>
                    <p class="text-muted">Được trang bị hiện đại với tiện nghi sang trọng và tinh tế trong một không gian hài hòa với hướng nhìn ra biển, SeaHotel là nơi nghỉ dưỡng mang đến nhiều lựa chọn phù hợp với từng nhu cầu nghỉ dưỡng và ngân sách của bạn.</p>
                </div>
            </div>
        </div>
    </section>
    <!-- Portfolio Grid-->
    <section class="page-section bg-light" id="portfolio">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">TIN TỨC</h2>
                <h3 class="section-subheading text-muted"></h3>
            </div>
            <div class="row">
                @if(!$posts->isEmpty())

                @foreach($posts as $post)
                <div class="col-lg-4 col-sm-6 mb-4">
                    <div class="portfolio-item">
                        <a class="portfolio-link" data-toggle="modal" href="#portfolioModal{{$post->id}}">
                            <div class="portfolio-hover">
                                <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                            </div>
                            <img class="img-set img-fluid" src="{{$post->hinh_anh}}" alt="" />
                        </a>
                        <div class="portfolio-caption">
                            <div class="portfolio-caption-heading">{{$post->tieu_de}}</div>
                            <div class="portfolio-caption-subheading text-muted">{{$post->user->name}}</div>
                        </div>
                    </div>
                </div>
                @endforeach
                @else
                <div class="alert alert-warning text-center w-100">Chưa có bài viết nào</div>
                @endif
            </div>
        </div>
    </section>
    <!-- About-->
    <section class="page-section" id="about">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">GIỚI THIỆU</h2>
                <h3 class="section-subheading text-muted">Với 265 phòng nghỉ và Trung tâm hội nghị lớn nhất thị xã, Hotels & Resorts SEA là sự lựa chọn hoàn hảo cho khách muốn lưu trú và là nơi lý tưởng để tổ chức đa dạng các sự kiện</h3>
            </div>
            <ul class="timeline">
                <li>
                    
                    <div class="timeline-image" ><img class="rounded-circle img-fluid" src="assets/img/about/ks14.jpg" alt="" /></div>
                    <div class="timeline-panel">
                        <div class="timeline-heading">
                            <h4></h4>
                            <h4 class="subheading">Tổ chức sự kiện</h4>
                        </div>
                        <div class="timeline-body">
                            <p class="text-muted">Sở hữu phòng đại tiệc lớn nhất thị xã Cửa Lò và những phòng chức năng đa dạng, Khách sạn SEAHotel chính là sự lựa chọn hoàn hảo cho tất cả những sự kiện của cá nhân cũng như của công ty.</p>
                        </div>
                    </div>
                </li>
                <li class="timeline-inverted">
                    <div class="timeline-image"><img class="rounded-circle img-fluid" src="assets/img/about/ks15.jpg" alt="" /></div>
                    <div class="timeline-panel">
                        <div class="timeline-heading">
                            <h4></h4>
                            <h4 class="subheading">Ẩm thực</h4>
                        </div>
                        <div class="timeline-body">
                            <p class="text-muted">Ẩm thực châu Á -Europe với các món ăn truyền thống Việt Nam được tạo ra thực đơn đa dạng của nhà hàng. Không gian của nhà hàng vô cùng thanh lịch với tông màu tươi sáng .</p>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="timeline-image"><img class="rounded-circle img-fluid" src="assets/img/about/ks16.jpg" alt="" /></div>
                    <div class="timeline-panel">
                        <div class="timeline-heading">
                            <h4></h4>
                            <h4 class="subheading">Tiêu chuẩn 5 sao</h4>
                        </div>
                        <div class="timeline-body">
                            <p class="text-muted">Khách sạn cung cấp những dịch vụ hoàn hảo tiêu chuẩn 5 sao với giá trị vượt trên cả mong đợi, chúng tôi không chỉ mang đến cho khách du lịch một kỳ nghỉ thoải mái ..</p>
                        </div>
                    </div>
                </li>
                <li class="timeline-inverted">
                    <div class="timeline-image"><img class="rounded-circle img-fluid" src="assets/img/about/ks17.jpg" alt="" /></div>
                    <div class="timeline-panel">
                        <div class="timeline-heading">
                            <h4></h4>
                            <h4 class="subheading">Danh Sách Phòng</h4>
                        </div>
                        <div class="timeline-body">
                            <p class="text-muted">Hiện đại và tiện nghi, với diện tích từ 34 m2, tất cả các phòng đều có ban công và tầm nhìn toàn cảnh ra thị xã Cửa Lò</p>
                        </div>
                    </div>
                </li>
                <li class="timeline-inverted">
                    <div class="timeline-image">
                        <h4>Be Part<br />Of Our<br />Story!</h4>
                    </div>
                </li>
            </ul>
        </div>
    </section>
    <!-- Team-->
    <section class="page-section bg-light" id="team">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">QUẢN TRỊ</h2>
                <h3 class="section-subheading text-muted">Giám đốc và CBNV</h3>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="team-member">
                        <img class="mx-auto rounded-circle" src="assets/img/team/giphy.gif" alt="" />
                        <h4>Kayn</h4>
                        <p class="text-muted">CEO</p>
                        <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-twitter"></i></a><a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-facebook-f"></i></a><a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="team-member">
                        <img class="mx-auto rounded-circle" src="assets/img/team/y.jpg" alt="" />
                        <h4>Riven</h4>
                        <p class="text-muted">CTO</p>
                        <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-twitter"></i></a><a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-facebook-f"></i></a><a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="team-member">
                        <img class="mx-auto rounded-circle" src="assets/img/team/t.gif" alt="" />
                        <h4>Shen</h4>
                        <p class="text-muted">CGO</p>
                        <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-twitter"></i></a><a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-facebook-f"></i></a><a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <p class="large text-muted"></p>
                </div>
            </div>
        </div>
    </section>
    <!-- Clients-->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6 my-3">
                    <a href="#!"><img class="img-fluid d-block mx-auto" src="assets/img/logos/envato.jpg" alt="" /></a>
                </div>
                <div class="col-md-3 col-sm-6 my-3">
                    <a href="#!"><img class="img-fluid d-block mx-auto" src="assets/img/logos/designmodo.jpg" alt="" /></a>
                </div>
                <div class="col-md-3 col-sm-6 my-3">
                    <a href="#!"><img class="img-fluid d-block mx-auto" src="assets/img/logos/themeforest.jpg" alt="" /></a>
                </div>
                <div class="col-md-3 col-sm-6 my-3">
                    <a href="#!"><img class="img-fluid d-block mx-auto" src="assets/img/logos/creative-market.jpg" alt="" /></a>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact-->
    <section class="page-section" id="contact">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">LIÊN HỆ</h2>
                <h3 class="section-subheading text-muted">Ý kiến của bạn là góp phần cho sự phát triển của chúng tôi</h3>
            </div>
            <form id="contactForm" name="sentMessage" novalidate="novalidate" method="POST">
                <div class="row align-items-stretch mb-5">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input class="form-control" id="ho_ten" type="text" placeholder="Họ tên *" required="required" data-validation-required-message="Vui lòng nhập họ tên" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="form-group">
                            <input class="form-control" id="email" type="email" placeholder="Email *" required="required" data-validation-required-message="Vui lòng nhập email" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="form-group">
                            <input class="form-control" id="so_dien_thoai" type="tel" placeholder="Số điện thoại *" required="required" data-validation-required-message="Vui lòng nhập số điện thoại" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="form-group mb-md-0">
                            <input class="form-control" id="chu_de" type="text" placeholder="Chủ đề*" required="required" data-validation-required-message="Vui lòng nhập chủ đề" />
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-group-textarea mb-md-0">
                            <textarea class="form-control" id="noi_dung" placeholder="Nội dung *" required="required" data-validation-required-message="Vui lòng nhập 9nội dung" name="noi_dung"></textarea>
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <div id="success"></div>
                    <button id="myBtn" class="btn btn-primary btn-xl text-uppercase" id="sendMessageButton" type="submit">Gửi liên hệ</button>
                </div>
            </form>
        </div>
    </section>
    <!-- Footer-->
    <footer class="footer py-4">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4 text-lg-left">Copyright © Your Website 2020</div>
                <div class="col-lg-4 my-3 my-lg-0">
                    <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-twitter"></i></a><a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-facebook-f"></i></a><a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <div class="col-lg-4 text-lg-right"><a class="mr-3" href="#!">Privacy Policy</a><a href="#!">Terms of Use</a></div>
            </div>
        </div>
    </footer>

    @if(!$posts->isEmpty())
    @foreach($posts as $post)
    <div class="portfolio-modal modal fade" id="portfolioModal{{$post->id}}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-modal" data-dismiss="modal"><img src="assets/img/close-icon.svg" /></div>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="modal-body">
                                <!-- Project Details Go Here-->
                                <h2 class="text-uppercase">{{$post->tieu_de}}</h2>
                                <p class="item-intro text-muted">{{$post->mo_ta}}.</p>
                                <img class="img-fluid d-block mx-auto"  src="{{$post->hinh_anh}}" alt="" />
                                {!!$post->noi_dung!!}
                                <ul class="list-inline">
                                    <li>Ngày đăng:  <span>{{date('d - m - y', strtotime($post->created_at))}} </span></li>
                                    <li>Tác giả: <span>{{$post->user->name}}</span></li>
                                </ul>
                                <button class="btn btn-primary" data-dismiss="modal" type="button"><i class="fas fa-times mr-1"></i>Close Project</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    @endif
    <div id="myModal" class="modal">

        <!-- Modal content -->
        <div class="modal-content alert alert-success">
            <span class="close" style="cursor: pointer">&times;</span>
            <p class="text-center">Gửi liên hệ thành công</p>
        </div>

    </div>
    <!-- Bootstrap core JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <!-- Third party plugin JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <!-- Contact form JS-->
    <script src="assets/mail/jqBootstrapValidation.js"></script>
    <!-- <script src="assets/mail/contact_me.js"></script> -->
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
    <script>
        var modal = document.getElementById("myModal");
        var modalContent = document.querySelector("#myModal p");

        var btn = document.getElementById("myBtn");

        var span = document.getElementsByClassName("close")[0];

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }


        span.onclick = function() {
            modal.style.display = "none";
        }

        let checkRiquired = (input) => {

            if (input == '') {
                return false;
            }

            return true;

        }

        btn.addEventListener('click', function(event) {

            event.preventDefault();

            let name = document.querySelector('#ho_ten').value;
            let email = document.querySelector('#email').value;
            let phone = document.querySelector('#so_dien_thoai').value;
            let subject = document.querySelector('#chu_de').value;
            let content = document.querySelector('#noi_dung').value;

            if (!(checkRiquired(name) && checkRiquired(email) && checkRiquired(phone) && checkRiquired(subject) && checkRiquired(content))) {
                modalContent.innerText = "Vui lòng nhập đầy đủ thông tin";
                modalContent.style.color = 'red';
                modal.style.display = "block";
                return false;
            }


            const url = '{{url("/contact")}}';

            const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            console.log(csrf);


            const data = {
                ho_ten: name,
                email: email,
                so_dien_thoai: phone,
                chu_de: subject,
                noi_dung: content,
            };

            fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrf
                    },
                    body: JSON.stringify(data)
                })
                .then(response => response.json())
                .then(data => {

                    modalContent.innerText = "Gửi liên hệ thành công";
                    modalContent.style.color = 'green';
                    modal.style.display = "block";

                })
                .catch(err => console.log(err));

        })
    </script>
</body>

</html>