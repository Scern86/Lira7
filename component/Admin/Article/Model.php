<?php

namespace Scern\Lira\Component\Admin\Article;

use Scern\Lira\Lexicon\Lang;

class Model extends \Scern\Lira\Model
{
    protected string $table = 'web_articles';
    protected string $table_content = 'web_articles_content';

    public function __construct(protected $database)
    {
    }

    public function getArticlesList(Lang $lang): array
    {
        try{
            $query = $this->database->prepare("SELECT * FROM {$this->table} AS a,{$this->table_content} AS ac WHERE a.id=ac.id_article AND ac.language = :language ORDER BY a.id DESC");
            $query->execute(['language'=>$lang->code]);
            return $query->fetchAll(\PDO::FETCH_ASSOC);
        }catch (\Exception $e){
            //var_dump($e);
            return [];
        }
    }

    public function getArticleById(int $articleId,Lang $lang): array|bool
    {
        try{
            $query = $this->database->prepare("SELECT * FROM {$this->table} AS a,{$this->table_content} AS ac WHERE a.id=ac.id_article AND a.id = :id AND ac.language = :language");
            $query->execute(['id'=>$articleId,'language'=>$lang->code]);
            return $query->fetch(\PDO::FETCH_ASSOC);
        }catch (\Exception $e){
            //var_dump($e);
            return false;
        }
    }

    public function updateArticle(int $articleId,string $created,Lang $lang,string $title,string $content): void
    {
        try{
            $articleQuery = $this->database->prepare("UPDATE {$this->table} SET created = :created WHERE id = :id");
            $articleQuery->execute(['id'=>$articleId,'created'=>$created]);
            $contentQuery = $this->database->prepare("UPDATE {$this->table_content} SET title = :title, content = :content WHERE id_article = :id_article AND language = :language");
            $contentQuery->execute(['id_article'=>$articleId,'language'=>$lang->code,'title'=>$title,'content'=>$content]);
        }catch (\Exception $e){
            //var_dump($e);

        }
    }

    public function createArticle(string $title,string $content, array $langs): ?array
    {
        try{
            $articleQuery = $this->database->prepare("INSERT INTO {$this->table} (created) VALUES(:created) RETURNING *");
            $articleQuery->execute(['created'=>date('Y-m-d')]);
            $article = $articleQuery->fetch(\PDO::FETCH_ASSOC);
            foreach($langs as $lang){
                $contentQuery = $this->database->prepare("INSERT INTO {$this->table_content} (id_article,language,title,content) VALUES(:id_article,:language,:title,:content)");
                $contentQuery->execute(['id_article'=>$article['id'],'language'=>$lang,'title'=>$title,'content'=>$content]);
            }
            return $article;
        }catch (\Exception $e){
            //var_dump($e);
            return null;
        }
    }
}