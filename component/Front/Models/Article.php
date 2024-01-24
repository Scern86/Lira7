<?php

namespace Scern\Lira\Component\Front\Models;

use Scern\Lira\Lexicon\Lang;
use Scern\Lira\Model;

class Article extends Model
{
    protected string $table = 'web_articles';
    protected string $table_content = 'web_articles_content';

    public function __construct(protected $database)
    {
    }

    public function getListArticles(): array
    {
        try{
            $query = $this->database->prepare("SELECT * FROM {$this->table} AS a,{$this->table_content} AS ac WHERE a.id=ac.id_article AND ac.language = :language");
            $query->execute(['language'=>'ru']);
            return $query->fetchAll(\PDO::FETCH_ASSOC);
        }catch (\Exception $e){
            //var_dump($e);
            return [];
        }
    }

    public function getArticleById(int $articleId, Lang $lang): array|bool
    {
        try{
            $query = $this->database->prepare("SELECT a.id,a.created,ac.* FROM {$this->table} AS a,{$this->table_content} AS ac WHERE a.id=ac.id_article AND a.id = :id AND ac.language = :language");
            $query->execute(['id'=>$articleId,'language'=>$lang->code]);
            return $query->fetch(\PDO::FETCH_ASSOC);
        }catch (\Exception $e){
            //var_dump($e);
            return [];
        }
    }
}