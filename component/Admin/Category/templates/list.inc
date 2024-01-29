<nav>
    <a href="<?=$this->makeLink('/admin/category/add');?>">Add category</a>
</nav>
<h1>List categories</h1>
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
        <?php if(!empty($this->listCategories)) foreach ($this->listCategories as $category){?>
           <tr>
               <td><?=$category['id'];?></td>
               <td><?=date('d-m-Y',strtotime($category['created']));?></td>
               <td><?=$category['title'];?></td>
               <td><a href="<?=$this->makeLink('/admin/category/edit/'.$category['id']);?>">Edit</a></td>
           </tr>
        <?php } ?>
    </tbody>
</table>