<?php

namespace Scern\Lira\Component\Front\Article;

use Scern\Lira\Component\Front\Article\ArticleData;
use Scern\Lira\Database\Database;
use Scern\Lira\Lexicon\Lang;
use Scern\Lira\Model;

class ArticleModel extends Model
{
    protected string $table = 'web_articles';
    protected string $tableContent = 'web_articles_content';

    public function __construct(Database $database)
    {
        parent::__construct($database);
    }
    public function getArticleById(int $id,Lang $lang): ArticleData
    {
        try {
            $query = $this->db->prepare("SELECT a.*,ac.language,ac.title,ac.content 
FROM {$this->table} AS a,{$this->tableContent} AS ac 
         WHERE a.id=ac.id_article AND a.id = :id AND ac.language = :language");
            $query->execute(
                [
                    'id' => $id,
                    'language' => $lang->code
                ]
            );
            $result = $query->fetch(\PDO::FETCH_ASSOC);
            if(empty($result)) throw new \Exception('Article not found');
            return new ArticleData(...$result);
        } catch (\Exception $e) {
            return new ArticleData();
        }
    }
}