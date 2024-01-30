<nav>
    <a href="<?=$this->makeLink('/admin/page/list');?>">List pages</a>
</nav>
<h1>Edit page</h1>
<form action="" method="post">
    <div class="form-item">
        <label for="created">Created</label>
        <input type="text" id="created" name="created" value="<?=$this->page['created'];?>">
    </div>
    <div class="form-item">
        <label for="uri">URL</label>
        <input type="text" id="uri" name="uri" value="<?=$this->page['uri'];?>">
    </div>
    <div class="form-item">
        <label for="h1">H1</label>
        <input type="text" id="h1" name="h1" value="<?=$this->page['h1'];?>">
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