<script type="text/javascript" src="/resource/assets/js/lightslider.js"></script>
<script>
//document ready function 
$(document).ready(function() {
	runLightSlider('#adaptive');
});


//lightSlider running
function runLightSlider(el){
	$(el).lightSlider({
        adaptiveHeight:true,
        item:1,
	    auto:true,
        loop:true,
        slideMargin:0,
    });
}   

</script>