jQuery(document).ready(function ($) {

    $('#checkbox').change(function(){
       setInterval(function () {
           moveRight();
       }, 3000);
     });
      
      $("#slider2 > div:gt(0)").hide();

    setInterval(function() { 
      $('#slider2 > div:first')
        .fadeOut(1000)
        .next()
        .fadeIn(1000)
        .delay(2000)
        .fadeOut(1000)
        .next()
        .fadeIn(1000)
        .delay(2000)
        .end()
        .appendTo('#slideshow');
    },  3000);

    $(function(){
        $('.fadein img:gt(0)').hide();
        setInterval(function(){
          $('.fadein :first-child').fadeOut()
             .next('img').fadeIn()
             .delay(5000)
             .end().appendTo('.fadein');}, 
          3000);
    });

	var slideCount = $('#slider ul li').length;
	var slideWidth = $('#slider ul li').width();
	var slideHeight = $('#slider ul li').height();
	var sliderUlWidth = slideCount * slideWidth;
	
	$('#slider').css({ width: slideWidth, height: slideHeight });
	
	$('#slider ul').css({ width: sliderUlWidth, marginLeft: - slideWidth });
	
    $('#slider ul li:last-child').prependTo('#slider ul');

    function moveLeft() {
        $('#slider ul').animate({
            left: + slideWidth
        }, 200, function () {
            $('#slider ul li:last-child').prependTo('#slider ul');
            $('#slider ul').css('left', '');
        });
    };

    function moveRight() {
        $('#slider ul').animate({
            left: - slideWidth
        }, 200, function () {
            $('#slider ul li:first-child').appendTo('#slider ul');
            $('#slider ul').css('left', '');
        });
    };

    $('a.control_prev').click(function () {
        moveLeft();
    });

    $('a.control_next').click(function () {
        moveRight();
    });

});    

