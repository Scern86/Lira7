<nav>
    <a href="<?=$this->makeLink('/admin/category/list');?>">List categories</a>
</nav>
<h1>Edit category</h1>
<form action="" method="post">
    <div class="form-item">
        <label for="created">Created</label>
        <input type="text" id="created" name="created" value="<?=$this->category['created'];?>">
    </div>
    <div class="form-item">
        <label for="title">Title</label>
        <input type="text" id="title" name="title" value="<?=$this->category['title'];?>">
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