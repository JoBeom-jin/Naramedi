


<!-- 페이스북 로그인 -->
<?if($method=='facebook'):?>
<form method="post" action="<?=$menu_url?>/loginFromSNS" id="sns-form">
	<input type="hidden" name="sns" value="" id="sns" />
	<input type="hidden" name="email" value="" id="email"/>
	<input type="hidden" name="name" value="" id="name"/>
	<input type="hidden" name="gender" value="" id="gender"/>
</form>

<script>
$('document').ready(function(){



window.fbAsyncInit = function() {
    FB.init({
      appId      : '1468754303245547',
      cookie     : true,
      xfbml      : true,
      version    : 'v2.10',
    });
    FB.AppEvents.logPageView();   
	

	FB.getLoginStatus(function(response) {
		if(response.status !== 'connected'){		
			FB.login(function(response){
				document.location.reload();
			},  {scope: 'public_profile, email'});
		}else{
			FB.api('/me', {fields: 'email, name, gender'}, function(response) {	
				console.log(response);
				$('#sns').val('facebook');
				$('#email').val(response.id);
				$('#name').val(response.name);
				$('#gender').val(response.gender);
				$('#sns-form').submit();
			});
		}
	});
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));





});
  
</script>


<?elseif($method == 'naver'):?>
<form method="post" action="<?=$menu_url?>/loginFromSNS" id="sns-form">
	<input type="hidden" name="sns" value="naver" id="sns" />
	<input type="hidden" name="email" value="<?=$email?>" id="email"/>
	<input type="hidden" name="name" value="<?=$name?>" id="name"/>
	<input type="hidden" name="gender" value="<?=$gender?>" id="gender"/>
</form>

<!-- 네이버 로그인 -->
<script type="text/javascript">
$(document).ready(function(){
	$('#sns-form').submit();
});
</script>


<?elseif($method=='kakao'):?>

<?endif;?>