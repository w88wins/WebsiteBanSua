@extends('website.layouts.website')

@section('title', $breadcrumb)

@section('styles')
<style type="text/css">
  .blog-content img { max-width: 100%; max-height: 100%; }
</style>
@endsection

@section('content')
@include('website.partials.breadcrumbs')
<section id="columns" class="columns-container">
   <div id="columns" class="container">
      <div class="page-wrap">
         <div class="row">
            <div id="center_column" class="center_column col-md-8">
               <article id="blogpage" class="blog-detail blog-container" itemscope itemtype="http://schema.org/Article">
                  <header class="section-header">
                     <h1>{{$news->title}}</h1>
                     <div class="blog-meta clearfix">
                        <div class="postby">
                            Posted by <strong><a href="{{ route('web.news.author',[$news->author->username??"admin"]) }}">{{$news->author->name??"Admin"}}</a></strong> on <time>{{$news->created_at->format('H:m - j F, Y')}}</time>
                        </div>
                        <div class="blog-tags">
                           <span class="icon-tag">Tags:</span>
                            @foreach($news->tags as $tag)
                            <a href="{{ route('web.news.tagged',[$tag->slug]) }}">
                                <span>{{$tag->name}}</span>
                            </a>
                            @if(!$loop->last)
                            {{", "}}
                            @endif 
                            @endforeach
                        </div>
                        <div class="blog-tags">
                           <span class="icon-tag">Views: {{$news->count_views}}</span>
                        </div>
                     </div>
                  </header>
                  <div class="blog-content">
                     <div class="rte" itemprop="articleBody">
                        <div class="blog-description">
                         <p><img src="{{ $news->ImageNews ?? asset('../../../cdn.shopify.com/s/files/1/0928/4804/files/b3_1024x1024693b.jpg?11360329962432831771') }}"></p>
                           <p>{{$news->title}}</p>
                        </div>
                        <div class="blog-content">
                           <div class="blog-content clearfix">
                              <div class="content-wrap clearfix">
                                 <div class="itemFullText">
                                    {!!$news->content!!}
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <br>
                     <div class="blog-social clearfix">
                        <div class="socialsharing_product no-print">
                            <ul class="social-sharing list-unstyled">
                                <li>
                                    <a class="btn btn-twitter" target="_blank" href="https://twitter.com/intent/tweet?text={{$news->title}}&amp;url={{ route('web.news.view',['id'=>$news->id,'name'=>$news->slug]) }}&amp;">
                                        <i class="fa fa-twitter"></i> Tweet
                                    </a>
                                </li>
                                <li>
                                    <a class="btn btn-facebook" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('web.news.view',['id'=>$news->id,'name'=>$news->slug])) }}&display=popup">
                                        <i class="fa fa-facebook"></i> facebook
                                    </a>
                                </li>
                                <li>
                                    <a class="btn btn-google-plus" target="_blank" href="https://plus.google.com/share?url={{ route('web.news.view',['id'=>$news->id,'name'=>$news->slug]) }}">
                                        <i class="fa fa-google-plus"></i> Google+
                                    </a>
                                </li>
                                <li>
                                    <a class="btn btn-pinterest" target="_blank" href="http://pinterest.com/pin/create/button/?url={{ route('web.news.view',['id'=>$news->id,'name'=>$news->slug]) }}&media={{$news->ThumbProduct??asset('cdn.shopify.com/s/files/1/0928/4804/products/p14_large592f.jpg?v=1439571205') }}&description={{$news->title}}">
                                        <i class="fa fa-pinterest-p"></i> Pinterest
                                    </a>
                                </li>
                            </ul>
                        </div>
                     </div>
                     <br>
                     <div class="blog-tags-bottom">
                        <span class="icon-tag">Tags:</span>
                        @foreach($news->tags as $tag)
                        <a href="{{ route('web.news.tagged',[$tag->slug]) }}">
                            <span>{{$tag->name}}</span>
                        </a>
                        @if(!$loop->last)
                        {{", "}}
                        @endif 
                        @endforeach
                     </div>
                     <hr>
                     <p class="btn-prenext clearfix">
                        @isset ($previous)
                        <span class="pull-left"><i class="fa fa-angle-double-left"></i> <a href="{{ route('web.news.view', [$previous->id,$previous->slug]) }}" title="{{$previous->title}}">Older Post</a>
                        </span>
                        @endisset
                        @isset ($next)
                        <span class="pull-right">
                        <a href="{{ route('web.news.view', [$next->id,$next->slug]) }}" title="{{$next->title}}">Newer Post</a> <i class="fa angle-right"></i>
                        </span>
                        @endisset
                     </p>
                     <div class="extra-blogs row">
                        <div class="col-lg-6 col-md-6 col-xs-12">
                           <h4>popular posts</h4>
                           <ul>
                                @foreach($news_popular as $popular)
                                <li>
                                 <a href="{{ route('web.news.view', [$popular->id,$popular->slug]) }}" title="{{$popular->title}}">{{$popular->title}}</a>
                              </li>
                              @endforeach
                           </ul>
                        </div>
                        <div class="col-lg-6 col-md-6 col-xs-12">
                           <h4>Related by Tags</h4>
                           <ul>
                                @foreach ($news_related as $related)
                                  <li>
                                     <a href="{{ route('web.news.view', [$related->id,$related->slug]) }}" title="{{$related->title}}">{{$related->title}}</a>
                                  </li>
                                @endforeach
                           </ul>
                        </div>
                     </div>
                  </div>
               </article>
            </div>
            
            <!-- RECENT NEWS in right side -->
            @include('website.news.news_recent')

         </div>
      </div>
   </div>
</section>
@endsection