<?php
/* @var $this yii\web\View */

use yii\bootstrap\Html;

$this->title = 'My Yii First Application';
?>
<div class="site-index">
    <?php if (yii::$app->session->hasFlash('message')); ?>
    <div class="alert alert-dismissible alert-success">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?php echo yii::$app->session->getFlash('message'); ?>
    </div>
    <div class="jumbotron">
        <h1 style="color:#337ab7">My Yii First Application !</h1>
    </div>

    <div class="row">
        <span style="margin-bottom: 20px;">
            <?= Html::a('Create', ['site/create'], ['class' => 'btn btn-primary']) ?>
        </span>
    </div>

    <div class="body-content">

        <div class="row">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">PRID</th>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                        <th scope="col">Category</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($posts) > 0) : ?>
                        <?php foreach ($posts as $post) : ?>
                            <tr class="table-active">
                                <th scope="row">PRID <?php echo $post->prid; ?> </th>
                                <td><?php echo $post->title; ?></td>
                                <td><?php echo $post->description; ?></td>
                                <td><?php echo $post->category; ?></td>
                                <td>
                                    <span> <?= Html::a('View', ['view', 'prid' => $post->prid], ['class' => 'label label-primary']); ?> </span>
                                    <span> <?= Html::a('Update', ['update', 'prid' => $post->prid], ['class' => 'label label-success']); ?> </span>
                                    <span> <?= Html::a('Delete', ['delete', 'prid' => $post->prid], ['class' => 'label label-danger']); ?> </span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <script>
                                alert("No Records found");
                            </script>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </div>
</div>