//Initialize tooltips
$('.nav-tabs > li a[title]').tooltip();

//Wizard
$('a[data-toggle="tab"]').on('show.bs.tab', function (e) {
    var $target = $(e.target);
    if ($target.hasClass('disabled')) {
        return false;
    }
    var count=0;
    $('form#myvalidation').each(function(){
        $('div.tab-pane.active .form-control').each(function(){
        var validcheck=$(this);
        if(!validcheck[0].validity.valid){
            count++;
            if(!validcheck.data("massage"))
                toastr.error(validcheck[0].validationMessage);
            else 
                toastr.error(validcheck.data("massage"));
            validcheck.addClass('is-invalid');
            validcheck[0].focus();
            return false;
        }else{
            validcheck.removeClass('is-invalid');
            return true;
        }
        });
    });

    if ($(this).hasClass('last-step')) {
        $('form#myvalidation').each(function(){
            $('div.tab-pane .form-control').each(function(){
                var valuecheck=$(this);
                $(".span_"+valuecheck[0].name).text(valuecheck[0].value);
            });
        });
    }
    if(count!=0){
        return false;
    }
    return true;
});

$(".next-step").click(function (e) {
    var $active = $('.wizard .nav-tabs .nav-item .active');
    var $activeli = $active.parent("li");
    var count=0;
    $('form#myvalidation').each(function(){
        $('div.tab-pane.active .form-control').each(function(){
        var validcheck=$(this);
        if(!validcheck[0].validity.valid){
            count++;
            if(!validcheck.data("massage"))
                toastr.error(validcheck[0].validationMessage);
            else 
                toastr.error(validcheck.data("massage"));
            validcheck.addClass('is-invalid');
            validcheck[0].focus();
            return false;
        }else{
            validcheck.removeClass('is-invalid');
            return true;
        }
        });
    });
    if ($(this).hasClass('last-step')) {
        $('form#myvalidation').each(function(){
            $('div.tab-pane .form-control').each(function(){
                var valuecheck=$(this);
                $(".span_"+valuecheck[0].name).text(valuecheck[0].value);
            });
        });
    }
    if(count==0){
        $($activeli).next().find('a[data-toggle="tab"]').removeClass("disabled");
        $($activeli).next().find('a[data-toggle="tab"]').click();
    }
    
});

$(".last-button").click(function (e) {
   $('form').submit(); 
});

$(".prev-step").click(function (e) {

    var $active = $('.wizard .nav-tabs .nav-item .active');
    var $activeli = $active.parent("li");
    $($activeli).prev().find('a[data-toggle="tab"]').removeClass("disabled");
    $($activeli).prev().find('a[data-toggle="tab"]').click();

});