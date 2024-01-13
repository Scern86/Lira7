<nav>
    <a href="<?=$this->makeLink('/admin/article/add');?>">Add article</a>
</nav>
<h1>List articles</h1>
<table width="100%" border="1" cellpadding="1px" cellspacing="1px">
    <thead>
        <tr>
            <th>ID</th>
            <th>Created</th>
            <th>Title</th>
            <th>Author</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach (range(1,20) as $item){ ?>
            <tr>
                <td><?=$item;?></td>
                <td><?=date('d-m-Y');?></td>
                <td><?=crc32(time());?></td>
                <td><?=str_shuffle(crc32(time()));?></td>
                <th><a href="<?=$this->makeLink('/admin/article/edit/'.$item);?>">Edit</a></th>
            </tr>
        <?php } ?>
    </tbody>
</table>