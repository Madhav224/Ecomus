@extends('frontend.layouts.app')

@section('title', 'Blogs')

@section('content')


        <!-- page-title -->
        <div class="tf-page-title">
            <div class="container-full">
                <div class="row">
                    <div class="col-12">
                        <div class="heading text-center">Blogs</div>
                        <ul class="breadcrumbs d-flex align-items-center justify-content-center">
                            <li>
                                <a href="index.html">Home</a>
                            </li>
                            <li>
                                <i class="icon-arrow-right"></i>
                            </li>
                            <li>
                                Fashion
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- /page-title -->

<!-- blog-grid-main -->
<div class="blog-grid-main">
    <div class="container">
        <div class="row">
            @foreach($blogs as $blog)
                <div class="col-xl-4 col-md-6 col-12">
                    <div class="blog-article-item">
                        <div class="article-thumb">
                            <a href="{{ url('blog/'.$blog->id) }}">
                                <img class="lazyload" 
                                     data-src="{{ asset($blog->image ?? 'frontend/images/blog/default.jpg') }}" 
                                     src="{{ asset($blog->image ?? 'frontend/images/blog/default.jpg') }}" 
                                     alt="{{ $blog->title }}">
                            </a>
                            {{-- <div class="article-label">
                                <a href="{{ url('blog/'.$blog->id) }}"
                                   class="tf-btn btn-sm radius-3 btn-fill animate-hover-btn">
                                    {{ is_array($blog->categories) ? implode(', ', $blog->categories) : $blog->categories }}
                                </a>
                            </div> --}}
                        </div>
                        <div class="article-content">
                            <div class="article-title">
                                <a href="{{ url('blog/'.$blog->id) }}">
                                    {{ $blog->title }}
                                </a>
                            </div>
                            <div class="article-btn">
                                <a href="{{ url('blog/'.$blog->id) }}" class="tf-btn btn-line fw-6">
                                    Read more<i class="icon icon-arrow1-top-left"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<!-- /blog-grid-main -->


@endsection