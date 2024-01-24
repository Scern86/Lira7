<?php
$langs = ['ru','en','gr','de','es'];
?>
<!doctype html>
<html lang="<?=$this->lexicon->currentLang->code;?>">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="viewport"
          content="width=device-width, shrink-to-fit=no, initial-scale=1.0, maximum-scale=2.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?=$this->meta_title;?></title>
    <meta name="description" content="<?=$this->meta_description;?>">
    <meta name="keywords" content="<?=$this->meta_keyword;?>">
    <link rel="icon" href="/favicon.ico?v0">
    <link rel="stylesheet" href="/assets/css/style.min.css?<?=time();?>">
</head>
<body>
    <div class="content">
        <header>
            <a class="logo" href="/">SCERN</a>
            <div class="menu">
                <ul class="nav">
                    <li class="item"><a class="link" href="<?=$this->makeLink('/');?>"><?=$this->lexicon->get('home');?></a></li>
                    <li class="item"><a class="link" href="<?=$this->makeLink('/about');?>"><?=$this->lexicon->get('about');?></a></li>
                    <li class="item"><a class="link" href="<?=$this->makeLink('/catalog');?>"><?=$this->lexicon->get('catalog');?></a></li>
                    <li class="item"><a class="link" href="<?=$this->makeLink('/profile');?>">Profile</a></li>
                    <li class="item"><a class="link" href="<?=$this->makeLink('/test');?>">Test redirect</a></li>
                    <li class="item"><a class="link" href="<?=$this->makeLink('/error');?>">Error</a></li>
                    <li class="item"><a class="link" href="<?=$this->makeLink('/admin');?>">Admin panel</a></li>
                    <li class="item"><a class="link" href="/api">API</a></li>
                </ul>
                <div role="button" class="mobile-menu-btn"></div>
            </div>
            <ul class="lang-select">
                <?php foreach($langs as $lang){ ?>
                    <li class="lang <?=$lang==$this->lexicon->currentLang->code?'active':'';?>" data-lang="<?=$lang;?>"><?=strtoupper($lang);?></li>
                <?php } ?>
            </ul>
        </header>
        <main>
            <div class="wrapper">
                <?=$this->content;?>
            </div>
        </main>
        <footer>
            <div class="wrapper">
                <div class="contacts">
                    <p><strong>Contacts</strong></p>
                    <p>Phone: +30 (123) 234-56-78</p>
                    <p>Email: scern@scern.gr</p>
                </div>
                <div class="menu">
                    <ul class="nav">
                        <li class="item"><a class="link" href="<?=$this->makeLink('/');?>"><?=$this->lexicon->get('home');?></a></li>
                        <li class="item"><a class="link" href="<?=$this->makeLink('/about');?>"><?=$this->lexicon->get('about');?></a></li>
                        <li class="item"><a class="link" href="<?=$this->makeLink('/catalog');?>"><?=$this->lexicon->get('catalog');?></a></li>
                        <li class="item"><a class="link" href="<?=$this->makeLink('/profile');?>">Profile</a></li>
                        <li class="item"><a class="link" href="<?=$this->makeLink('/test');?>">Test redirect</a></li>
                        <li class="item"><a class="link" href="<?=$this->makeLink('/error');?>">Error</a></li>
                        <li class="item"><a class="link" href="<?=$this->makeLink('/admin');?>">Admin panel</a></li>
                        <li class="item"><a class="link" href="/api">API</a></li>
                    </ul>
                    <ul class="nav">
                        <li class="item">
                            <a class="link" href="/">LinkedIn</a>
                        </li>
                        <li class="item">
                            <a class="link" href="/about">GitHub</a>
                        </li>
                    </ul>
                </div>
                <div class="right">
                    <ul class="lang-select">
                        <?php foreach($langs as $lang){ ?>
                            <li class="lang <?=$lang==$this->lexicon->currentLang->code?'active':'';?>" data-lang="<?=$lang;?>"><?=strtoupper($lang);?></li>
                        <?php } ?>
                    </ul>
                    <div class="copyright">
                        © 2023 SCERN
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <script defer src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script type="module">
        import {init} from '/assets/js/script.min.js?v0';
        init('<?=$this->lexicon->defaultLang->code;?>');
    </script>
</body>
</html>