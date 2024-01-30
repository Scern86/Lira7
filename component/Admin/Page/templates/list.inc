<nav>
    <a href="<?=$this->makeLink('/admin/page/add');?>">Add page</a>
</nav>
<h1>List pages</h1>
<table width="100%" border="1" cellpadding="1px" cellspacing="1px">
    <thead>
        <tr>
            <th width="40">ID</th>
            <th width="100">Created</th>
            <th width="100">URL</th>
            <th>H1</th>
            <th width="40"></th>
        </tr>
    </thead>
    <tbody>
        <?php if(!empty($this->listPages)) foreach ($this->listPages as $page){?>
           <tr>
               <td><?=$page['id'];?></td>
               <td><?=date('d-m-Y',strtotime($page['created']));?></td>
               <td><?=$page['uri'];?></td>
               <td><?=$page['h1'];?></td>
               <td><a href="<?=$this->makeLink('/admin/page/edit/'.$page['id']);?>">Edit</a></td>
           </tr>
        <?php } ?>
    </tbody>
</table>