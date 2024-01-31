<nav>
    <a href="<?=$this->makeLink('/admin/page/list');?>">List pages</a>
</nav>
<h1>Edit page</h1>
<form action="" method="post">
    <div class="form-item">
        <label for="uri">URL</label>
        <input type="text" id="uri" name="uri" value="<?=$this->page->uri;?>">
    </div>
    <div class="form-item">
        <label for="h1">H1</label>
        <input type="text" id="h1" name="h1" value="<?=$this->page->h1;?>">
    </div>
    <div class="form-item">
        <label for="meta_title">Meta title</label>
        <input type="text" id="meta_title" name="meta_title" value="<?=$this->page->meta_title;?>">
    </div>
    <div class="form-item">
        <label for="meta_description">Meta description</label>
        <input type="text" id="meta_description" name="meta_description" value="<?=$this->page->meta_description;?>">
    </div>
    <div class="form-item">
        <label for="robots_index">Robots [Index]</label>
        <input type="hidden" name="robots_index" value="false">
        <input type="checkbox" id="robots_index" name="robots_index" <?=$this->page->robots_index?'checked':'';?> value="true">
    </div>
    <div class="form-item">
        <label for="robots_follow">Robots [Follow]</label>
        <input type="hidden" name="robots_follow" value="false">
        <input type="checkbox" id="robots_follow" name="robots_follow" <?=$this->page->robots_follow?'checked':'';?> value="true">
    </div>
    <br>
    <button type="submit" class="btn btn-success">Save</button>
</form>
<style>
    .form-item{
        width: 100%;
        padding:5px;
        display: flex;
        flex-direction: column;
        gap: 5px;
    }
    .btn{
        padding:7px 15px;
        border-radius: 5px;
        font-size: 16px;
        font-family: Arial, sans-serif;
        border:none;
    }
    .btn-success{
        background-color: #8bc34a;
        color: white;
    }
</style>