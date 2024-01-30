<?php
$langList = (new \Scern\Lira\View($this->lexicon))
    ->render(ROOT_DIR . DS . 'component' . DS . 'Front' . DS . 'templates' . DS . '_langs_select.inc');
?>
<!doctype html>
<html lang="<?= $this->lexicon->currentLang->code; ?>">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="viewport"
          content="width=device-width, shrink-to-fit=no, initial-scale=1.0, maximum-scale=2.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?= $this->seo->render(); ?>
    <link rel="icon" href="/favicon.ico?v0">
    <?= implode('', $this->headersLinks); ?>
</head>
<body data-default-lang="<?= $this->lexicon->defaultLang->code; ?>">
<div class="content">
    <header>
        <a class="logo" href="/">SCERN</a>
        <div class="menu">
            <ul class="nav">
                <li class="item"><a class="link" href="<?=$this->makeLink('/admin/article');?>">Article</a></li>
                <li class="item"><a class="link" href="<?=$this->makeLink('/admin/category');?>">Category</a></li>
                <li class="item"><a class="link" href="<?=$this->makeLink('/admin/page');?>">Page</a></li>
            </ul>
            <div role="button" class="mobile-menu-btn"></div>
        </div>
        <ul class="lang-select">
            <?= $langList; ?>
        </ul>
    </header>
    <main>
        <?= $this->content; ?>
    </main>
    <footer>
        <div class="wrapper">
            <div class="contacts">
                <p><strong><?= $this->lexicon->get('contacts'); ?></strong></p>
                <p>Phone: +1 (234) 567-89-01</p>
                <p>Email: info@example.com</p>
            </div>
            <div class="menu">
                <ul class="nav">
                    <li class="item"><a class="link"
                                        href="<?= $this->makeLink('/'); ?>"><?= $this->lexicon->get('home'); ?></a></li>
                    <li class="item"><a class="link"
                                        href="<?= $this->makeLink('/about'); ?>"><?= $this->lexicon->get('about'); ?></a>
                    </li>
                    <li class="item"><a class="link"
                                        href="<?= $this->makeLink('/blog'); ?>"><?= $this->lexicon->get('blog'); ?></a>
                    </li>
                    <li class="item"><a class="link"
                                        href="<?= $this->makeLink('/projects'); ?>"><?= $this->lexicon->get('projects'); ?></a>
                    </li>
                    <li class="item"><a class="link"
                                        href="<?= $this->makeLink('/catalog'); ?>"><?= $this->lexicon->get('catalog'); ?></a>
                    </li>
                    <li class="item"><a class="link" href="<?= $this->makeLink('/profile'); ?>">Profile</a></li>
                    <li class="item"><a class="link" href="<?= $this->makeLink('/test'); ?>">Test redirect</a></li>
                    <li class="item"><a class="link" href="<?= $this->makeLink('/error'); ?>">Error</a></li>
                    <li class="item"><a class="link" href="<?= $this->makeLink('/admin'); ?>">Admin panel</a></li>
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
                    <?= $langList; ?>
                </ul>
                <div class="copyright">
                    © 2024 SCERN
                </div>
            </div>
        </div>
    </footer>
</div>
<?= implode('', $this->bodysLinks); ?>
</body>
</html>