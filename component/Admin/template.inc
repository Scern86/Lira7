<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?=$this->meta_title;?></title>
    <style>
        html,body{
            margin:0;
            padding:0;
        }
        .lang-select{
            display: flex;
            list-style: none;
            gap: 10px;
        }
        .lang{
            padding: 5px 7px;
            cursor: pointer;
        }
        .lang.active{
            color: white;
            font-weight: 600;
            background-color:rebeccapurple;
        }
    </style>
</head>
<body style="background-color: cornsilk;position:relative;">
    <header>
        <br>
        <nav>
            <a href="<?=$this->makeLink('/admin/article');?>">Article</a>
        </nav>
    </header>
    <main style="min-height: 100vh">
        <div style="overflow: hidden;">
            <h1>Admin panel</h1>
        </div>
        <div class="center" style="max-width: 1140px;margin:0 auto">
            <?=$this->content;?>
        </div>
    </main>
    <footer style="width:100%;height: 50px;background-color: dimgrey;display: flex;justify-content: space-between;align-items: center">
        <ul style="display: flex;gap: 10px;list-style: none">
            <li><a href="<?=$this->makeLink('/');?>">Home</a></li>
            <li><a href="<?=$this->makeLink('/about');?>">About</a></li>
            <li><a href="<?=$this->makeLink('/catalog');?>">Catalog</a></li>
            <li><a href="<?=$this->makeLink('/profile');?>">Profile</a></li>
            <li><a href="<?=$this->makeLink('/test');?>">Test redirect</a></li>
            <li><a href="<?=$this->makeLink('/error');?>">Error</a></li>
            <li><a href="<?=$this->makeLink('/admin');?>">Admin panel</a></li>
            <li><a href="/api">API</a></li>
            <li><a href="<?=$this->makeLink('/admin/logout');?>" style="color:red;margin-left:30px">Logout</a></li>
        </ul>
        <?php
        $langs = ['ru','en','gr','de','es'];
        ?>
        <ul class="lang-select">
            <?php foreach($langs as $lang){ ?>
                <li class="lang <?=$lang==$this->lexicon->currentLang->code?'active':'';?>" data-lang="<?=$lang;?>"><?=strtoupper($lang);?></li>
            <?php } ?>
        </ul>
    </footer>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        document.addEventListener('DOMContentLoaded',()=>{
            $('.lang:not(.active)').on('click',e=>{
                let currentLang = $('.lang.active').data('lang'),
                    defaultLang = '<?=$this->lexicon->defaultLang->code;?>',
                    selectedLang = $(e.target).data('lang');
                changeLang(selectedLang,defaultLang,currentLang);
            });
        });
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
    </script>
</body>
</html>