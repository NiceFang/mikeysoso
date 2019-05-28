<?php if (!defined('THINK_PATH')) exit();?><!-- 微信 -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<?php if(is_array($arr)): $i = 0; $__LIST__ = $arr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><div class="bank alipay">
    <div class="bank_box alipay_box">
        <div class="top alipay_box_top namex">
            <div class="top_left fl">
                <p class="bank_txt"><?php echo (L("wxh")); ?>:<?php echo ($val["weichar_num"]); ?></p>
                <p class="bank_name"><?php echo (L("sjhm")); ?>:<?php echo ($val["weichar_phone"]); ?></p>
            </div>
            <div class="top_right fr">
                <img src="<?php echo ($val["weichar_imgs"]); ?>" alt="">
            </div>
        </div>
        <div class="bottom">
            <div class="left fl">
                <?php if(($val["weichar_default"] == 1)): ?><div class="select_bg fl select_bg_box select_red update" data-val="<?php echo ($val["id"]); ?>"></div>
                    <?php else: ?>
                        <div class="select_bg fl select_bg_box update" data-val="<?php echo ($val["id"]); ?>"></div><?php endif; ?>
                <p class="fl"><?php echo (L("mr")); ?></p>
            </div>
            <div class="right fr" name="weichar_dele" data-val="<?php echo ($val["id"]); ?>">
                <div class="delete_bg fl"></div>
                <p class="fl"><?php echo (L("deleteo")); ?></p>
            </div>
        </div>
    </div>
    <div class="big_er_code" style="display: none;">
        <div class="big_pic">
            <img src="<?php echo ($val["weichar_imgs"]); ?>" alt="">
        </div>
    </div>
</div><?php endforeach; endif; else: echo "" ;endif; ?>
<div class="bottomOP_box"></div>