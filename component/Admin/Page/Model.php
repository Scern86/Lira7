<?php

namespace Scern\Lira\Component\Admin\Page;

use Scern\Lira\Application\Objects\Page;
use Scern\Lira\Lexicon\Lang;

class Model extends \Scern\Lira\Model
{
    protected string $table = 'web_pages';
    protected string $table_content = 'web_pages_content';

    public function __construct(protected $database)
    {
    }

    public function getPagesList(Lang $lang): array
    {
        try {
            $query = $this->database->prepare("SELECT * FROM {$this->table} AS p,{$this->table_content} AS pc 
         WHERE p.id=pc.id_page AND pc.language = :language ORDER BY p.id DESC");
            $query->execute(
                [
                    'language' => $lang->code
                ]
            );
            return $query->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            //var_dump($e);
            return [];
        }
    }

    public function updatePage(Page $page, Lang $lang): void
    {
        try {
            $pageQuery = $this->database->prepare("UPDATE {$this->table} SET uri = :uri WHERE id = :id");
            $pageQuery->execute(['id' => $page->id, 'uri' => $page->uri]);
            $contentQuery = $this->database->prepare("UPDATE {$this->table_content} 
SET h1 = :h1, meta_title = :meta_title, meta_description = :meta_description,
    robots_index = :robots_index,robots_follow = :robots_follow 
WHERE id_page = :id_page AND language = :language");
            $contentQuery->execute(
                [
                    'id_page' => $page->id,
                    'language' => $lang->code,
                    'h1' => $page->h1,
                    'meta_title' => $page->meta_title,
                    'meta_description' => $page->meta_description,
                    'robots_index' => $page->robots_index?'t':'f',
                    'robots_follow' => $page->robots_follow?'t':'f',
                ]
            );
        } catch (\Exception $e) {
            //var_dump($e);
        }
    }

    public function createPage(Page $page, array $langs): ?int
    {
        try {
            $pageQuery = $this->database->prepare("INSERT INTO {$this->table} (uri) VALUES(:uri) RETURNING id");
            $pageQuery->execute(['uri' => $page->uri]);
            $pageId = $pageQuery->fetchColumn();
            foreach ($langs as $lang) {
                $contentQuery = $this->database->prepare("INSERT INTO {$this->table_content} (id_page,language,h1) 
VALUES(:id_page,:language,:h1)");
                $contentQuery->execute(
                    [
                        'id_page' => $pageId,
                        'language' => $lang,
                        'h1' => $page->h1
                    ]
                );
            }
            return $pageId;
        } catch (\Exception $e) {
            var_dump($e);
            return null;
        }
    }
}