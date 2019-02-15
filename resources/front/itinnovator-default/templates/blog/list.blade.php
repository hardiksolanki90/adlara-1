@extends('layouts.default')
@section('content')
<section class="bg-white">
    <v-container>
      <div class="section-title text-center mt-4 mb-5">
        <small class="sub-title">See our New Post</small>
        <h3 class="block-head text-xs-center">{{ (isset($name) ? $name : 'Recyclingbalers') }} <span>Blog</span></h3>
      </div>
        <v-layout row wrap>
            <v-flex md8 sm8 xs12 column row wrap>
              @foreach($posts as $post)
                <v-flex md6 sm6 xs12 class="wrap_artical">
                  <article class="_bartical">
                      <a href="{{ route('blog-post', ['url' => $post->url]) }}" title="{{ $post->title }}" class="blogImg">
                          <img src="{{ getMedia($post->image, '600, 550') }}" alt="{{ $post->title }}">
                      </a>
                      <div class="blogCont">
                        <div class="blogCat my-2 row wrap">
                          @if ($post->post_category->count())
                            @foreach ($post->post_category as $cat)
                              <a href="{{ route('blog-post-category', ['category' => $cat->url]) }}">
                                <span class="dark-green white--text blog_cat">{{ ucfirst(model($cat, 'name')) }}</span>
                              </a>
                            @endforeach
                          @endif
                        </div>
                        <a href="{{ route('blog-post', ['url' => $post->url]) }}" title="{{ $post->title }}">
                          <h2 class="blog_title">{{ $post->title }}</h2>
                        </a>
                        <div class="entry-meta">
                          <span class="byline"> by
                            <span class="author vcard">
                              <a class="auth_name" href="{{ route('blog-post-author', ['id' => model($post->author, 'id'), 'url' => str_slug(model($post->author, 'name'), '-')]) }}">{{ model($post->author, 'name') }}</a>
                            </span>
                          </span>
                          <span class="posted-on">
                            <a href="{{ route('blog-post', ['url' => $post->url]) }}" rel="bookmark">
                              <time class="entry-date published" datetime="{{ $post->created_at }}">{{ date_format($post->created_at, 'M d, Y') }}</time>
                              <time class="updated" datetime="{{ $post->updated_at }}">{{ date_format($post->updated_at, 'M d, Y') }}</time>
                            </a>
                          </span>
                        </div>
                        <div class="entry-content">
                      		{!! str_limit($post->content, 300) !!}
                      	</div>
                        <div class="_contRead py-2">
                            <a title="{{ $post->title }}" href="{{ route('blog-post', ['url' => $post->url]) }}">Continue Reading</a>
                        </div>
                    </div>
                  </article>
              </v-flex>
              @endforeach
            </v-flex>
            <v-flex md4 sm4 xs12 column class="widget_side">
              <aside class="widget">
                  <h2 class="widget-title"><span>Latest posts</span></h2>
                  <div class="popular-posts">
                     <ul>
                        @if (count($latest_posts))
                          @foreach ($latest_posts as $latest)
                            <li>
                               <a href="{{ route('blog-post', ['url' => $latest->url]) }}" class="clearfix">
                                  <img width="150" height="150" src="{{ getMedia($latest->image, '150, 150') }}" class="attachment-thumbnail size-thumbnail wp-post-image" alt="">
                                  <div class="popu-cnt">
                                    <h3 class="post-title">{{ $latest->title }}</h3>
                                    <span class="byline">by <em>{{ model($latest->author, 'name') }}</em></span>
                                  </div>
                               </a>
                            </li>
                          @endforeach
                        @endif
                     </ul>
                  </div>
              </aside>
              @if (count($recent_view))
                <aside class="widget">
                  <h2 class="widget-title"><span>Recent View</span></h2>
                  <div class="popular-posts">
                     <ul>
                        @foreach ($recent_view as $latest)
                          <li>
                             <a href="{{ route('blog-post', ['url' => $latest->post->url]) }}" class="clearfix">
                                <img width="150" height="150" src="{{ getMedia($latest->post->image, '150, 150') }}" class="attachment-thumbnail size-thumbnail wp-post-image" alt="">
                                <div class="popu-cnt">
                                  <h3 class="post-title">{{ $latest->post->title }}</h3>
                                  <span class="byline">by <em>{{ model($latest->post->author, 'name') }}</em></span>
                                </div>
                             </a>
                          </li>
                        @endforeach
                     </ul>
                  </div>
                </aside>
              @endif
            </v-flex>
        </v-layout>
        <v-layout column pt-5 class="_mstView">
            <h3 class="widget-title _mstitle mb-5"><span>Most Viewed</span> </h3>
          <v-carousel hide-delimiters>
            @if (count($mostly_viewed))
              @foreach ($mostly_viewed as $mv)
                <v-carousel-item>
                  <img src="{{ getMedia($mv->post->image, '700, 465') }}" alt="">
                  <div class="_mstveCont">
                      <h3 class="_mstitle">{{ $mv->post->title }}</h3>
                      <div class="post_cat my-2">
                          @foreach ($mv->post->post_category as $cat)
                            <span class="_mstcat">{{ ucfirst($cat->name) }}</span>
                          @endforeach
                      </div>
                      <div class="entry-meta">
                        <span class="byline"> by
                          <span class="author vcard">
                            <a class="auth_name" href="{{ route('blog-post-author', ['id' => model($mv->post->author, 'id'), 'url' => str_slug(model($mv->post->author, 'name'), '-')]) }}">{{ model($mv->post->author, 'name') }}</a>
                          </span>
                        </span>
                        <span class="posted-on">
                          <a href="{{ route('blog-post', ['url' => $mv->post->url]) }}" rel="bookmark">
                            <time class="entry-date published" datetime="{{ $mv->post->created_at }}">{{ date_format($mv->post->created_at, 'M d, Y') }}</time>
                            <time class="updated" datetime="{{ $mv->post->updated_at }}">{{ date_format($mv->post->updated_at, 'M d, Y') }}</time>
                          </a>
                        </span>
                      </div>
                  </div>
                </v-carousel-item>
              @endforeach
            @endif
          </v-carousel>
        </v-layout>
    </v-container>
</section>
@endsection
