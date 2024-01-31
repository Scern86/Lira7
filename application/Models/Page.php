<?php

namespace Scern\Lira\Application\Models;

use Scern\Lira\Lexicon\Lang;
use Scern\Lira\Model;

class Page extends Model
{
    protected string $table = 'web_pages';
    protected string $table_content = 'web_pages_content';

    public function __construct(protected $database)
    {
    }

    public function getById(int $pageId, Lang $lang): ?\Scern\Lira\Application\Objects\Page
    {
        try {
            $query = $this->database->prepare("SELECT * FROM {$this->table} AS p,{$this->table_content} AS pc 
         WHERE p.id=pc.id_page AND p.id = :id AND pc.language = :language");
            $query->execute(
                [
                    'id' => $pageId,
                    'language' => $lang->code
                ]
            );
            $query->setFetchMode(\PDO::FETCH_CLASS, \Scern\Lira\Application\Objects\Page::class);
            return $query->fetch();
        } catch (\Exception $e) {
            //var_dump($e);
            return null;
        }
    }
}