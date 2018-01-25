<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\WorksSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'งาน';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="works-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="box box-success">
      <div class="box-header">
        <p>
            <?= Html::a('สร้างรายการงาน', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
        </div>
        <div class="box-body">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                // 'id',
                'work_name',
                'wg_id',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
        </div>
    </div>
</div>
