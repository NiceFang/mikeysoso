<?php if (!defined('THINK_PATH')) exit();?><!-- imToken -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<?php if(is_array($arr)): $i = 0; $__LIST__ = $arr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><div class="bank imToken_bank">
    <div class="bank_box imToken_bank_box">
        <div class=" top imToken_top namex">
            <div class="top_left imToken_top_left fl">
                <p class="bank_txt imToken_bank_txt"><?php echo (L("xm")); ?>：<?php echo ($val["imtoken_name"]); ?></p>
                <p class="bank_name imToken_bank_name">imToken<?php echo (L("dz")); ?>：<?php echo ($val["imtoken_num"]); ?></p>

                <p class="bank_num imToken_bank_num"><?php echo (L("sjhm")); ?>：<?php echo ($val["imtoken_phone"]); ?></p>
            </div>
            <div class="top_right fr">
                <img src="<?php echo ($val["imtoken_imgs"]); ?>" alt="">
            </div>

        </div>
        <div class="bottom imToken_bottom">
            <div class="left fl">
                <?php if(($val["imtoken_default"] == 1)): ?><div class="select_bg fl select_bg_box select_red update" data-val="<?php echo ($val["id"]); ?>"></div>
                    <?php else: ?>
                    <div class="select_bg fl select_bg_box update" data-val="<?php echo ($val["id"]); ?>"></div><?php endif; ?>
                <p class="fl"><?php echo (L("mr")); ?></p>
            </div>
            <div class="right fr" name="imtoken_dele" data-val="<?php echo ($val["id"]); ?>">
                <div class="delete_bg fl"></div>
                <p class="fl"  ><?php echo (L("deleteo")); ?></p>
            </div>
        </div>
    </div>
    <div class="big_er_code" data-a="" style="display: none;">
        <div class="big_pic">
            <img src="<?php echo ($val["imtoken_imgs"]); ?>" alt="">
        </div>
    </div>
</div><?php endforeach; endif; else: echo "" ;endif; ?>
<div class="bottomOP_box"></div>

<!--
select_red-->