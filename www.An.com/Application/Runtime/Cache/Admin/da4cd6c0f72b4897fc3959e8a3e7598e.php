<?php if (!defined('THINK_PATH')) exit();?>
<?php echo ($xy); ?>

<?php if(is_array($xy)): foreach($xy as $key=>$value): echo ($value); endforeach; endif; ?>

<?php if($page == 28): ?>18岁
<?php else: ?>
		还是18岁<?php endif; ?>

<?php $__FOR_START_20170__=0;$__FOR_END_20170__=28;for($i=$__FOR_START_20170__;$i >= $__FOR_END_20170__;$i+=1){ ?>{i} <br><?php } ?>

<?php if(($page) > "28"): ?>今年18岁
<?php else: ?>
		明年还是18<?php endif; ?>

<?php $page = 'add'; ?>

<?php echo ($page); ?>


<?php echo '咸鱼'; ?>

<?php echo ((isset($list ) && ($list !== ""))?($list ):'北冥有鱼名为咸'); ?>


<?php echo var_dump($mod);?>

<?php echo (var_dump($mod)); ?>

<?php echo (date('Y/m/d',$time)); ?>

<?php echo var_dump(date('Y-m-d'),$time);?>