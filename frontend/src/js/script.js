const init = function (defaultLang){
    $('body').on('click','.lang:not(.active)',e=>{
        let currentLang = $('.lang.active').data('lang'),
            selectedLang = $(e.target).data('lang');
        changeLang(selectedLang,defaultLang,currentLang);
    });
};

const changeLang = function(selectedLang,defaultLang,currentLang){
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

export {init,changeLang}