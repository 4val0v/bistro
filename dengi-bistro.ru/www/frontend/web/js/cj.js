/*var myData = [500, 1000, 1500, 2000, 2500, 3000, 3500, 4000, 4500, 5000, 5500, 6000, 6500, 7000, 7500, 8000, 8500, 9000, 9500, 10000, 11000, 12000, 13000, 14000, 15000, 16000, 17000, 18000, 19000, 20000, 21000, 22000, 23000, 24000, 25000, 26000, 27000, 28000, 29000, 30000, 35000, 40000, 45000, 50000, 60000, 70000, 80000, 90000, 100000, 100200];
slider_config = {
        range: "min",
        min: 0,
        max: myData.length - 1,
        step: 1,
        animate: true,
        slide: function( event, ui ) {
            var c=myData[ ui.value ];
            if(c==100200)
                $('#count').text( '100 000+' );
            else
            {
                c=c+'';
                $('#count').text( c.substr(0, c.length - 3)+' '+c.substr(c.length-3) );
            } 
            $('#creditform-sum').val( myData[ ui.value ] );
        },
        create: function() {
            $(this).slider('value',myData.length - 6);
        }
    };

$("#slider").slider(slider_config);*/

$("#pjax-first").on("pjax:end", function() {
    var top = $('#companies').offset().top;
    $('body,html').animate({scrollTop: top}, 1000);
});

/*$("#pjax-second").on("pjax:end", function() {
    var top = $('#company_list').offset().top;
    $('body,html').animate({scrollTop: top}, 500);
});*/

$("#torecomend").on("click", function(e) {
    e.preventDefault();
    var top = $('#recomend').offset().top;
    $('body,html').animate({scrollTop: top}, 1000);
});
var top_show = 250; 
$(document).ready(function() {
    $(window).scroll(function () { 
      if ($(this).scrollTop() > top_show) $('#totop').fadeIn();
      else $('#totop').fadeOut();
    });
    $('#totop').click(function () {
      $('body, html').animate({
        scrollTop: 0
      }, 1000);
    });
  });
function likecomm(id)
{
    $.get('/main/plus', {id : id}, function(data){
        var data= $.parseJSON(data);
        if(data.likes!="no")
            $('.count_likes'+id).html(' '+data.likes+' ');
        else
            $('#myModal').modal('show');
   });
}
function dislikecomm(id)
{
    $.get('/main/minus', {id : id}, function(data){
        var data= $.parseJSON(data);
        if(data.likes!="no")
            $('.count_likes'+id).html(' '+data.likes+' ');
        else
            $('#myModal').modal('show');
   });
}
$('.foottitle').on('click', function(){
    if ($(window).width() <= '749'){
        var id=$(this).attr('data-acp');
        if($('.acdiv'+id).css('display')=='none')
        {
            $('.acdiv'+id).css('display', 'block');
            $('.znak'+id).removeClass('fa-plus').addClass('fa-minus');
        }
        else if($('.acdiv'+id).css('display')=='block')
        {
            $('.acdiv'+id).css('display', 'none');
            $('.znak'+id).removeClass('fa-minus').addClass('fa-plus');
        }
    }
});