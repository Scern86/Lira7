$('body')
    .on('click','.lang:not(.active)',e=>{
    let currentLang = $('.lang.active').data('lang'),
        selectedLang = $(e.target).data('lang');
    changeLang(selectedLang,currentLang)
})
.on('click','.mobile-menu-btn',()=>{
    $('header .nav').addClass('active');
    $('body').css({'overflow':'hidden'});
})
.on('click','header .nav',e=>{
    $('header .nav').removeClass('active');
    $('body').css({'overflow':'visible'});
});


const changeLang = function(selectedLang,currentLang){
    const defaultLang = document.body.getAttribute('data-default-lang');
    let loc = (window.location+'').replace(/\/+$/,'');
    if(currentLang===defaultLang){
        if(selectedLang !== defaultLang){
            loc = loc.replace(/.local/,'.local/'+selectedLang);
        }
    }else{
        if(selectedLang===defaultLang){
            loc = loc.replace(/.local\/[a-z]{2}/,'.local');
        }
        else{
            loc = loc.replace(/.local\/[a-z]{2}/,'.local/'+selectedLang);
        }
    }
    window.location = loc;
}