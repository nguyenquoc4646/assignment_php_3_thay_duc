<div class="col-md-3">
    <!-- ======= Sidebar ======= -->
    <div class="aside-block">

        <ul class="nav nav-pills custom-tab-nav mb-4" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-popular-tab" data-bs-toggle="pill"
                    data-bs-target="#pills-popular" type="button" role="tab" aria-controls="pills-popular"
                    aria-selected="true">Phổ biến</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-trending-tab" data-bs-toggle="pill" data-bs-target="#pills-trending"
                    type="button" role="tab" aria-controls="pills-trending" aria-selected="false">Mới nhất</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-latest-tab" data-bs-toggle="pill" data-bs-target="#pills-latest"
                    type="button" role="tab" aria-controls="pills-latest" aria-selected="false">Gần đây</button>
            </li>
        </ul>

        <div class="tab-content" id="pills-tabContent">

            <!-- Popular -->
            <div class="tab-pane fade show active" id="pills-popular" role="tabpanel"
                aria-labelledby="pills-popular-tab">


                @include('Clients.components.post-entry-1', ['posts' => $getPostPopular])
            </div> <!-- End Popular -->

            <!-- Trending -->
         <div class="tab-pane fade" id="pills-trending" role="tabpanel" aria-labelledby="pills-trending-tab">
                @include('Clients.components.post-entry-2', ['posts' => $getPostlatestSidebar])
            </div> <!-- End Trending -->

            <!-- Latest -->
            <div class="tab-pane fade" id="pills-latest" role="tabpanel" aria-labelledby="pills-latest-tab">
                @include('Clients.components.post-entry-3', ['posts' => $getPostNearest])

            </div> <!-- End Latest -->

        </div>
    </div>

    <div class="aside-block">
        <h3 class="aside-title">Video</h3>
        <div class="video-post">
            <a href="https://www.youtube.com/watch?v=AiFfDjmd0jU" class="glightbox link-video">
                <span class="bi-play-fill"></span>
                <img src="http://assignment2.test/upload/ffdete6vuon4l3ufxipj.jpg" alt="" class="img-fluid">
            </a>
        </div>
    </div><!-- End Video -->

    <div class="aside-block">
        <h3 class="aside-title">Categories</h3>
        <ul class="aside-links list-unstyled">
            @php
                $categories = (new App\Models\CategoryModel())->getCategories();
            @endphp
            @foreach ($categories as $value)
            <li><a href="{{ $value->slug }}"><i class="bi bi-chevron-right"></i> {{ $value->name }}</a></li>
            @endforeach
            
           
        </ul>
    </div><!-- End Categories -->

    <div class="aside-block">
        <h3 class="aside-title">Tags</h3>
        <ul class="aside-tags list-unstyled">
            @foreach ($categories as $value)
            <li><a href="{{ $value->slug }}">{{ $value->name }}</a></li>
            @endforeach
            
         
        </ul>
    </div><!-- End Tags -->

</div>
