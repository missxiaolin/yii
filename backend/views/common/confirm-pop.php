<script type="text/html" id="confirmTpl">
    <div class="hint">删除提示</div>
    <div class="hint-content">
        <p class="text">确定要删除吗？</p>
    </div>
    <?php if ($type == 1) { ?>
        <div class="hint-btn">
            <a href="javascript:;" class="cancel" id="pop_close">确定</a>
        </div>
    <?php } else if ($type == 2) { ?>
        <div class="hint-btn-del">
            <a href="javascript:;" class="confirm" id="dialog_confirm">确定</a>
            <a href="javascript:;" class="cancel" id="dialog_cancel">取消</a>
        </div>
    <?php } ?>
</script>