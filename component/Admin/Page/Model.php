<?php

namespace Scern\Lira\Component\Admin\Page;

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
        try{
            $query = $this->database->prepare("SELECT * FROM {$this->table} AS p,{$this->table_content} AS pc WHERE p.id=pc.id_page AND pc.language = :language ORDER BY p.id DESC");
            $query->execute(['language'=>$lang->code]);
            return $query->fetchAll(\PDO::FETCH_ASSOC);
        }catch (\Exception $e){
            //var_dump($e);
            return [];
        }
    }

    public function getPageById(int $pageId,Lang $lang): array|bool
    {
        try{
            $query = $this->database->prepare("SELECT * FROM {$this->table} AS p,{$this->table_content} AS pc WHERE p.id=pc.id_page AND p.id = :id AND pc.language = :language");
            $query->execute(['id'=>$pageId,'language'=>$lang->code]);
            return $query->fetch(\PDO::FETCH_ASSOC);
        }catch (\Exception $e){
            //var_dump($e);
            return false;
        }
    }

    public function updatePage(int $pageId,string $created,string $uri,Lang $lang,string $h1): void
    {
        try{
            $pageQuery = $this->database->prepare("UPDATE {$this->table} SET created = :created, uri = :uri WHERE id = :id");
            $pageQuery->execute(['id'=>$pageId,'created'=>$created,'uri'=>$uri]);
            $contentQuery = $this->database->prepare("UPDATE {$this->table_content} SET h1 = :h1 WHERE id_page = :id_page AND language = :language");
            $contentQuery->execute(['id_page'=>$pageId,'language'=>$lang->code,'h1'=>$h1]);
        }catch (\Exception $e){
            //var_dump($e);

        }
    }

    public function createPage(string $uri,string $h1, array $langs): ?array
    {
        try{
            $pageQuery = $this->database->prepare("INSERT INTO {$this->table} (created,uri) VALUES(:created,:uri) RETURNING *");
            $pageQuery->execute(['created'=>date('Y-m-d'),'uri'=>$uri]);
            $page = $pageQuery->fetch(\PDO::FETCH_ASSOC);
            foreach($langs as $lang){
                $contentQuery = $this->database->prepare("INSERT INTO {$this->table_content} (id_page,language,h1) VALUES(:id_page,:language,:h1)");
                $contentQuery->execute(['id_page'=>$page['id'],'language'=>$lang,'h1'=>$h1]);
            }
            return $page;
        }catch (\Exception $e){
            //var_dump($e);
            return null;
        }
    }
}