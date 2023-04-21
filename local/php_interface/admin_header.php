<?php
if ($GLOBALS['APPLICATION']->GetCurPage() == '/bitrix/admin/iblock_element_edit.php') {
    ?>
    <script>
        BX.addCustomEvent('OnEditorInitedBefore', function () {
            BX.addCustomEvent(this, 'OnGetParseRules', BX.proxy(function () {
                this.rules.tags['custom-video-player'] = {};
                this.rules.tags.customvideoplayer = {};
            }, this));
        });
    </script>
    <?php
}
?>
