<nav>
    <a href="<?=$this->makeLink('/admin/article/list');?>">List articles</a>
</nav>
<h1>Add article</h1>
<form action="" method="post">
    <div class="form-item">
        <label for="title">Title</label>
        <input type="text" id="title" name="title">
    </div>
    <div class="form-item">
        <label for="content">Content</label>
        <textarea id="content" name="content" rows="20"></textarea>
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
    .ck.ck-content{
        min-height: 200px;
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