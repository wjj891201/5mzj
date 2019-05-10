<?php if (Yii::$app->session->hasFlash('success')): ?>
    <div class="Huialert Huialert-success"><i class="Hui-iconfont close_down">&#xe6a6;</i><?= Yii::$app->session->getFlash('success') ?></div>
<?php endif; ?>

<?php if (Yii::$app->session->hasFlash('error')): ?>
    <div class="Huialert Huialert-danger"><i class="Hui-iconfont close_down">&#xe6a6;</i><?= Yii::$app->session->getFlash('error') ?></div>
<?php endif; ?>