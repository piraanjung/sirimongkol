<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\HousesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'แปลงบ้าน';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="houses-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="well">
        <p>
            <?= Html::a('สร้างแปลงบ้าน', ['create'], ['class' => 'btn btn-success']) ?>
        </p>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                // 'id',
                'house_name',
                'house_model_id',
                'project_id',
                'house_status',
                //'create_date',
                //'update_date',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    </div>
</div>
