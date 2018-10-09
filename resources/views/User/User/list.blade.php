@extends('Front_end.layouts.basic')

@section('content')
<div class="page-title parallax parallax1">
        <div class="section-overlay">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">                    
                    <div class="page-title-heading">
                        <h1 class="title">User</h1>
                    </div><!-- /.page-title-captions -->
                    <div class="breadcrumbs">
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li> - </li>                         
                            <li><a href="index.html">Page</a></li>
                            <li> - </li>                         
                            <li>User</li>
                        </ul>                   
                    </div><!-- /.breadcrumbs -->   
                </div><!-- /.col-md-12 -->  
            </div><!-- /.row -->  
        </div><!-- /.container -->                      
    </div><!-- /.page-title --> 

    <section class="flat-row page-user bg-theme">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="flat-user">
                        <a href="{{ route('user.edit', ['id' => Sentinel::getUser()->id]) }}" class="edit" title="">Edit Profile <i class="ion-edit"></i></a>
                        @if($user->avatar == null)
                        <div class="avatar">
                            <img src="{{ asset('images/services/noavatar.png') }}" alt="image">
                        </div>
                        @else
                         <div class="avatar">
                            <?php $path = 'uploads/avatar/'.$user->avatar ?>
                            <img src="{{ asset($path) }}" alt="image">
                        </div>
                        @endif
                        <h3 class="name">{{ $user->first_name }} {{ $user->last_name }}</h3>
                        <ul class="info">
                            <li class="email"><i class="fa fa-envelope"></i><a href="#" title="">{{ $user->email }}</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="flat-tabs style2" data-effect="fadeIn">
                        <ul class="menu-tab clearfix">
                            <li class="active"><a href="#"><i class="ion-navicon-round"></i>({{ $places->total() }}) Listings</a></li>
                            <li class=""><a href="#"><i class="ion-chatbubbles"></i>({{ $reviews->total() }}) Reviews</a></li>
                        </ul><!-- /.menu-tab -->
                    
                    <div class="content-tab listing-user">
                        <div class="content-inner active listing-list">
                        @foreach($places as $place)
                            <div class="flat-product clearfix">
                                <div class="featured-product">
                                    <?php $path = 'uploads/place/'.$place->images()->get()->first()->url ?> 
                                    <img style="width: 290px; height: 182px;" src="{{ asset($path) }}" alt="image">
                                    {!! OpenOrClose::open($place->open, $place->close) !!}
                                </div>
                                <div class="rate-product">
                                    <div class="link-review clearfix">
                                        <div class="button-product float-left">
                                            <button type="button" class="flat-button" onclick="location.href='#'">  {{ $place->category()->get()->first()->name }}</button>
                                        </div>
                                        <div class="start-review">
                                            <span class="flat-start">
                                                {!! StarRating::rate($place->getRatePlace($place->id)) !!}
                                            </span>
                                            <a href="{{ route('listing.detail', ['id'=>$place->id]) }}" class="review">( {{ $place->countReview() }} reviewers )</a>
                                        </div>
                                    </div>
                                    <div class="info-product">
                                        <h6 class="title"><a href="{{ route('listing.detail', ['id'=>$place->id]) }}">{{ $place->name }}</a></h6>
                                        <p>{{ $place->district }}, {{ $place->city }}</p>
                                    </div>
                                </div>
                                <ul class="wrap-button float-right">
                                    <li>
                                        <button type="button" class="button" onclick="location.href='#'"><i class="ion-edit"></i><span>Edit</span></button>
                                    </li>
                                    <li>
                                        <button type="button" class="button" onclick="location.href='#'"><i class="ion-trash-a"></i><span>Delete</span></button>
                                    </li>
                                </ul>
                            </div>
                            @endforeach
                            @if(count($places)>0)
                            <div class="blog-pagination style2 text-center">
                                {{ $places->links() }}
                            </div>
                            @endif
                        </div>
                        <div class="content-inner">
                            <div class="author-review content-listing">
                                <div class="comments-area">
                                    <ol class="comment-list">
                                        @foreach($reviews as $comment)
                                        <?php $userComment = $comment->user()->get()->first() ?>
                                        <?php $placeComment = $comment->place()->get()->first() ?>
                                        <li class="comment">
                                            <article class="comment-body clearfix"> 
                                             @if($userComment->avatar == null)       
                                                <div class="comment-author">
                                                    <img style="width: 84px; height: 84px;" src="{{ asset('images/services/noavatar.png') }}" alt="image">  
                                                </div><!-- .comment-author -->
                                             @else
                                                 <div class="comment-author">
                                                    <?php $path = 'uploads/place./'.$userComment->avatar ?>
                                                    <img style="width: 84px; height: 84px;" src="{{ asset($path) }}" alt="image">  
                                                </div><!-- .comment-author -->
                                             @endif
                                                <div class="comment-text">
                                                    <div class="comment-metadata">
                                                        <h5><a href="{{ route('user.profile', ['id', $userComment->id]) }}">{{ $userComment->last_name }} {{ $userComment->first_name }} </a>
                                                            <a href="{{ route('listing.detail', ['id'=> $placeComment]) }}" ><span style="color: black;">on {{ $placeComment->name }}</span></a></h5>  
                                                        <p class="day">{!! Time::diff($comment->created_at) !!}</p> <div class="flat-start">
                                                           {!! StarRating::rate($comment->rate) !!}
                                                        </div>             
                                                    </div><!-- .comment-metadata -->
                                                    <div class="comment-content">
                                                        <p>{{ $comment->content }}</p>
                                                    </div><!-- .comment-content -->
                                                </div><!-- /.comment-text -->         
                                            </article><!-- .comment-body -->
                                        </li><!-- #comment-## -->
                                    @endforeach
                                    </ol><!-- .comment-list -->
                                </div>
                            </div>
                        </div>
                    </div> 
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js_lib')
	<script src="{{ asset('javascript/jquery.min.js') }}"></script>
    <script src="{{ asset('javascript/tether.min.js') }}"></script>
    <script src="{{ asset('javascript/bootstrap.min.js') }}"></script> 
    <script src="{{ asset('javascript/jquery.easing.js') }}"></script>    
    <script src="{{ asset('javascript/jquery-waypoints.js') }}"></script>  
    <script src="{{ asset('javascript/jquery.cookie.js') }}"></script>
    <script src="{{ asset('javascript/parallax.js') }}"></script>
    <script src="{{ asset('javascript/smoothscroll.js') }}"></script>  
    <script src="{{ asset('javascript/main.js') }}"></script>
@endsection