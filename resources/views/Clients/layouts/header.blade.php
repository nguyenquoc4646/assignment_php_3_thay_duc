    <!-- ======= Header ======= -->

    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

            <a href="/" class="logo d-flex align-items-center">
                <img src="/assets/client/assets/img/logo.png" alt="">
                <h1>ZenBlog</h1>
            </a>
            @php
                $categories = (new App\Models\CategoryModel())->getCategories();
            @endphp
            <nav id="navbar" class="navbar">
                <ul>

                    <li class="dropdown"><a href="{{ url('shop') }}"><span>Danh mục</span> <i
                                class="bi bi-chevron-down dropdown-indicator"></i></a>
                        <ul>
                            @foreach ($categories as $value)
                                <li><a href="{{ $value->slug }}">{{ $value->name }}</a></li>
                            @endforeach

                        </ul>
                    </li>


                </ul>
            </nav><!-- .navbar -->


            <div class="position-relative">


                <a href="#" class="mx-2 js-search-open"><span class="bi-search"></span></a>
                <!-- ======= Search Form ======= -->
                <div class="search-form-wrap js-search-form-wrap">
                    <form id="form" action="{{ url('search') }}" class="search-form" method="GET">
                        <span class="icon bi-search"></span>
                        <input id="input" name="keyword" type="text" placeholder="Search" class="form-control">
                        <button type="button" class="btn js-search-close"><span class="bi-x"></span></button>
                    </form>
                </div>
                @if (!empty(Auth::user()))
                    {{ Auth::user()->name }}
                    <a href="{{ url('logout_user') }}">Đăng xuất</a>
                @else
                    <span style="cursor: pointer;font-size:20px;" data-bs-toggle="modal" data-bs-target="#login"
                        class="bi bi-person-circle">
                @endif

            </div>
        </div>


    </header><!-- End Header -->

    <!-- Modal Đăng nhập -->
    <div class="modal fade" id="login" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="" id="exampleModalLabel">Đăng nhập</h1>
                    <button type="button" class="btn-close" id="btn_close_login" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formLoginUser" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Địa chỉ email</label>
                            <input placeholder="Nhập email..." type="email" name="email" class="form-control"
                                id="email" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Mật khẩu</label>
                            <input placeholder="Nhập mật khẩu..." type="password" id="password" name="password"
                                class="form-control" id="exampleInputPassword1">
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <button type="submit" class="btn btn-primary">Đăng nhập</button>
                                <a data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#forgot_password"
                                    href="{{ url('forgotPassword') }}">Quên mật khẩu?</a>
                            </div>
                            <div class="col-6">
                                <a id="login_link_register" href="#" data-bs-dismiss="modal"
                                    data-bs-toggle="modal" data-bs-target="#register">Đăng kí tài khoản ngay?</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Đăng kí -->
    <div class="modal fade" id="register" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title" id="exampleModalLabel">Đăng kí tài khoản</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
                <div class="modal-body">
                    <form action="" id="formRegisterUser" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="name_register" class="form-label">Tên người dùng</label>
                            <input placeholder="Nhập email..." type="text" class="form-control"
                                id="name_register" name="name_register" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="email_register" class="form-label">Địa chỉ email</label>
                            <input placeholder="Nhập email..." type="email" class="form-control"
                                id="email_register" name="email_register" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="password_register" class="form-label">Mật khẩu</label>
                            <input placeholder="Nhập mật khẩu..." type="password" id="password_register"
                                name="password_register" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="confirm_password_register" class="form-label">Xác nhận mật khẩu</label>
                            <input placeholder="Nhập mật khẩu..." type="password" id="confirm_password_register"
                                name="confirm_password_register" class="form-control">
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <button type="submit" class="btn btn-primary">Đăng kí</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- quên mật khẩu --}}
    <div class="modal fade" id="forgot_password" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title" id="exampleModalLabel">Quên mật khẩu</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
                <div class="modal-body">
                    <form action="" id="formForgotPassword" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="email_forgot_password" class="form-label">Địa chỉ email</label>
                            <input placeholder="Nhập email..." type="text" class="form-control"
                                id="email_forgot_password" name="email_forgot_password" aria-describedby="emailHelp">
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <button type="submit" class="btn btn-primary">Gửi</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.1/dist/sweetalert2.all.min.js "></script>
    <script>
        $(document).ready(function() {
            $('#formLoginUser').validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,

                    },
                },
                messages: {
                    email: {
                        required: "Trường này bắt buộc nhập.",
                        email: "Email không đúng định dạng"
                    },
                    password: {
                        required: "Trường này bắt buộc nhập.",
                    }
                },
                submitHandler: function(form) {
                    loginUser();
                }
            });

            function loginUser() {
                let email = $('#email').val();
                let password = $('#password').val();

                $.ajax({
                    type: "POST",
                    url: "{{ url('login_user') }}",
                    data: {
                        '_token': "{{ csrf_token() }}",
                        email: email,
                        password: password
                    },
                    dataType: 'json',
                    success: function(res) {
                        if (res.status == false) {
                            Swal.fire({
                                icon: "error",
                                title: "Đăng nhập không thành công",
                                text: res.message
                            });
                        } else {
                            Swal.fire({
                                icon: "success",
                                title: "Đăng nhập thành công",
                                text: res.message
                            });
                            window.location.href = "/";
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        Swal.fire({
                            icon: "error",
                            title: "Đã xảy ra lỗi",
                            text: "Đã xảy ra lỗi trong quá trình xử lý yêu cầu. Vui lòng thử lại sau."
                        });
                    }
                });
            }
        });

        $(document).ready(function() {
            $('#formRegisterUser').validate({
                rules: {
                    name_register: {
                        required: true,
                    },
                    email_register: {
                        required: true,
                        email: true
                    },
                    password_register: {
                        required: true,
                    },
                    confirm_password_register: {
                        required: true,
                        equalTo: "#password_register"
                    },
                },
                messages: {

                    name_register: {
                        required: "Trường này bắt buộc nhập.",
                    },
                    email_register: {
                        required: "Trường này bắt buộc nhập.",
                        email: "Email không đúng định dạng"
                    },
                    password_register: {
                        required: "Trường này bắt buộc nhập.",
                    },
                    confirm_password_register: {
                        required: "Trường này bắt buộc nhập.",
                        equalTo: "Mật khẩu không trùng khớp, vui lòng thử lại!"
                    },
                },
                submitHandler: function(form) {
                    registerUser();
                }
            });

            function registerUser() {

                let name_register = $('#name_register').val();
                let email_register = $('#email_register').val();
                let password_register = $('#password_register').val();
                let confirm_password_register = $('#confirm_password_register').val();

                $.ajax({
                    type: "POST",
                    url: "{{ url('register_user') }}",
                    data: {
                        '_token': "{{ csrf_token() }}",
                        name: name_register,
                        email: email_register,
                        password: password_register,
                        re_password: confirm_password_register
                    },
                    dataType: 'json',
                    success: function(res) {
                        if (res.status == false) {
                            Swal.fire({
                                icon: "error",
                                title: "Đăng kí không thành công",
                                text: res.message
                            });
                        } else {
                            Swal.fire({
                                icon: "success",
                                title: "Thành công",
                                text: 'Đăng kí hoàn tất, vui lòng kiểm tra và xác minh tài khoản email'
                            }).then(() => {
                                location.reload();
                            });


                        }
                    },

                    error: function(err) {
                        Swal.fire({
                            icon: "error",
                            title: "Lỗi hệ thống!",
                            text: 'Lỗi do hệ thống, vui lòng thử lại sau.'
                        })
                    }

                });
            }

            $('#login').on('click', function() {
                $('#register').modal('hide');
                $('#forgot_password').modal('hide');
            })
            $('#register').on('click', function() {
                $('#login').modal('hide');
                $('#forgot_password').modal('hide');
            })
            $('#forgot_password').on('click', function() {
                $('#login').modal('hide');
                $('#register').modal('hide');
            })
        });

        $(document).ready(function() {
            $('#formForgotPassword').validate({
                rules: {
                    email_forgot_password: {
                        required: true,
                        email: true
                    },
                },
                messages: {
                    email_forgot_password: {
                        required: "Trường này bắt buộc nhập.",
                        email: "Email không đúng định dạng"
                    },

                },
                submitHandler: function(form) {
                    forgot_password()
                }
            });

            function forgot_password() {
                let email = $('#email_forgot_password').val();

                $.ajax({
                    type: "POST",
                    url: "{{ url('forgot_password') }}",
                    data: {
                        '_token': "{{ csrf_token() }}",
                        email: email,
                    },
                    dataType: 'json',
                    success: function(res) {
                        if (res.status == true) {
                            Swal.fire({
                                icon: "success",
                                title: "Thành công!",
                                text: res.message
                            })
                            .then(() => {
                                $('#forgot_password').modal('hide');
                                $('.modal-backdrop').remove();
                            });
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: "Lỗi!",
                                text: 'Địa chỉ email không tồn tại!'
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        Swal.fire({
                            icon: "error",
                            title: "Đã xảy ra lỗi",
                            text: "Đã xảy ra lỗi trong quá trình xử lý yêu cầu. Vui lòng thử lại sau."
                        });
                    }
                });
            }
        })
    </script>
