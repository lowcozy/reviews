@if(!$comments->isEmpty())
@foreach($comments as $user)
	   <li class="comment">
                                            <article class="comment-body clearfix">        
                                                <div class="comment-author">
                                                @if($user->avatar == null)
                                                    <img style="width: 84px; height: 84px;" 
                                                    src="{{ asset('images/services/noavatar.png') }}" alt="image">  
                                                @else 
                                                     <img style="width: 84px; height: 84px;" 
                                                     <?php $path='uploads/avatar/'.$user->avatar ?>
                                                    src="{{ asset($path) }}" alt="image"> 
                                                @endif
                                                </div><!-- .comment-author -->
                                                <div class="comment-text">
                                                    <div class="comment-metadata">
                                                        <h5><a href="#">{{ $user->first_name }} {{ $user-> last_name }}</a></h5>  
                                                        <p class="day">{!! Time::diff($user->created_at) !!}</p> <div class="flat-start">
                                                           
                                                           {!! StarRating::rate($user->rate) !!}
                                                        </div>             
                                                    </div><!-- .comment-metadata -->
                                                    <div class="comment-content">
                                                        <p>{{ $user->content }}</p>
                                                    </div><!-- .comment-content -->
                                                </div><!-- /.comment-text --> 
                                                <br>

                                                    <!-- Hien thi anh? cua? cmt -->
                                                    <?php $imageComments = $user->images()->get() ?>
                                                    @if(count($imageComments) > 0)
                                                    <div class="row" id="profile-grid">
                                                      @foreach($imageComments as $image)
                                                          <?php $path="../uploads/comment/".$image->url ?>
                                                          <div class="col-sm-4 col-xs-12">
                                                            <div class="panel panel-default">
                                                              <div class="panel-thumbnail">
                                                                <a href="#" title="image 1" class="thumb">
                                                                  <img src="{{ $path }}" class="img-responsive img-rounded" data-toggle="modal" data-target=".modal-profile-lg">
                                                                </a>
                                                              </div>
                                                            </div>
                                                        </div>
                                                      @endforeach
                                                    </div>
                                                    @endif                
                                            </article><!-- .comment-body -->
                                        </li><!-- #comment-## -->
@endforeach
<div id="remove-row">
    <button id="btn-more" data-id="{{ $user->comment_id }}" class="nounderline btn-block mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" > Load More </button>
</div>
@endif

