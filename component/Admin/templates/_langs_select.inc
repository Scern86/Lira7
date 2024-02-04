<?php foreach($this->lexicon->languagesList as $lang){ ?>
    <li class="lang <?=$lang==$this->lexicon->currentLang->code?'active':'';?>" data-lang="<?=$lang;?>"><?=strtoupper($lang);?></li>
<?php } ?>