@extends('layout')
@section('content')
    <div class="main-content" id="main-content">

        <div class="container">
              <div class="blog-post-detail">
                <div class="post-header">
                    <h1>{{ $post->name }}</h1>
                    <div class="post-meta">
                        <span class="category">
                            <a href="{{ url('danh-muc/' . $post->genrePost->slug) }}">
                                #{{ $post->genrePost->name }}
                            </a>
                        </span>
                        <span class="date">{{ $post->created_at->format('d/m/Y') }}</span>
                        <span class="views"><i class="fa fa-eye"></i> {{ $post->view }} lượt xem</span>
                    </div>
                </div>

                <div class="post-image">
                    @if($post->image)
                        <img src="{{ asset('storage/'. $post->image) }}" alt="{{ $post->name }}" class="img-fluid">
                    @endif
                </div>

                <div class="post-content">
                    {!! $post->description !!}
                </div>

                <div class="post-footer">
                    <div class="share-buttons">
                        <h4>Chia sẻ bài viết:</h4>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" target="_blank" class="btn btn-facebook">
                            <i class="fa fa-facebook"></i> Facebook
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ url()->current() }}&text={{ $post->name }}" target="_blank" class="btn btn-twitter">
                            <i class="fa fa-twitter"></i> Twitter
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="sidebar">
                <div class="widget">
                    <h3>Bài viết liên quan</h3>
                    <ul class="related-posts">
                        @foreach($relatedPosts as $relatedPost)
                            <li class="online">
                                <a href="{{ url('blogs/' . $post->genrePost->slug . '/' . $relatedPost->slug) }}">
                                    <div class="media">
                                        @if($relatedPost->image)
                                            <img class="media-object" src="{{ $relatedPost->image }}" width="40px" height="40px" alt="">
                                        @endif
                                        <div class="media-body">
                                            <span class="name">{{asset('storage/'.$relatedPost->image)}}</span>
                                            <span class="message">#{{ $post->genrePost->name }}</span>
                                            <span class="badge badge-outline status"></span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="widget">
                    <h3>Danh mục</h3>
                    <ul class="categories">
                        @php
                            $genres = \App\Models\GenrePost::where('status', 'active')->get();
                        @endphp

                        @foreach($genres as $genre)
                            <li>
                                <a href="{{ url('danh-muc/' . $genre->slug) }}">
                                    {{ $genre->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
