<?php

namespace Scern\Lira\Component\Admin\Article;

class Model extends \Scern\Lira\Model
{
    protected string $table = 'web_articles';

    public function __construct(protected $database)
    {
    }

    public function getArticlesList(): array
    {
        try{
            $query = $this->database->prepare("SELECT * FROM {$this->table} ORDER BY created DESC");
            $query->execute();
            return $query->fetchAll(\PDO::FETCH_ASSOC);
        }catch (\Exception $e){
            //var_dump($e);
            return [];
        }
    }

    public function getArticleById(int $articleId): array|bool
    {
        try{
            $query = $this->database->prepare("SELECT * FROM {$this->table} WHERE id = :id");
            $query->execute(['id'=>$articleId]);
            return $query->fetch(\PDO::FETCH_ASSOC);
        }catch (\Exception $e){
            //var_dump($e);
            return false;
        }
    }

    public function updateArticle(int $articleId,string $created,string $title,string $content): void
    {
        try{
            $query = $this->database->prepare("UPDATE {$this->table} SET created = :created,title = :title, content = :content WHERE id = :id");
            $query->execute(['id'=>$articleId,'created'=>$created,'title'=>$title,'content'=>$content]);
        }catch (\Exception $e){
            //var_dump($e);

        }
    }

    public function createArticle(string $title,string $content): ?array
    {
        try{
            $query = $this->database->prepare("INSERT INTO {$this->table} (title,content) VALUES(:title,:content) RETURNING *");
            $query->execute(['title'=>$title,'content'=>$content]);
            return $query->fetch(\PDO::FETCH_ASSOC);
        }catch (\Exception $e){
            //var_dump($e);
            return null;
        }
    }
}