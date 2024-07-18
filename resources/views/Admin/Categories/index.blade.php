@extends('Admin.layout.master')
@section('title')
    Danh sách danh mục
@endsection
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Danh sách danh mục</h1>


        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Thêm danh mục
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <form action="" method="POST" id="form-create-cate">
                            @csrf
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 style="color: #6c757d" class="modal-title" id="exampleModalLabel">Thêm danh mục
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">

                                        <div class="mb-3 mt-3">
                                            <label for="name" class="form-label">Name:</label>
                                            <input type="text" class="form-control" id="name" required
                                                placeholder="Enter name" name="name">
                                        </div>



                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Đóng</button>
                                        <button type="button" class="btn btn-primary btn-submit">Lưu thay đổi</button>
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
                                            <th>Tên danh mục</th>
                                            <th>Hành động</th>

                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($categories as $category)
                                            <tr>
                                                <td> {{ $category->id }} </td>
                                                <td> {{ $category->name }} </td>
                                                <td>

                                                    <a class="btn btn-success"
                                                        href="/admin/category/{{ $category->id }}/show">Chi tiết</a>
                                                    <button class="btn btn-danger del-cate"
                                                        data-id="{{ $category->id }}">Xóa</button>
                                                    <button type="button" data-bs-toggle="modal" data-bs-target="#update"
                                                        class="btn btn-primary edit-cate"
                                                        data-id="{{ $category->id }}">sửa</button>


                                                </td>

                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="update" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <form action="" method="POST" id="form-create-cate">
                <input type="hidden" id="id-cate-update">
                @csrf
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 style="color: #6c757d" class="modal-title" id="exampleModalLabel">Cập nhật danh mục
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <div class="mb-3 mt-3">
                                <label for="name" class="form-label">Name:</label>
                                <input type="text" class="form-control" id="name_cate_update" required
                                    placeholder="Enter name" name="name">
                            </div>



                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                            <button type="button" class="btn btn-primary btn-submit-update-cate">Lưu thay đổi</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $('body').delegate('.del-cate', 'click', function() {
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
                        url: "{{ url('admin/category/delete') }}",
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



        $('body').delegate('#form-create-cate', 'submit', function(e) {
            e.preventDefault()
            let name = $('#name').val()
            $.ajax({
                type: "post",
                url: "{{ url('admin/category/create') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    name: name
                },
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
                            text: 'thêm không thành công',
                            icon: "error"
                        });
                    }
                }
            })
        });

        $('body').delegate('.edit-cate', 'click', function() {
            let id = $(this).attr('data-id')
            $('#id-cate-update').val(id)
            $.ajax({
                type: "get",
                url: `{{ url('admin/category/${id}/edit') }}`,

                dataType: "json",
                success: function(res) {
                    if (res.status == true) {

                        $('#name_cate_update').val(res.category.name)
                    }
                }
            })
        });

        // $('body').delegate('.btn-submit-update-cate', 'click', function() {
        //     let id = $(this).attr('data-id')
        //     $('#id-cate-update').val(id)
        //     $.ajax({
        //         type: "get",
        //         url: `{{ url('admin/category/${id}/edit') }}`,
        //         data: {
        //             name: name
        //         },
        //         dataType: "json",
        //         success: function(res) {
        //             if (res.status == true) {

        //                 $('#name_cate_update').val(res.category.name)
        //             }
        //         }
        //     })
        // });

        $('body').delegate('.btn-submit-update-cate', 'click', function() {
            let id = $('#id-cate-update').val()
            let name = $('#name_cate_update').val()
            $.ajax({
                type: "post",
                url: `{{ url('admin/category/${id}/update') }}`,
                data: {
                    "_token": "{{ csrf_token() }}",
                    id: id,
                    name: name
                },
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
