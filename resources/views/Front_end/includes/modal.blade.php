 <div class="modal fade flat-popupform" id="popup_login">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body text-center clearfix">
                        <form class="form-login form-listing" action="#" method="post">
                            @csrf
                            <h3 class="title-formlogin">Log in</h3>
                            <span class="input-login icon-form"><input 
                             id = "emailLogin"  style="color:black;"
                             type="text" placeholder="Your Email*" name="email" required="required"><i class="fa fa-user"></i>
                            </span>

                            <span class="input-login icon-form"><input
                             id = "passwordLogin"  style="color:black;"
                             type="password" placeholder="Password*" name="password" required="required"><i class="fa fa-lock"></i></span>
                            <div class="flat-fogot clearfix">
                                
                                <p style="color:red; float:left; display: none;" class="error errorEmail"></p> 
                                <p style="color:red; float:left; display: none;" class="error errorPassword"></p> 
                                <p style="color:red; float:left; display: none;" class="error errorAccount"></p> 
                                <br>
                            </div>
                            <span class="wrap-button">
                                <button type="button" id="login-button" onclick="ajaxLogin()" class=" login-btn effect-button" title="log in">LOG IN</button>
                            </span>
                        </form>
                    </div>
                </div>
            </div>
    </div> 

    <script>
      function ajaxLogin(){

        $.ajax({
            type : 'post',
            url : '{{ route('loginAjax') }}', 
            data :
            {
                'email' : $('#emailLogin').val(),
                'password' : $('#passwordLogin').val(),
                '_token' : "{{ csrf_token() }}"
            },
            success : function(data){
                console.log(data);
                if(data.errors == true){
                    $('.error.errorAccount').hide();
                    $('.error.errorEmail').hide();
                    $('.error.errorPassword').hide();
                            if (data.message.email != null) {
                                $('.error.errorEmail').show().text(data.message.email[0]);
                            }
                            if (data.message.password != null) {
                                $('.error.errorPassword').show().text(data.message.password[0]);
                            }
                }
                else
                {
                    if(data.checkLogin == true)
                    {
                          $('#popup_login').modal('toggle');
                          location.reload(true);
                         //window.location.href = "{{ route('home') }}";
                    }
                    else
                    {   
                        $('.error.errorEmail').hide();
                        $('.error.errorPassword').hide();
                        $('.error.errorAccount').show().text('Sai password hoac mat khau');
                    }
                }
            }
        });
      }
    </script> 

<!-- Modal Register
 -->    <div class="modal fade flat-popupform" id="popup_register">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body text-center clearfix">
                        <form class="form-login form-listing" action="#" method="post">
                             @csrf
                            <h3 class="title-formlogin">Sign Up</h3>
                            <span class="input-login icon-form"><input type="text" placeholder="Your First Name*"   style="color:black;"
                                name="first_name" id ="first_name"
                                required="required"><i class="fa fa-user"></i></span>
                             <span class="input-login icon-form"><input type="text" placeholder="Your Last Name*"   style="color:black;"
                                name="last_name" id ="last_name"
                                required="required"><i class="fa fa-user"></i></span>

                            <span class="input-login icon-form"><input type="text" placeholder="E-mail*"  style="color:black;"
                                id = "emailRegister"
                                name="email" required="required"><i class="fa fa-envelope-o"></i></span>

                            <span class="input-login icon-form"><input type="password" placeholder="Password*"  style="color:black;"
                                id = "passwordRegister"
                             name="password" required="required"><i class="fa fa-lock"></i></span>

                             <span class="input-login icon-form"><input type="password" placeholder="Repeat Password*"  style="color:black;"
                                id="password-confirm" name="password_confirmation"
                               required="required"><i class="fa fa-lock"></i></span>
                            <div>
                                <p style="color:red; float:left; display: none;" class="error errorLastName"></p> <br>
                                <p style="color:red; float:left; display: none;" class="error errorFirstName"></p> <br>
                                <p style="color:red; float:left; display: none;" class="error errorEmailRegister"></p> <br>
                                <p style="color:red; float:left; display: none;" class="error errorPasswordRegister"></p> <br>
                                <br>
                                <button type="button" id="logup-button"
                                 onclick = "ajaxRegister()"
                                 class=" login-btn effect-button" title="log in">LOG UP</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </div> 
<!-- Modal Register -->

    <script>
      function ajaxRegister(){
                  
        $.ajax({
            type : 'post',
            url : '{{ route('registerAjax') }}', 
            data :
            {
                'first_name' : $('#first_name').val(),
                'last_name' : $('#last_name').val(),
                'email' : $('#emailRegister').val(),
                'password' : $('#passwordRegister').val(),
                'password_confirmation' : $('#password-confirm').val(),
                '_token' : "{{ csrf_token() }}"
            },
            success : function(data){
                console.log(data);
                if(data.errors == true){
                    $('.error.errorFirstName').hide();
                    $('.error.errorLastName').hide();
                    $('.error.errorEmail').hide();
                    $('.error.errorPassword').hide();
                            if (data.message.email !== null) {
                                $('.error.errorEmailRegister').show().text(data.message.email[0]);
                            }
                            if (data.message.password !== null) {
                                $('.error.errorPasswordRegister').show().text(data.message.password[0]);
                            }
                            if (data.message.first_name !== null) {
                                $('.error.errorFirstName').show().text(data.message.first_name[0]);
                            }
                            if (data.message.last_name !== null) {
                                $('.error.errorLastName').show().text(data.message.last_name[0]);
                            }
                }
                else
                {
                          $('#popup_register').modal('toggle');
                          location.reload(true);
                         //window.location.href = "{{ route('home') }}";
                    
                }
            }
        });
      }
    </script> 

<!-- Modal Review -->
<div id="modalReview" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add a review</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form novalidate="" class="comment-form clearfix" id="commentform" method="post" action="#">
                                        
            <p class="comment-form-comment">
                <textarea class="" tabindex="4" id="comment" placeholder="Comment" name="comment" required></textarea>
            </p>

            <div id="divComment">   
                <p id="errorComment" style="color: red; display: none;">Plz Enter your comment</p><br>
            </div>

            <div class="start-review">
            <h5>Choose Images</h5>
             <input type="file" id="multiFiles" name="files[]" multiple="multiple"/>
             <br>
             <div id="preview"></div>
           
             <br>

            <h4>Your rating : <span class="live-rating"></span></h4>
            <span class="my-rating-9"></span>
            <input type="hidden" id="rate" value=''>
            </div> 

            <p id="errorRate" style="color: red; display: none;">Plz rate star the place</p><br>
            <input type="hidden" id="rate" value=''>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" onclick="review()" class="btn btn-default">Send Review</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal Review -->

<!-- Modal Picture Comment -->
  <!-- .modal-profile -->
  <div class="modal fade modal-profile" tabindex="-1" role="dialog" aria-labelledby="modalProfile" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button class="close" type="button" data-dismiss="modal">×</button>
          </div>
          <div class="modal-bodyy">
          </div>
          <div class="modal-footer">
            <button class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
        
      </div>
    </div>
  <!-- //.modal-profile -->