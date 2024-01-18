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
    <header>
        <div class="logo">
            <a href="<?=$this->makeLink('/');?>">
                SCERN
            </a>
        </div>
        <ul class="nav">
            <li><a href="<?=$this->makeLink('/');?>">Home</a></li>
            <li><a href="<?=$this->makeLink('/about');?>">About</a></li>
            <li><a href="<?=$this->makeLink('/catalog');?>">Catalog</a></li>
            <li><a href="<?=$this->makeLink('/profile');?>">Profile</a></li>
            <li><a href="<?=$this->makeLink('/test');?>">Test redirect</a></li>
            <li><a href="<?=$this->makeLink('/error');?>">Error</a></li>
            <li><a href="<?=$this->makeLink('/admin');?>">Admin panel</a></li>
            <li><a href="/api">API</a></li>
        </ul>
    </header>
    <main>
        <div class="wrapper">
            <?=$this->content;?>
        </div>
    </main>
    <footer>
        <div class="copyright">&copy; 2023 SCERN</div>
        <?php
        $langs = ['ru','en','gr','de','es'];
        ?>
        <ul class="lang-select">
            <?php foreach($langs as $lang){ ?>
                <li class="lang <?=$lang==$this->lexicon->currentLang->code?'active':'';?>" data-lang="<?=$lang;?>"><?=strtoupper($lang);?></li>
            <?php } ?>
        </ul>
    </footer>
    <script defer src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script type="module">
        import {init} from '/assets/js/script.min.js?v0';
        init('<?=$this->lexicon->defaultLang->code;?>');
    </script>
</body>
</html>