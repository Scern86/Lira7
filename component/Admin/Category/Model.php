<?php

namespace Scern\Lira\Component\Admin\Category;

use Scern\Lira\Lexicon\Lang;

class Model extends \Scern\Lira\Model
{
    protected string $table = 'web_categories';
    protected string $table_content = 'web_categories_content';

    public function __construct(protected $database)
    {
    }

    public function getCategoriesList(Lang $lang): array
    {
        try{
            $query = $this->database->prepare("SELECT * FROM {$this->table} AS c,{$this->table_content} AS cc WHERE c.id=cc.id_category AND cc.language = :language ORDER BY c.id DESC");
            $query->execute(['language'=>$lang->code]);
            return $query->fetchAll(\PDO::FETCH_ASSOC);
        }catch (\Exception $e){
            //var_dump($e);
            return [];
        }
    }

    public function getCategoryById(int $categoryId,Lang $lang): array|bool
    {
        try{
            $query = $this->database->prepare("SELECT * FROM {$this->table} AS c,{$this->table_content} AS cc WHERE c.id=cc.id_category AND c.id = :id AND cc.language = :language");
            $query->execute(['id'=>$categoryId,'language'=>$lang->code]);
            return $query->fetch(\PDO::FETCH_ASSOC);
        }catch (\Exception $e){
            //var_dump($e);
            return false;
        }
    }

    public function updateCategory(int $categoryId,string $created,Lang $lang,string $title): void
    {
        try{
            $categoryQuery = $this->database->prepare("UPDATE {$this->table} SET created = :created WHERE id = :id");
            $categoryQuery->execute(['id'=>$categoryId,'created'=>$created]);
            $contentQuery = $this->database->prepare("UPDATE {$this->table_content} SET title = :title WHERE id_category = :id_category AND language = :language");
            $contentQuery->execute(['id_category'=>$categoryId,'language'=>$lang->code,'title'=>$title]);
        }catch (\Exception $e){
            //var_dump($e);

        }
    }

    public function createCategory(string $title, array $langs): ?array
    {
        try{
            $categoryQuery = $this->database->prepare("INSERT INTO {$this->table} (created) VALUES(:created) RETURNING *");
            $categoryQuery->execute(['created'=>date('Y-m-d')]);
            $category = $categoryQuery->fetch(\PDO::FETCH_ASSOC);
            foreach($langs as $lang){
                $contentQuery = $this->database->prepare("INSERT INTO {$this->table_content} (id_category,language,title) VALUES(:id_category,:language,:title)");
                $contentQuery->execute(['id_category'=>$category['id'],'language'=>$lang,'title'=>$title]);
            }
            return $category;
        }catch (\Exception $e){
            //var_dump($e);
            return null;
        }
    }
}