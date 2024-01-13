<nav>
    <a href="<?=$this->makeLink('/admin/article/list');?>">List articles</a>
</nav>
<h1>Edit article</h1>
<form action="" method="post">
    <div class="form-item">
        <label for="">Title</label>
        <input type="text" name="title" value="<?=crc32(time());?>">
    </div>
    <div class="form-item">
        <label for="">Content</label>
        <textarea name="content"><?=str_shuffle(crc32(time()));?></textarea>
    </div>
    <br>
    <button type="submit">Save</button>
</form>