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
    <?= $this->page->render($this->lexicon); ?>
    <link rel="icon" href="/favicon.ico?v0">
    <?= implode('', $this->headersLinks); ?>
</head>
<body data-default-lang="<?= $this->lexicon->defaultLang->code; ?>">
<div class="content">
    <header>
        <a class="logo" href="<?= $this->makeLink('/'); ?>">LIRA</a>
        <div class="menu">
            <ul class="nav">
                <li class="item"><a class="link"
                                    href="<?= $this->makeLink('/'); ?>"><?= $this->lexicon->get('success', 'Success page'); ?></a>
                </li>
                <li class="item"><a class="link"
                                    href="<?= $this->makeLink('/error'); ?>"><?= $this->lexicon->get('error', 'Error page'); ?></a>
                </li>
                <li class="item"><a class="link" href="/json"><?= $this->lexicon->get('json', 'Json response'); ?></a>
                </li>
                <li class="item"><a class="link"
                                    href="<?= $this->makeLink('/profile'); ?>"><?= $this->lexicon->get('profile', 'Auth page'); ?></a>
                </li>
                <li class="item"><a class="link"
                                    href="<?= $this->makeLink('/redirect'); ?>"><?= $this->lexicon->get('redirect', 'Redirect page'); ?></a>
                </li>
                <li class="item"><a class="link"
                                    href="<?= $this->makeLink('/internal'); ?>"><?= $this->lexicon->get('internal', 'Internal Redirect page'); ?></a>
                </li>
            </ul>
            <div role="button" class="mobile-menu-btn"></div>
        </div>
        <ul class="lang-select">
            <?= $langList; ?>
        </ul>
    </header>
    <main>
        <div class="wrapper">
            <?= $this->content; ?>
        </div>
    </main>
    <footer>
        <div class="wrapper">
            <div class="contacts"></div>
            <div class="menu">
                <ul class="nav">
                    <li class="item"><a class="link"
                                        href="<?= $this->makeLink('/'); ?>"><?= $this->lexicon->get('success', 'Success page'); ?></a>
                    </li>
                    <li class="item"><a class="link"
                                        href="<?= $this->makeLink('/error'); ?>"><?= $this->lexicon->get('error', 'Error page'); ?></a>
                    </li>
                    <li class="item"><a class="link"
                                        href="/json"><?= $this->lexicon->get('json', 'Json response'); ?></a></li>
                </ul>
                <ul class="nav">
                    <li class="item"><a class="link"
                                        href="<?= $this->makeLink('/profile'); ?>"><?= $this->lexicon->get('profile', 'Auth page'); ?></a>
                    </li>
                    <li class="item"><a class="link"
                                        href="<?= $this->makeLink('/redirect'); ?>"><?= $this->lexicon->get('redirect', 'Redirect page'); ?></a>
                    </li>
                    <li class="item"><a class="link"
                                        href="<?= $this->makeLink('/internal'); ?>"><?= $this->lexicon->get('internal', 'Internal Redirect page'); ?></a>
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