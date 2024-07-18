@extends('Admin.layout.master')
@section('title')
    Chi tiết bài viết
@endsection
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Chi tiết bài viết</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    Chi tiết bài viết
                </h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">


                        </div>


                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0"
                                    role="grid" aria-describedby="dataTable_info" style="width: 100%;">

                                    <tr>
                                        <th>Các mục</th>
                                        <td>Nội dung</td>
                                    </tr>
                                    <tr>
                                        <th>ID</th>
                                        <td>{{ $post->p_id }}</td>
                                    </tr>

                                    <tr>
                                        <th>Tiêu đề</th>
                                        <td>{{ $post->p_title }}</td>
                                    </tr>
                                    <tr>
                                        <th>Hình ảnh</th>
                                        <td><img style="width:120px" src="/upload/{{ $post->p_image }}" alt=""></td>
                                    </tr>
                                    <tr>
                                        <th>Đoạn trích</th>
                                        <td>{{ $post->p_excerpt }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nội dung</th>
                                        <td>{!! $post->p_content !!}</td>
                                    </tr>
                                    <tr>
                                        <th>Danh mục</th>
                                        <td>{{ $post->c_name }}</td>
                                    </tr>



                                </table>
                                <a class="btn btn-danger" href="/admin/posts">Quay lại</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
