<nav>
    <a href="<?=$this->makeLink('/admin/article/add');?>">Add article</a>
</nav>
<h1>List articles</h1>
<table width="100%" border="1" cellpadding="1px" cellspacing="1px">
    <thead>
        <tr>
            <th width="40">ID</th>
            <th width="100">Created</th>
            <th>Title</th>
            <th width="40"></th>
        </tr>
    </thead>
    <tbody>
        <?php if(!empty($this->listArticles)) foreach ($this->listArticles as $article){?>
           <tr>
               <td><?=$article['id'];?></td>
               <td><?=date('d-m-Y',strtotime($article['created']));?></td>
               <td><?=$article['title'];?></td>
               <td><a href="<?=$this->makeLink('/admin/article/edit/'.$article['id']);?>">Edit</a></td>
           </tr>
        <?php } ?>
    </tbody>
</table>