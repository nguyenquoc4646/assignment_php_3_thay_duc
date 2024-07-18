@extends('Clients.layouts.master')
@section('title')
    Trang chủ
@endsection

@section('content')
    <!-- ======= Hero Slider Section ======= -->

@include('Clients.layouts.slider')
    <!-- ======= Post Grid Section ======= -->
    <section id="posts" class="posts">

        <div class="container" data-aos="fade-up">
            <div class="row g-5">
                <div class="col-lg-4">
                    <div class="post-entry-1 lg">
                        <a href="{{ $getOnePostLatest->p_slug }}"><img src="upload/{{ $getOnePostLatest->p_image }}" alt=""
                                class="img-fluid"></a>
                        <div class="post-meta"><span class="date"><a href="{{ $getOnePostLatest->c_slug }}">{{ $getOnePostLatest->c_name }}</a></span> <span
                                class="mx-1">&bullet;</span>
                            <span>{{ $getOnePostLatest->p_created_at }}</span>
                        </div>
                        <h2><a href="{{ $getOnePostLatest->p_slug }}">{{ $getOnePostLatest->p_title }}</a></h2>
                        <p class="mb-4 d-block">{{ $getOnePostLatest->p_excerpt }}</p>


                    </div>

                </div>

                <div class="col-lg-8">
                    <div class="row g-5">
                        @foreach ($postTop6Chunk as $post)
                            <div class="col-lg-4 border-start custom-border">
                                @foreach ($post as $value)
                                    <div class="post-entry-1">
                                        <a href="{{ $value['p_slug'] }}"><img src="upload/{{ $value['p_image'] }}"
                                                alt="" class="img-fluid"></a>
                                                <div class="post-meta"><span class="date"><a href="{{ $value['c_slug'] }}">{{ $value['c_name'] }}</a></span> <span class="mx-1">&bullet;</span> <span>{{ $value['p_created_at'] }}</span></div>
                                                <h2><a href="{{ $value['p_slug'] }}">{{ $value['p_title'] }}</a></h2>
                                       
                                    </div>
                                @endforeach


                            </div>
                        @endforeach


                        <!-- Trending Section -->
                        <div class="col-lg-4">

                            <div class="trending">
                                <h3>Nhiều lượt xem</h3>
                                <ul class="trending-post">
                                    @foreach ($getTop5PostViewMost as $value)
                                        <li>
                                            <a href="{{ $value->p_slug }}">
                                                <span class="number">1</span>
                                                <h3>{{ $value->p_excerpt }}</h3>
                                                <span class="author">Jane Cooper</span>
                                            </a>
                                        </li>
                                    @endforeach


                                </ul>
                            </div>

                        </div> <!-- End Trending Section -->
                    </div>
                </div>

            </div> <!-- End .row -->
        </div>
    </section> <!-- End Post Grid Section -->
@endsection
