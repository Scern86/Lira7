<nav>
    <a href="<?=$this->makeLink('/admin/article/list');?>">List articles</a>
</nav>
<h1>Add article</h1>
<form action="" method="post">
    <div class="form-item">
        <label for="">Title</label>
        <input type="text" name="title">
    </div>
    <div class="form-item">
        <label for="">Content</label>
        <textarea name="content"></textarea>
    </div>
    <br>
    <button type="submit">Save</button>
</form>