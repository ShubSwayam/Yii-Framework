<?php
/* @var $this yii\web\View */
// use yii\helpers\Html;

use Codeception\Event\PrintResultEvent;
use yii\bootstrap\Html;
use yii\widgets\ActiveForm;

$this->title = 'My Yii First Application';
?>
<div class="site-index">

    <h1>View Posts</h1>

    <div class="body-content">
        <ul class="list-group">
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <?php echo $post->prid; ?>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <?php echo $post->title; ?>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <?php echo $post->description ?>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <?php echo $post->category ?>
            </li>
        </ul>
        <div class="row">
            <a href="<?php echo yii::$app->homeUrl; ?>" class="btn btn-primary">Go Back</a>
        </div>
    </div>
</div>