@extends('Admin.layout.master')
@section('title')
    Danh sách bài viết
@endsection
@section('style')
    <script src="https://cdn.tiny.cloud/1/m4858a6vc1y631qfwjalioa86aktvnuy1f73ogcctofhpab6/tinymce/7/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage advtemplate ai mentions tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss markdown',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
            mergetags_list: [{
                    value: 'First.Name',
                    title: 'First Name'
                },
                {
                    value: 'Email',
                    title: 'Email'
                },
            ],
            ai_request: (request, respondWith) => respondWith.string(() => Promise.reject(
                "See docs to implement AI Assistant")),
        });
    </script>

    <style>
        .modal-lg-custom {
            max-width: 80%;
        }

        .modal-content {
            padding: 20px;
        }

        /* Định dạng cho button dropdown */
        .dropdown{
            margin: 8px 0;
        }
        .dropdown-toggle {
            background-color: #f8f9fa;
            border: 1px solid #ced4da;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            cursor: pointer;
        }

        /* Định dạng cho dropdown menu */
        .dropdown-menu {
            position: absolute;
            display: none;
            /* Ẩn menu ban đầu */
            background-color: #fff;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            padding: 0.5rem 0;
        }

        /* Hiển thị dropdown menu khi hover hoặc khi button được nhấp */
        .dropdown:hover .dropdown-menu,
        .dropdown:focus .dropdown-menu {
            display: block;
        }

        /* Định dạng cho các mục trong dropdown menu */
        .dropdown-item {
            display: block;
            padding: 0.25rem 1.5rem;
            clear: both;
            font-weight: normal;
            color: #212529;
            white-space: nowrap;
        }

        /* Định dạng khi hover trên mục trong dropdown menu */
        .dropdown-item:hover {
            color: #007bff;
            background-color: #f8f9fa;
        }
    </style>
@endsection
@section('content')
    <script>
        tinymce.init({
            selector: '.mytextarea'
        });
    </script>
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Danh sách bài viết</h1>


        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#add-post">
                        Thêm bài viết
                    </button>

                    <div class="dropdown">
                        <button class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            Chọn danh mục
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="{{ url('admin/posts') }}">Tất cả bài viết</a>
                            @foreach ($categories as $category)
                                <a class="dropdown-item" href="{{ $category->slug }}">{{ $category->name }}</a>
                            @endforeach
                        </div>
                    </div>




                    <!-- Modal -->
                    <div class="modal fade" id="add-post" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <form action="" method="POST" id="form-create-post" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-dialog modal-lg-custom">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 style="color: #6c757d" class="modal-title" id="exampleModalLabel">Thêm bài viết
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">

                                        <div class="mb-3 mt-3">
                                            <label for="name" class="form-label">Tiêu đề:</label>
                                            <input type="text" class="form-control" id="title" required
                                                placeholder="Enter title" name="title">
                                        </div>
                                        <div class="mb-3 mt-3">
                                            <label for="name" class="form-label">Danh mục:</label>
                                            <select name="category_id" id="" class="form-control">
                                                @foreach ($categories as $value)
                                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3 mt-3">
                                            <label for="name" class="form-label">Đoạn trích:</label>
                                            <input type="text" class="form-control" id="excerpt" required
                                                placeholder="Enter excerpt" name="excerpt">
                                        </div>

                                        <div class="mb-3 mt-3">
                                            <label for="name" class="form-label">Mô tả</label>
                                            <textarea name="content" class="mytextarea"></textarea>
                                        </div>

                                        <div class="mb-3 mt-3">
                                            <label for="name" class="form-label">Hình ảnh</label>
                                            <input type="file" class="form-control" name="image">
                                        </div>



                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Đóng</button>
                                        <button type="submit" class="btn btn-primary btn-submit-add-post">Lưu thay
                                            đổi</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">

                        <div class="row">

                            <div class="col-sm-12">
                                <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0"
                                    role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>id</th>
                                            <th>Tiêu đề</th>
                                            <th>Danh mục</th>
                                            <th>Đoạn trích</th>
                                            <th>Hình ảnh</th>
                                            <th>Lượt xem</th>
                                            <th>Hành động</th>

                                        </tr>
                                    </thead>

                                    <tbody>

                                        @foreach ($posts as $post)
                                            <tr>
                                                <td> {{ $post->p_id }} </td>
                                                <td> {{ $post->p_title }} </td>
                                                <td> {{ $post->c_name }} </td>
                                                <td> {{ $post->p_title }} </td>
                                                <td> {{ $post->p_excerpt }} </td>
                                                <td> <img style="width:120px;" src="/upload/{{ $post->p_image }}"
                                                        alt="">
                                                </td>
                                                <td> {{ $post->p_view }} </td>
                                                <td>

                                                    <a class="btn btn-success"
                                                        href="/admin/post/{{ $post->p_id }}/show">Chi tiết</a>
                                                    <button class="btn btn-danger del-post"
                                                        data-id="{{ $post->p_id }}">Xóa</button>
                                                    <button type="button" data-bs-toggle="modal"
                                                        data-bs-target="#update" class="btn btn-primary edit-post"
                                                        data-id="{{ $post->p_id }}">sửa</button>


                                                </td>

                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                {{ $posts->links() }}
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="update" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">


            <form action="" id="form-update-post" enctype="multipart/form-data">
                <input type="hidden" id="id-post-update">
                @csrf
                <div class="modal-dialog modal-lg-custom">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 style="color: #6c757d" class="modal-title" id="exampleModalLabel">Cập nhật bài viết
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3 mt-3">
                                <label for="name" class="form-label">Tiêu đề:</label>
                                <input type="text" class="form-control" id="title_edit" required
                                    placeholder="Enter title" name="title">
                            </div>
                            <div class="mb-3 mt-3">
                                <label for="name" class="form-label">Danh mục:</label>
                                <select name="category_id" id="category_id_edit" class="form-control">
                                    @foreach ($categories as $value)
                                        <option id="category_id_edit_option" data-id="{{ $value->id }}"
                                            value="{{ $value->id }}">{{ $value->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3 mt-3">
                                <label for="name" class="form-label">Đoạn trích:</label>
                                <input type="text" class="form-control" id="excerpt_edit" required
                                    placeholder="Enter excerpt" name="excerpt">
                            </div>

                            <div class="mb-3 mt-3">
                                <label for="content" class="form-label">Mô tả</label>
                                <textarea name="content" class="mytextarea" id="content_edit"></textarea>
                            </div>

                            <div class="mb-3 mt-3">
                                <label for="name" class="form-label">Hình ảnh</label>
                                <input type="file" class="form-control" name="image">
                                <img style="width:120px" alt="" id="image_edit">
                            </div>



                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                            <button type="submit" class="btn btn-primary btn-submit-update-post">Lưu thay
                                đổi</button>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection

@section('script')
    <script>
        $('body').delegate('#form-create-post', 'submit', function(e) {
            e.preventDefault()
            $.ajax({
                type: "post",
                url: "{{ url('/admin/post/create') }}",
                data: new FormData(this),
                processData: false,
                contentType: false,
                dataType: "json",
                success: function(res) {
                    if (res.status == true) {
                        Swal.fire({
                            title: "Xong!",
                            text: res.message,
                            icon: "success"
                        }).then(() => {
                            location.reload()
                        });
                    } else {
                        Swal.fire({
                            title: "Lỗi rồi!",
                            text: 'Thêm không thành công',
                            icon: "error"
                        });
                    }
                }
            })
        });
        $('body').delegate('.del-post', 'click', function() {
            let id = $(this).attr('data-id')
            Swal.fire({
                title: "Bạn có chắc chắn không?",
                text: "Không thể hoàn tác sau khi đã thực hiện!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Chắc chắn"
            }).then((result) => {
                if (result.isConfirmed) {
                    var el_tr = $(this).closest('tr')
                    el_tr.remove()
                    $.ajax({
                        type: "get",
                        url: "{{ url('admin/post/delete') }}",
                        data: {
                            id: id
                        },
                        dataType: "json",
                        success: function(res) {
                            if (res.status == true) {
                                Swal.fire({
                                    title: "Thành công!",
                                    text: res.message,
                                    icon: "success"
                                });
                            } else {
                                Swal.fire({
                                    title: "Lỗi rồi!",
                                    text: 'Xóa không thành công',
                                    icon: "error"
                                });
                            }
                        }
                    })

                }
            });


        })

        $('body').delegate('.edit-post', 'click', function() {
            let id = $(this).attr('data-id')
            $('#id-post-update').val(id)
            $.ajax({
                type: "get",
                url: `{{ url('admin/post/${id}/edit') }}`,

                dataType: "json",
                success: function(res) {
                    // console.log(res);
                    if (res.status == true) {
                        // console.log($('#content_edit'));
                        $('#title_edit').val(res.post.p_title)
                        $('#excerpt_edit').val(res.post.p_excerpt)
                        tinymce.activeEditor.setContent(res.post.p_content);
                        $('#image_edit').attr('src', '/upload/' + res.post.p_image);
                        var idToSelect = res.id_category;
                        console.log(idToSelect);

                        // Iterate through each option element
                        $('#category_id_edit option').each(function() {
                            console.log($(this).val());
                            // Compare the value of the option with idToSelect
                            if (Number($(this).val()) == idToSelect) {
                                $(this).prop('selected', true);
                            } else {
                                $(this).prop('selected', false);
                            }
                        });
                    }
                }
            })
        });
        $('body').delegate('#form-update-post', 'submit', function(e) {
            e.preventDefault()

            let id = $('#id-post-update').val()
            $.ajax({
                type: "post",
                url: `{{ url('admin/post/${id}/update') }}`,
                data: new FormData(this),
                processData: false,
                contentType: false,
                dataType: "json",
                success: function(res) {
                    if (res.status == true) {
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            title: res.message,
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            location.reload()
                        });
                    } else {
                        Swal.fire({
                            position: "center",
                            icon: "error",
                            title: 'Lỗi cập nhật',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            location.reload()
                        })
                    }
                }
            })
        });
    </script>
@endsection
