<?php

namespace Scern\Lira\Component\Front\Models;

use Scern\Lira\Component\Admin\Article\Model;

class Article extends Model
{
    protected string $table = 'web_articles';

    public function __construct(protected $database)
    {
    }

    public function getListArticles(): array
    {
        try{
            $query = $this->database->prepare("SELECT * FROM {$this->table}");
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
            return [];
        }
    }
}