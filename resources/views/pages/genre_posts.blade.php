@extends('layout')
@section('content')
    <div class="main-content" id="main-content">


<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="blog-category-header">
                <h1>{{ $genre->name }}</h1>
            </div>
        </div>
    </div>

    <div class="row">
        @foreach($posts as $post)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="blog-card">
                    <div class="blog-image">
                        @if($post->image)
                            <a href="{{ route('post.detail', [$genre->slug, $post->slug]) }}">
                                <img src="{{ $post->image }}" alt="{{ $post->name }}" class="img-fluid">
                            </a>
                        @endif
                    </div>
                    <div class="blog-body">
                        <h3 class="blog-title">
                            <a href="{{ route('post.detail', [$genre->slug, $post->slug]) }}">
                                {{ $post->name }}
                            </a>
                        </h3>
                        <div class="blog-meta">
                            <span class="date">{{ $post->created_at->format('d/m/Y') }}</span>
                            <span class="views"><i class="fa fa-eye"></i> {{ $post->view }}</span>
                        </div>
                        <div class="blog-excerpt">
                            {{ Str::limit(strip_tags($post->description), 150) }}
                        </div>
                        <a href="{{ route('post.detail', [$genre->slug, $post->slug]) }}" class="btn btn-primary btn-sm">
                            Đọc thêm
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="row">
        <div class="col-12">
            {{ $posts->links() }}
        </div>
    </div>
</div>

         </div>
@endsection

