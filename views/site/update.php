<?php
/* @var $this yii\web\View */
// use yii\helpers\Html;

use Codeception\Event\PrintResultEvent;
use yii\bootstrap\Html;
use yii\widgets\ActiveForm;

$this->title = 'My Yii First Application';
?>
<div class="site-index">

    <h1>Create Posts</h1>

    <div class="body-content">
        <?php $form = ActiveForm::begin()?>
        <div class="row">
            <div class="form-group">
                <div class="col-lg-6">
                    <?= $form->field($post, 'title') ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                <div class="col-lg-6">
                    <?= $form->field($post, 'description')->textarea(['rows' => '6']) ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                <div class="col-lg-6">
                    <?php $items = ['Framework' => 'Framework', 'Language' => 'Language', 'Library' => 'Library', 'ORM' => 'ORM']; ?>
                    <?= $form->field($post, 'category')->dropDownList($items, ['prompt' => 'Select']); ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                <div class="col-lg-6">
                    <div class="col-lg-3">
                        <?= Html::submitButton('Update Post', ['class' => 'btn btn-primary']) ?>
                    </div>
                    <div class="colg-lg-2">
                        <a href="<?php echo yii::$app->homeUrl; ?>" class="btn btn-primary">Go Back</a>
                    </div>
                </div>
            </div>
        </div>


        <?php ActiveForm::end(); ?>
    </div>
</div>