<!DOCTYPE html>
<html>
<head>
	  <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
	<title>Test</title>
</head>
<body>
<script>
	window.fbAsyncInit = function(){
FB.init({
    appId: '1121185011376046', status: true, cookie: true, xfbml: true }); 
};
(function(d, debug){var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
    if(d.getElementById(id)) {return;}
    js = d.createElement('script'); js.id = id; 
    js.async = true;js.src = "//connect.facebook.net/en_US/all" + (debug ? "/debug" : "") + ".js";
    ref.parentNode.insertBefore(js, ref);}(document, /*debug*/ false));
function postToFeed(title, desc, url, image){
var obj = {method: 'feed',link: url, picture: 'http://www.url.com/images/'+image,name: title,description: desc};
function callback(response){}
FB.ui(obj, callback);
}
</script>

<a href="https://listing.vn/test" data-image="article-1.jpg" data-title="Article Title" data-desc="Some description for this article" class="btnShare">Share</a>

<script>
	$('.btnShare').click(function(){
elem = $(this);
postToFeed(elem.data('title'), elem.data('desc'), elem.prop('href'), elem.data('image'));

return false;
});
</script>
</body>
</html>