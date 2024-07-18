<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Hello, world!</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js"
        integrity="sha512-WMEKGZ7L5LWgaPeJtw9MBM4i5w5OSBlSjTjCtSnvFJGSVD26gE5+Td12qN5pvWXhuWaWcVwF++F7aqu9cvqP0A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.2/dist/sweetalert2.min.css" rel="stylesheet">


</head>
<style>
    body{
        background: url('https://t3.ftcdn.net/jpg/05/52/20/98/360_F_552209893_vXBU90Mj9zxsPV6xWHMG1giaKms7odKo.jpg');
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }
    .error {
        color: red;
    }

    .container {
        max-width: 500px;
        margin-top: 50px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        padding: 30px;
        background-color: #ffffff;
        border-radius: 10px;
    }

    .container h2 {
        text-align: center;
        margin-bottom: 30px;
    }

    .form-group label {
        font-weight: bold;
    }

    .form-control {
        border-color: #ced4da;
    }

    .form-control:focus {
        border-color: #80bdff;
        box-shadow: none;
    }


    .btn-primary:hover {
        background-color: #0056b3;
    }
    .submit{
        background-color: #0d3a1f;
        width: 100%;
        border: none;
        color: white;
        padding: 7px;
        border-radius: 3px;
    }
    .submit:hover{
        background-color: #082413;
    }
</style>

<body>
    <div class="container">
        <h2>Cập nhật mật khẩu</h2>
        <form id="form-forgot-update-pass" method="post">
            @csrf
            <div class="mb-3">
                <label for="password" class="form-label">Mật khẩu mới:</label>
                <input placeholder="Mật khẩu mới..." type="password" class="form-control" name="password" id="password">
            </div>
            <div class="mb-3">
                <label for="confirm_password" class="form-label">Xác nhận mật khẩu:</label>
                <input placeholder="Xác nhận mật khẩu..." type="password" name="confirm_password" id="confirm_password" class="form-control">
            </div>
            <button type="submit" class="submit">Cập nhật</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src=" https://cdn.jsdelivr.net/npm/sweetalert2@11.12.2/dist/sweetalert2.all.min.js"></script>
    <script>
        $('#form-forgot-update-pass').validate({
            rules: {
                password: {
                    required: true,
                },
                confirm_password: {
                    required: true,
                    equalTo: "#password"
                },
            },
            messages: {
                password: {
                    required: "Trường này bắt buộc nhập.",
                },

                confirm_password: {
                    required: "Trường này bắt buộc nhập.",
                    equalTo: "Mật khẩu không khớp"
                },
            },
            submitHandler: function(form) {
                update_user_password()
            }
        });

        function update_user_password() {
            
            let password = $('#password').val()
            let confirm_password = $('#confirm_password').val()

            $.ajax({
                type: "POST",
                url: "{{ url('reset') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    remember_token: "{{ $token }}",
                    password: password,
                    confirm_password: confirm_password
                },
                dataType: 'json',
                success: function(res) {
                    if (res.status == true) {
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            title: res.message,
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            window.location.href = "{{ url('') }}"
                        })
                        ;
                    }
                },
                error: function(err) {
                    Swal.fire({
                        icon: "error",
                        title: "Lỗi hệ thống!",
                        text: "Vui lòng thử lại sau",
                    });
                }

            })
        }
    </script>
</body>

</html>
