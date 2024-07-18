</html>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Login</title>

    <!-- Custom fonts for this template-->
    <link href="{{ url('assets/admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">


    <!-- Custom styles for this template-->
    <link href="{{ url('assets/admin/css/sb-admin-2.css') }}" rel="stylesheet">

    <link href="
https://cdn.jsdelivr.net/npm/sweetalert2@11.12.1/dist/sweetalert2.min.css
" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <style>
        .error {
            color: red
        }
    </style>
</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row"
                            style="background: url('https://shomedecor.vn/wp-content/uploads/2022/07/anh-lang-que-dep-1.jpg');background-position: center center;background-repeat: no-repeat;background-size: cover;">

                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 style="color: white" class="h4 text-white-900 mb-4">Chào mừng!</h1>
                                    </div>
                                    <form action="" id="formLogin" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <input type="email" name="email" id="email"
                                                class="form-control form-control-user" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address...">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" id="password" name="password"
                                                class="form-control form-control-user" placeholder="Password">
                                        </div>

                                        <button type="submit" id="submit-login-admin"
                                            class="btn btn-primary btn-user btn-block">
                                            Đăng nhập
                                        </button>
                                        <hr>
                                        <a href="index.html" class="btn btn-google btn-user btn-block">
                                            <i class="fab fa-google fa-fw"></i> Login with Google
                                        </a>
                                        <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                                        </a>
                                        <hr>

                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a style="color: white" class="small" href="forgot-password.html">Quên mật
                                            khẩu</a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.1/dist/sweetalert2.all.min.js "></script>


    <script>
        $(document).ready(function() {
            $('#formLogin').validate({
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
                    loginAdmin();
                }
            });

            function loginAdmin() {
                let email = $('#email').val();
                let password = $('#password').val();

                $.ajax({
                    type: "POST",
                    url: "{{ url('admin') }}",
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
                            window.location.href = "/admin/dashboard";
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
    </script>
</body>

</html>
