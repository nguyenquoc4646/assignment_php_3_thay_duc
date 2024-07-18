@extends('Clients.layouts.master')
@section('title')
    {{ $getPostByCate[0]->c_name ?? ""}}
@endsection
@section('style')
    <style>
        .pagination .page-item .page-link {
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 5px;
            font-size: 1.25rem;
        }

        .pagination .page-item.active .page-link {
            background-color: black;
            color: white;
            border: none;
        }

        .pagination .page-item .page-link:hover {
            background-color: gray;
            color: white;
            border: none;
        }
    </style>
@endsection
@section('content')
    <section class="single-post-content">
        <div class="container">
            <div class="row">
                <div class="col-md-9" data-aos="fade-up">
                    @if (!empty(Request::get('keyword')))
                        <h3 class="category-title">Tìm kiếm : {{ Request::get('keyword') }}</h3>
                    @else
                        <h3 class="category-title">Danh mục: {{ $getPostByCate[0]->c_name }}</h3>
                    @endif

                    @if (!empty($getPostByCate))
                        @foreach ($getPostByCate as $value)
                            <div class="d-md-flex post-entry-2 half">
                                <a href="{{ url($value->p_slug) }}" class="me-4 thumbnail">
                                    <img src="upload/{{ $value->p_image }}" alt="" class="img-fluid">
                                </a>
                                <div>
                                    <div class="post-meta"><span class="date"><a
                                                href="{{ url($value->c_slug) }}">{{ $value->c_name }}</a></span> <span
                                            class="mx-1">&bullet;</span>
                                        <span>
                                            {{ $value->p_created_at }}
                                        </span>
                                    </div>
                                    <h3><a href="{{ url($value->p_slug) }}">{{ $value->p_title }}</a>
                                    </h3>
                                    <p>{{ $value->excerpt }}</p>
                                    <div class="d-flex align-items-center author">
                                        <div class="photo"><img
                                                src="http://assignment2.test/upload/ffdete6vuon4l3ufxipj.jpg" alt=""
                                                class="img-fluid">
                                        </div>
                                        <div class="name">
                                            <h3 class="m-0 p-0">Nguyễn Ngọc Quốc</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif







                    <div class="text-start py-4">
                        {{ $getPostByCate->links() }}
                    </div>
                </div>

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
