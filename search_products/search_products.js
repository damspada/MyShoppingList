
var stepFilter = 60;
var Scrolling = true;


$(".back_menus").bind("click", function(e){
    e.preventDefault();
    $(".filter_wrapper").animate({
        scrollLeft: "-=" + stepFilter +"px"
    })
})

$(".next_menus").bind("click", function(e){
    e.preventDefault();
    $(".filter_wrapper").animate({
        scrollLeft: "+=" + stepFilter +"px"
    })
})

