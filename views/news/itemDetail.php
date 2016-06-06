<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/6/6
 * Time: 11:05
 */
echo $this->context->renderPartial('_copyright');
?>

<h2>News Item Detail</h2>
<br/>
Id:<b><?php echo $item['id'] ?></b>
<br/>
Title:<b><?php echo $item['title'] ?></b>
<br/>
Date:<b><?php echo $item['date'] ?></b>

