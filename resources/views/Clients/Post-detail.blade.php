@extends('Clients.layouts.master')
@section('title')
    {{ $getSinglePost->p_title }}
@endsection
@section('content')
    <section class="single-post-content">
        <div class="container">
            <div class="row">
                <div class="col-md-9 post-content" data-aos="fade-up">

                    <!-- ======= Single Post Content ======= -->
                    <div class="single-post">
                        <div class="post-meta"><span class="date">{{ $getSinglePost->p_title }}</span> <span
                                class="mx-1">&bullet;</span>
                            <span>{{ $getSinglePost->p_created_at }}</span>
                        </div>
                        <h1 class="mb-5">{{ $getSinglePost->p_title }}</h1>
                        <p>{{ $getSinglePost->p_excerpt }}</p>



                        <div style="white-space:break-spaces">
                            {!! $getSinglePost->p_content !!}
                        </div>



                    </div><!-- End Single Post Content -->

                    <!-- ======= Comments ======= -->
                    {{-- <div class="comments">
                        <h5 class="comment-title py-4">{{ count($getCommentById) }} Comments</h5>
                        @foreach ($getCommentById as $value)
                            <div class="comment d-flex">
                                <div class="flex-shrink-0">
                                    <div class="avatar avatar-sm rounded-circle">
                                        <img class="avatar-img"
                                            src="https://c.pxhere.com/images/0d/18/4fa31701d2cfa087836d807967f3-1447663.jpg!d"
                                            alt="" class="img-fluid">
                                    </div>
                                </div>
                                <div class="flex-shrink-1 ms-2 ms-sm-3">
                                    <div class="comment-meta d-flex">
                                        <h6 class="me-2">{{ $value['email'] }}</h6>
                                        <span
                                            class="text-muted">{{ $ngayThangNam = date('Y-m-d', strtotime($value['create_at'])) }}</span>
                                    </div>
                                    <div class="comment-body">
                                        {{ $value['comment'] }}
                                    </div>
                                </div>
                            </div>
                        @endforeach


                    </div><!-- End Comments -->

                    <!-- ======= Comments Form ======= -->
                    <div class="row justify-content-center mt-5">

                        <div class="col-lg-12">
                            <h5 class="comment-title">Leave a Comment</h5>
                            <form action="" method="post">
                                
                                <div class="row">
                                    <div class="col-lg-6 mb-3">
                                        <label for="comment-name">Name</label>
                                        <input name="email" type="text" class="form-control" id="emailOrName"
                                            placeholder="Enter your name">
                                        <span id="err_emailOrName"></span>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label for="comment-message">Message</label>
                                        <textarea name="comment" class="form-control" id="content" placeholder="Enter your name" cols="30"
                                            rows="10"></textarea>
                                        <span id="err_content"></span>
                                    </div>
                                    <div class="col-12">
                                        <input type="submit" class="btn btn-primary" value="Post comment">
                                    </div>
                            </form>
                        </div>
                    </div> --}}
                </div><!-- End Comments Form -->
                @include(
                    'Clients.components.Sidebar',
                
                    [
                        'getPostPopular' => $getPostPopular,
                        'getPostlatestSidebar' => $getPostlatestSidebar,
                        'getPostNearest' => $getPostNearest,
                    ]
                )

            </div>
            {{-- Sidebar --}}

        </div>
        </div>
    </section>
@endsection
