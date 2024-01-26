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
    <?=$this->seo->render();?>
    <link rel="icon" href="/favicon.ico?v0">
    <?=implode('',$this->headersLinks);?>
</head>
<body>
    <div class="content">
        <header>
            <a class="logo" href="/">SCERN</a>
            <div class="menu">
                <ul class="nav">
                    <li class="item"><a class="link" href="<?=$this->makeLink('/');?>"><?=$this->lexicon->get('home');?></a></li>
                    <li class="item"><a class="link" href="<?=$this->makeLink('/about');?>"><?=$this->lexicon->get('about');?></a></li>
                    <li class="item"><a class="link" href="<?=$this->makeLink('/blog');?>"><?=$this->lexicon->get('blog');?></a></li>
                    <li class="item"><a class="link" href="<?=$this->makeLink('/projects');?>"><?=$this->lexicon->get('projects');?></a></li>
                    <li class="item"><a class="link" href="<?=$this->makeLink('/contacts');?>"><?=$this->lexicon->get('contacts');?></a></li>
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
                    <p><strong><?=$this->lexicon->get('contacts');?></strong></p>
                    <p>Phone: +30 (123) 234-56-78</p>
                    <p>Email: scern@scern.gr</p>
                </div>
                <div class="menu">
                    <ul class="nav">
                        <li class="item"><a class="link" href="<?=$this->makeLink('/');?>"><?=$this->lexicon->get('home');?></a></li>
                        <li class="item"><a class="link" href="<?=$this->makeLink('/about');?>"><?=$this->lexicon->get('about');?></a></li>
                        <li class="item"><a class="link" href="<?=$this->makeLink('/blog');?>"><?=$this->lexicon->get('blog');?></a></li>
                        <li class="item"><a class="link" href="<?=$this->makeLink('/projects');?>"><?=$this->lexicon->get('projects');?></a></li>
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
                        © 2024 SCERN
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <?=implode('\n',$this->bodysLinks);?>
    <script type="module">
        import {init} from '/assets/js/script.min.js?v0';
        init('<?=$this->lexicon->defaultLang->code;?>');
    </script>
</body>
</html>