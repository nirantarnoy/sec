<?php

use yii\helpers\Url;
use miloschuman\highcharts\Highcharts;



$kpi_title = \common\models\KpiPerformanceTitle::find()->orderBy(['id' => SORT_ASC])->all();
$team_member = \common\models\TeamLine::find()->where(['team_id' => 1])->orderBy(['emp_id' => SORT_ASC])->all();

$data_chart_sale_amount = [];
$data_chart_profit_per_amount = [];
$data_chart_job_count_per_amount = [];
$data_chart_job_count_per_cat = [];

$data_chart_job_personal_performance_per = [];
$month_data = [
    ['id' => 1, 'name' => 'Jan'],
    ['id' => 2, 'name' => 'Feb'],
    ['id' => 3, 'name' => 'Mar'],
    ['id' => 4, 'name' => 'Apr'],
    ['id' => 5, 'name' => 'May'],
    ['id' => 6, 'name' => 'Jun'],
    ['id' => 7, 'name' => 'Jul'],
    ['id' => 8, 'name' => 'Aug'],
    ['id' => 9, 'name' => 'Sep'],
    ['id' => 10, 'name' => 'Oct'],
    ['id' => 11, 'name' => 'Nov'],
    ['id' => 12, 'name' => 'Dec']
];
$year_data = [];
for($a=0;$a<=3;$a++){
    array_push($year_data,['id'=>date('Y')-$a,'name'=>date('Y')-$a]);
}


$find_month_name = '';
for($v=0;$v<=count($month_data)-1;$v++){
    if($month_data[$v]['id']==$selected_month)$find_month_name=$month_data[$v]['name'];
}

$this->title = 'Performance Chart '.$find_month_name.' '.$selected_year;
?>
<form action="<?=Url::to(['performancechart/index'],true)?>" method="post">
    <div class="row">
        <div class="col-lg-3">
            <select name="selected_month" class="form-control" id="">
                <option value="-1">--เลือกเดือน--</option>
                <?php for($i=0;$i<=count($month_data)-1;$i++):?>
                <?php
                   $selected = '';
                   if($month_data[$i]['id'] == $selected_month){
                       $selected = 'selected';
                   }
                ?>
                    <option value="<?=$month_data[$i]['id']?>" <?=$selected?>><?=$month_data[$i]['name']?></option>
                <?php endfor;?>
            </select>
        </div>
        <div class="col-lg-3">
            <select name="selected_year" class="form-control" id="">
                <option value="-1">--เลือกปี--</option>
                <?php for($i=0;$i<=count($year_data)-1;$i++):?>
                    <?php
                    $selected = '';
                    if($year_data[$i]['id'] == $selected_year){
                        $selected = 'selected';
                    }
                    ?>
                    <option value="<?=$year_data[$i]['id']?>" <?=$selected?>><?=$year_data[$i]['name']?></option>
                <?php endfor;?>
            </select>
        </div>
        <div class="col-lg-3">
            <button class="btn btn-info">ดึงข้อมูล</button>
        </div>
        <div class="col-lg-3"></div>
    </div>
</form>
<br />
<form action="<?= Url::to(['performancechart/updatekpi'], true) ?>" method="post">
    <div class="row">
        <div class="col-lg-3">
            <button class="btn btn-primary">อัพเดทตาราง</button>
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="col-lg-12">
            <table class="table table-bordered" id="table-list">
                <thead>
                <tr>
                    <th style="background-color: #36ab63;color: white;width: 15%">ชื่อเซลล์</th>
                    <th style="background-color: #36ab63;color: white">ยอดขายประจำเดือน</th>
                    <th style="background-color: #36ab63;color: white;text-align: center;width: 8%;">% ยอดขาย</th>
                    <th style="background-color: #36ab63;color: white;text-align: center;width:10%">กำไรประจำเดือน</th>
                    <th style="background-color: #36ab63;color: white">% กำไร</th>
                    <th style="background-color: #36ab63;color: white">ปริมาณงาน</th>
                    <th style="background-color: #36ab63;color: white">% ปริมาณงาน</th>
                    <th style="background-color: #36ab63;color: white">% Time Attendance</th>
                    <th style="background-color: #36ab63;color: white">% Personal Performance</th>
                    <th style="background-color: #36ab63;color: white">% High Performance</th>
                    <th style="background-color: #36ab63;color: white">% Low Performance</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $total_sale_amount = 0;
                $total_sele_per = 0;
                $total_profit_amount = 0;
                $total_profit_per = 0;
                $total_job_count = 0;
                $total_job_count_per = 0;
                $total_personal_perform_per = 0;
                $list_chart_data = [];
                $list_chart_personal_data = [];
                ?>
                <?php foreach ($team_member as $value): ?>
                    <?php
                    $line_job_value_amount = 0;
                    $line_sale_per_amount = 0;
                    $line_profit_amount = 0;
                    $line_profit_per = 0;
                    $line_job_count = 0;
                    $line_job_count_by_emp = 0;
                    $line_job_count_per = 0;

                    $line_atten_per = 0;
                    $line_personal_perform_per = 0;
                    $line_high_perform_per = 0;
                    $line_low_perform_per = 0;

                    $sale_data = getSalemonth(1, $value->emp_id, $selected_month, $selected_year);
                    $perform_data = getPerform(1, $value->emp_id, $selected_month, $selected_year);
                    if ($sale_data != null) {
                        $line_job_value_amount = $sale_data[0]['job_value_amount'];
                        $total_sale_amount = $sale_data[0]['total_sale_amount'];

                        $line_sale_per_amount = ($line_job_value_amount / $total_sale_amount) * 100;
                        $total_sele_per = ($total_sele_per + $line_sale_per_amount);

                        $line_profit_amount = $sale_data[0]['profit_amount'];
                        //$line_profit_per = $sale_data[0]['profit_per'];
                        $line_profit_per = ($line_profit_amount / $sale_data[0]['total_profit_amount']) * 100;

                        $total_profit_amount = ($total_profit_amount + $line_profit_amount);
                        $total_profit_per = ($total_profit_per + $line_profit_per);

                        $line_job_count_by_emp = $sale_data[0]['total_job_count_by_emp'];
                        $total_job_count = $sale_data[0]['total_job_count'];

                        $line_job_count_per = ($line_job_count_by_emp / $total_job_count) * 100;
                        $total_job_count_per = ($total_job_count_per + $line_job_count_per);

                    }

                    if ($perform_data != null) {
                        $line_atten_per = $perform_data[0]['job_attendance'];
                        $line_personal_perform_per = $perform_data[0]['job_performance'];
                        $line_high_perform_per = $perform_data[0]['high_perform_per'];
                        $line_low_perform_per = $perform_data[0]['low_perform_per'];

                        $total_personal_perform_per = ($total_personal_perform_per + $line_personal_perform_per);
                    }

                    //  array_push($data_chart_sale_amount,['name'=>\backend\models\Employee::findFullName($value->emp_id),'y'=>round($line_sale_per_amount,2), 'color' => "#" . dechex(rand(0x000000, 0xFFFFFF))]);
                    array_push($data_chart_sale_amount, ['name' => \backend\models\Employee::findFullName($value->emp_id), 'y' => round($line_sale_per_amount, 2)]);
                    array_push($data_chart_profit_per_amount, ['name' => \backend\models\Employee::findFullName($value->emp_id), 'y' => round($line_profit_per, 2)]);

                   // if($value->emp_id !=1){
                        array_push($data_chart_job_count_per_cat, [\backend\models\Employee::findFullName($value->emp_id)]);
                   // }

                    array_push($list_chart_data, ['emp_id' => $value->emp_id, 'data' => $line_job_count_per]);
                    array_push($list_chart_personal_data,['emp_id'=>$value->emp_id,'data'=>$line_personal_perform_per]);
                    ?>
                    <tr>
                        <td style="padding; 0">
                            <input type="hidden" name="line_emp_id[]" value="<?= $value->emp_id ?>">
                            <?= \backend\models\Employee::findFullName($value->emp_id) ?></td>
                        <td style="padding: 0"><input type="text" class="form-control"
                                                      style="height: 46px;border: none;text-align: right;"
                                                      name="line_sale_value_amount[]"
                                                      value="<?= number_format($line_job_value_amount, 1) ?>" readonly>
                        </td>
                        <td style="padding: 0;"><input type="text" class="form-control line-sale-total-per"
                                                       style="height: 46px;border: none;text-align: center;"
                                                       name="line_sale_per_amount[]"
                                                       value="<?= number_format($line_sale_per_amount, 1) ?>" readonly>
                        </td>
                        <td style="padding: 0;"><input type="text" class="form-control"
                                                       style="height: 46px;border: none;text-align: right;"
                                                       name="line_profit_amount[]"
                                                       value="<?= number_format($line_profit_amount, 1) ?>" readonly>
                        </td>
                        <td style="padding: 0;"><input type="text" class="form-control line-profit-per"
                                                       style="height: 46px;border: none;text-align: center;"
                                                       name="line_profit_per[]"
                                                       value="<?= number_format($line_profit_per, 1) ?>" readonly></td>
                        <td style="padding: 0;"><input type="text" class="form-control"
                                                       style="height: 46px;border: none;text-align: right;"
                                                       name="line_job_count[]"
                                                       value="<?= number_format($line_job_count_by_emp, 0) ?>" readonly>
                        </td>
                        <td style="padding: 0;"><input type="text" class="form-control line-job-count-per"
                                                       style="height: 46px;border: none;text-align: center;"
                                                       name="line_job_count_per[]"
                                                       value="<?= number_format($line_job_count_per, 1) ?>" readonly>
                        </td>
                        <td style="padding: 0;">
                            <input type="text"
                                   class="form-control line-attendance-per"
                                   style="border: none;text-align: center;height: 46px;"
                                   name="line_attendance[]"
                                   value="<?= number_format($line_atten_per, 1) ?>"
                                   onchange="calPersonalPerformance()">
                        </td>
                        <td style="padding: 0;">
                            <input type="text"
                                   class="form-control line-kpi-personal-perform"
                                   style="border: none;text-align: center;height: 46px;"
                                   name="line_personal_perform[]"
                                   value="<?= number_format($line_personal_perform_per, 1) ?>" readonly>
                        </td>
                        <td style="padding: 0;"><input type="text" class="form-control line-job-high-per"
                                                       style="height: 46px;border: none;text-align: center;"
                                                       name="line_job_high_per[]"
                                                       value="<?= number_format($line_high_perform_per, 1) ?>" readonly>
                        </td>
                        <td style="padding: 0;"><input type="text" class="form-control line-job-low-per"
                                                       style="height: 46px;border: none;text-align: center;"
                                                       name="line_job_low_per[]"
                                                       value="<?= number_format($line_low_perform_per, 1) ?>" readonly>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
                <tfoot>
                <tr>
                    <td style="text-align: center;background-color: lightblue;"><b>Grand Total</b></td>
                    <td style="text-align: right;background-color: lightblue;">
                        <b><?= number_format($total_sale_amount, 1) ?></b></td>
                    <td style="text-align: center;background-color: lightblue;">
                        <b><?= number_format($total_sele_per, 1) ?></b></td>
                    <td style="text-align: right;background-color: lightblue;">
                        <b><?= number_format($total_profit_amount, 1) ?></b></td>
                    <td style="text-align: center;background-color: lightblue;">
                        <b><?= number_format($total_profit_per, 1) ?></b></td>
                    <td style="text-align: right;background-color: lightblue;">
                        <b><?= number_format($total_job_count, 0) ?></b></td>
                    <td style="text-align: center;background-color: lightblue;">
                        <b><?= number_format($total_job_count_per, 1) ?></b></td>
                    <td style="text-align: center;background-color: lightblue;"></td>
                    <td style="text-align: center;background-color: lightblue;"><b><span
                                    class="total-personal-performance"><?= number_format($total_personal_perform_per, 1) ?></span></b>
                    </td>
                    <td style="text-align: center;background-color: lightblue;"></td>
                    <td style="text-align: center;background-color: lightblue;"></td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="col-lg-12">
            <h5><b>KPI</b></h5>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">

            <input type="hidden" name="team_id" value="1">
            <input type="hidden" name="perform_year" value="<?=$selected_year?>">
            <input type="hidden" name="perform_month" value="<?=$selected_month?>">

            <table class="table table-bordered" id="table-kpi-list">
                <thead>
                <tr>
                    <th style="background-color: #36ab63;color: white;text-align: center;">KPI</th>
                    <th style="background-color: #36ab63;color: white;text-align: center;">% Rating</th>
                    <th style="background-color: #36ab63;color: white;text-align: center;">% Personal Goal</th>
                    <th style="background-color: #36ab63;color: white;text-align: center;">% High Performance</th>
                    <th style="background-color: #36ab63;color: white;text-align: center;">% Minimum</th>
                    <th style="background-color: #36ab63;color: white;text-align: center;">% Low Performance</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $total_rating = 0;
                $total_high_perform = 0;
                $total_low_perform = 0;
                ?>
                <?php foreach ($kpi_title as $value): ?>
                    <?php
                    $line_kpi_rating = 0;
                    $line_kpi_personal_goal = 0;
                    $line_kpi_high_performance_per = 0;
                    $line_kpi_minimum = 0;
                    $line_kpi_low = 0;

                    $line_kpi_data = getKpiperform(1, $selected_month, $selected_year, $value->id);
                    if ($line_kpi_data != null) {
                        $line_kpi_rating = $line_kpi_data[0]['rating'];
                        $line_kpi_personal_goal = $line_kpi_data[0]['personal_goal'];
                        $line_kpi_high_performance_per = $line_kpi_data[0]['high_performance'];
                        $line_kpi_minimum = $line_kpi_data[0]['minimum'];
                        $line_kpi_low = $line_kpi_data[0]['low_performance'];

                        $total_rating += $line_kpi_rating;
                        $total_high_perform += $line_kpi_high_performance_per;
                        $total_low_perform += $line_kpi_low;
                    }
                    ?>
                    <tr>
                        <td style="text-align: center;">
                            <input type="hidden" name="line_kpi_title_id[]" value="<?= $value->id; ?>">
                            <?= $value->name ?></td>
                        <td style="text-align: center;padding: 0"><input type="text"
                                                                         class="form-control line-kpi-rating"
                                                                         style="border: none;text-align: center;height: 100%;"
                                                                         name="line_kpi_rating[]"
                                                                         value="<?= number_format($line_kpi_rating, 1) ?>"
                                                                         onchange="calkpi($(this))"></td>
                        <td style="text-align: center;padding: 0"><input type="text"
                                                                         class="form-control line-kpi-personal-goal"
                                                                         style="border: none;text-align: center;"
                                                                         name="line_kpi_personal_goal[]"
                                                                         value="<?= number_format($line_kpi_personal_goal, 1) ?>"
                                                                         onchange="calkpi($(this))"></td>
                        <td style="text-align: center;padding: 0"><input type="text"
                                                                         class="form-control line-kpi-high-performance"
                                                                         style="border: none;text-align: center;height: 46px;"
                                                                         name="line_kpi_high_performance[]"
                                                                         value="<?= number_format($line_kpi_high_performance_per, 1) ?>"
                                                                         readonly></td>
                        <td style="text-align: center;padding: 0"><input type="text"
                                                                         class="form-control line-kpi-minimum"
                                                                         style="border: none;text-align: center;"
                                                                         name="line_kpi_minimum[]"
                                                                         value="<?= number_format($line_kpi_minimum, 1) ?>"
                                                                         onchange="calkpi($(this))"></td>
                        <td style="text-align: center;padding: 0"><input type="text"
                                                                         class="form-control line-kpi-low-performance"
                                                                         style="border: none;text-align: center;height: 46px;"
                                                                         name="line_kpi_low_performance[]"
                                                                         value="<?= number_format($line_kpi_low, 1) ?>"
                                                                         readonly></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
                <tfoot>
                <tr>
                    <td style="text-align: center;background-color: lightblue;"><b>Total</b></td>
                    <td style="background-color: lightblue;">
                        <input type="text" class="form-control line-kpi-rating-total"
                               style="border: none;text-align: center;background-color: lightblue;font-weight: bold;"
                               name="line_kpi_rating_total" value="<?= number_format($total_rating, 1) ?>" readonly>
                    </td>
                    <td style="background-color: lightblue;"></td>
                    <td style="background-color: lightblue;">
                        <input type="text" class="form-control line-kpi-high-total"
                               style="border: none;text-align: center;background-color: lightblue;font-weight: bold;"
                               name="line_kpi_high_total" value="<?= number_format($total_high_perform, 1) ?>" readonly>
                    </td>
                    <td style="background-color: lightblue;"></td>
                    <td style="background-color: lightblue;">
                        <input type="text" class="form-control line-kpi-low-total"
                               style="border: none;text-align: center;background-color: lightblue;font-weight: bold;"
                               name="line_kpi_low_total" value="<?= number_format($total_low_perform, 1) ?>" readonly>
                    </td>
                </tr>
                </tfoot>
            </table>


        </div>

    </div>


    <?php
    $bar_value = [];
    $bar_performance_value = [];
    if ($list_chart_data != null) {
        for ($x = 0; $x <= count($list_chart_data) - 1; $x++) {
            foreach ($team_member as $valuex) {

                if ($valuex->emp_id == $list_chart_data[$x]['emp_id']) {
                    array_push($bar_value, (float)$list_chart_data[$x]['data']);
                }
            }
        }

    }

    if($list_chart_personal_data !=null){
        for ($x = 0; $x <= count($list_chart_personal_data) - 1; $x++) {
            foreach ($team_member as $valuex) {
              //  if($valuex->emp_id == 1)continue;
                if ($valuex->emp_id == $list_chart_personal_data[$x]['emp_id']) {
                    array_push($bar_performance_value, (float)$list_chart_personal_data[$x]['data']);
                }
            }
        }
    }

    array_push($data_chart_job_count_per_amount, ['name' => '%ปริมาณงาน', 'data' => $bar_value]);
    array_push($data_chart_job_personal_performance_per,['name'=>'%performance','data'=>$bar_performance_value]);
    ?>
    <div class="row">
        <div class="col-lg-6">

            <?= Highcharts::widget([
                'options' => [
                    'chart' => [
                        'type' => 'pie',
                    ],
                    'title' => ['text' => '% ยอดขาย'],
                    'series' => [[
                        'name' => 'value',
                        'data' => $data_chart_sale_amount,
                        'showInLegend' => true,
                    ]],
                    'plotOptions' => [
                        'pie' => [
                            'allowPointSelect' => true,
                            'cursor' => 'pointer',
                            'dataLabels' => [
                                'enabled' => true,
                                'format' => '{point.name}: {point.y} %'
                            ]
                        ]
                    ],
                    'tooltip' => [
                        'pointFormat' => '{series.name}: <b>{point.percentage:.2f}%</b>'
                    ]
                ]
            ]); ?>

        </div>
        <div class="col-lg-6">

            <?= Highcharts::widget([
                'options' => [
                    'chart' => [
                        'type' => 'pie',
                    ],
                    'title' => ['text' => '% กำไร'],
                    'series' => [[
                        'name' => 'value',
                        'data' => $data_chart_profit_per_amount,
                        'showInLegend' => true,
                    ]],
                    'plotOptions' => [
                        'pie' => [
                            'allowPointSelect' => true,
                            'cursor' => 'pointer',
                            'dataLabels' => [
                                'enabled' => true,
                                'format' => '{point.name}: {point.y} %'
                            ]
                        ]
                    ],
                    'tooltip' => [
                        'pointFormat' => '{series.name}: <b>{point.percentage:.2f}%</b>'
                    ]
                ]
            ]); ?>

        </div>

    </div>
    <br/>
    <div class="row">
        <div class="col-lg-6">

            <?= Highcharts::widget([
                'options' => [
                    'chart' => [
                        'type' => 'bar',
                    ],
                    'title' => ['text' => '% ปริมาณงาน '],
                    'xAxis' => [
                        'categories' => $data_chart_job_count_per_cat, // Periods
                        'title' => ['text' => '']
                    ],
                    'yAxis' => [
                        'title' => ['text' => '%']
                    ],
                    'tooltip' => [
                        'shared' => true,
                        'valueSuffix' => ' %'
                    ],
                    'plotOptions' => [
                        'bar' => [
                            'borderWidth' => 1
                        ]
                    ],
                    // 'series' => $data_chart_profit_per_amount,
                    'series' => $data_chart_job_count_per_amount,

                ]
            ]); ?>

        </div>
        <div class="col-lg-6">

            <?= Highcharts::widget([
                'options' => [
                    'chart' => [
                        'type' => 'column',
                    ],
                    'title' => ['text' => '% Personal Performance'],
                    'xAxis' => [
                        'categories' => $data_chart_job_count_per_cat, // Periods
                        'title' => ['text' => '']
                    ],
                    'yAxis' => [
                        'title' => ['text' => '%']
                    ],
                    'tooltip' => [
                        'shared' => true,
                        'valueSuffix' => ' %'
                    ],
                    'plotOptions' => [
                        'bar' => [
                            'borderWidth' => 1
                        ]
                    ],
                    // 'series' => $data_chart_profit_per_amount,
                    'series' => $data_chart_job_personal_performance_per,

                ]
            ]); ?>

        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <h5><b>TEAM TARGET</b></h5>
        </div>
    </div>
    <?php
    $ptar_colspan = 0;
    if ($team_member != null) {
        $ptar_colspan = count($team_member) + 1;
    }
    $model_target_team = null;
    $model_target_year = \common\models\TeamTargetYear::find()->select(['id'])->where(['target_year'=>$selected_year,'team_id'=>1])->one();
    if($model_target_year){
        $model_target_team = \common\models\TeamTarget::find()->where(['target_year_id'=>$model_target_year->id])->all();
    }

    function getTargetbyEmp($target_id,$emp_id){
       $amount = 0;
       $model = \common\models\TeamPersonalTarget::find()->select(['emp_target_amount'])->where(['team_target_id'=>$target_id,'emp_id'=>$emp_id])->one();
       if($model){
           $amount = $model->emp_target_amount;
       }
       return $amount;
    }
    ?>
    <div class="row">
        <div class="col-lg-12">
            <table class="table table-bordered" id="table-target-list">
                <thead>
                <tr>
                    <td rowspan="2" style="background-color: lightgreen;vertical-align: middle;text-align: center;">
                        Milestone
                    </td>
                    <td colspan="4" style="background-color: lightgreen;text-align: center;"><b>TEAM TARGET (TTAR)</b></td>
                    <td colspan="<?= $ptar_colspan ?>" style="background-color: lightgreen;text-align: center;"><b>PERSONAL
                        TARGET (PTAR)</b>
                    </td>
                    <td style="background-color: lightgreen;text-align: center;width: 3%"></td>
                </tr>
                <tr>
                    <td style="background-color: lightgreen;text-align: center;">Monthly Target</td>
                    <td style="background-color: lightgreen;text-align: center;">Tele sell team target</td>
                    <td style="background-color: lightgreen;text-align: center;">Installation team target</td>
                    <td style="background-color: lightgreen;text-align: center;">% TTAR</td>
                    <?php foreach ($team_member as $value): ?>
                        <td style="background-color: lightgreen;text-align: center;"><?= \backend\models\Employee::findFullName($value->emp_id) ?></td>
                    <?php endforeach; ?>
                    <td style="background-color: lightgreen;text-align: center;">% PTAR</td>
                    <td style="background-color: lightgreen;text-align: center;width: 3%"></td>
                </tr>
                </thead>
                <tbody>
                <?php if($model_target_team ==null):?>
                <tr>
                    <td style="padding: 0;">
                        <input type="text" class="form-control line-milestone" style="height: 46px;border: none;text-align: left;"
                               name="line_milestone[]" value="">
                    </td>
                    <td style="padding: 0;">
                        <input type="text" class="form-control line-monthly-target"
                               style="height: 46px;border: none;text-align: right;" name="line_monthly_target[]"
                               value="0" onchange="calTeamtarget()">
                    </td>
                    <td style="padding: 0;"><input type="text" class="form-control line-tele-sell-target"
                                                   style="height: 46px;border: none;text-align: right;"
                                                   name="line_tele_sell_target[]" value="0" readonly></td>
                    <td style="padding: 0;"><input type="text" class="form-control line-install-target"
                                                   style="height: 46px;border: none;text-align: right;"
                                                   name="line_install_target[]" value="0" readonly></td>
                    <td style="padding: 0;"><input type="text" class="form-control lint-ttar"
                                                   style="height: 46px;border: none;text-align: center;"
                                                   name="line_ttar[]" value="0"></td>
                    <?php $loop_emp_num = 0;?>
                    <?php foreach ($team_member as $value): ?>
                        <?php $loop_emp_num +=1;?>
                        <td style="padding: 0;">
                            <input type="hidden" name="line_personal_emp_id<?=$loop_emp_num?>[]" value="<?= $value->emp_id ?>">
                            <input type="text" class="form-control line-personal-target"
                                   style="height: 46px;border: none;text-align: right;" name="line_personal_target<?=$loop_emp_num?>[]"
                                   value="0" readonly>
                        </td>
                    <?php endforeach; ?>
                    <td style="padding: 0;"><input type="text" class="form-control line-ptar"
                                                   style="height: 46px;border: none;text-align: center;"
                                                   name="line_ptar[]" value="0"></td>
                    <td><div class="btn btn-sm btn-danger" onclick="removeTeamtarget($(this))">-</div></td>
                </tr>
                <?php else:?>
                <?php foreach($model_target_team as $value_target):?>
                        <tr>
                            <td style="padding: 0;">
                                <input type="text" class="form-control line-milestone" style="height: 46px;border: none;text-align: left;"
                                       name="line_milestone[]" value="<?=$value_target->milestone?>">
                            </td>
                            <td style="padding: 0;">
                                <input type="text" class="form-control line-monthly-target"
                                       style="height: 46px;border: none;text-align: right;" name="line_monthly_target[]"
                                       value="<?=number_format($value_target->monthly_amount,2)?>" onchange="calTeamtarget()">
                            </td>
                            <td style="padding: 0;"><input type="text" class="form-control line-tele-sell-target"
                                                           style="height: 46px;border: none;text-align: right;"
                                                           name="line_tele_sell_target[]" value="<?=number_format($value_target->tele_sell_amount,2)?>" readonly></td>
                            <td style="padding: 0;"><input type="text" class="form-control line-install-target"
                                                           style="height: 46px;border: none;text-align: right;"
                                                           name="line_install_target[]" value="<?=number_format($value_target->installation_amount,2)?>" readonly></td>
                            <td style="padding: 0;"><input type="text" class="form-control lint-ttar"
                                                           style="height: 46px;border: none;text-align: center;"
                                                           name="line_ttar[]" value="<?=number_format($value_target->ttar_per,2)?>"></td>
                            <?php $loop_emp_num = 0;?>
                            <?php foreach ($team_member as $value): ?>
                                <?php
                                $loop_emp_num +=1;
                                $line_emp_target_amount = getTargetbyEmp($value_target->id,$value->emp_id);
                                ?>
                                <td style="padding: 0;">
                                    <input type="hidden" name="line_personal_emp_id<?=$loop_emp_num?>[]" value="<?= $value->emp_id ?>">
                                    <input type="text" class="form-control line-personal-target"
                                           style="height: 46px;border: none;text-align: right;" name="line_personal_target<?=$loop_emp_num?>[]"
                                           value="<?=number_format($line_emp_target_amount,2)?>" readonly>
                                </td>
                            <?php endforeach; ?>
                            <td style="padding: 0;"><input type="text" class="form-control line-ptar"
                                                           style="height: 46px;border: none;text-align: center;"
                                                           name="line_ptar[]" value="<?=number_format($value_target->ptar_per,2)?>"></td>
                            <td><div class="btn btn-sm btn-danger" onclick="removeTeamtarget($(this))">-</div></td>
                        </tr>
                <?php endforeach;?>
                <?php endif;?>
                </tbody>
                <tfoot>
                <tr>
                    <td>
                        <div class="btn btn-sm btn-primary" onclick="addTargetLine()">เพิ่มรายการ</div>
                    </td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>

</form>


<?php
function getSalemonth($team_id, $emp_id, $month, $year)
{
    $data = [];
    if ($team_id != null && $emp_id != null && $month != null && $year != null) {
        $model = \common\models\Job::find()->where(['team_id' => $team_id, 'head_id' => $emp_id, 'month(trans_date)' => $month, 'year(trans_date)' => $year])->all();
        if ($model) {
            $amount = 0;
            $profit = 0;
            $profit_per = 0;
            foreach ($model as $value) {
                $amount += $value->job_value_amount;
                $profit += $value->job_benefit_amount;
                $profit_per += $value->job_benefit_per;
            }

            $team_sale_total_amount = getTotalSale($team_id, $month, $year);
            $team_profit_total_amount = getTotalProfit($team_id, $month, $year);
            $team_job_count = getTotalJob($team_id, $month, $year);

            array_push($data, [
                'job_value_amount' => $amount,
                'total_sale_amount' => $team_sale_total_amount,
                'profit_amount' => $profit,
                'profit_per' => $profit_per,
                'total_profit_amount' => $team_profit_total_amount,
                'total_job_count' => $team_job_count,
                'total_job_count_by_emp' => count($model),
            ]);


        }
    }
    return $data;
}

function getPerform($team_id, $emp_id, $month, $year)
{
    $data = [];
    if ($team_id != null && $emp_id != null && $month != null && $year != null) {
        $model = \common\models\PerformanceChart::find()->where(['team_id' => $team_id, 'emp_id' => $emp_id, 'perform_month' => $month, 'perform_year' => $year])->one();
        if ($model) {
            array_push($data, [
                'job_attendance' => $model->time_atten_per,
                'job_performance' => $model->personal_perform_per,
                'high_perform_per' => $model->hight_perform_per,
                'low_perform_per' => $model->low_perform_per,
            ]);
        }
    }
    return $data;
}

function getTotalSale($team_id, $month, $year)
{
    $total = 0;
    if ($team_id != null && $month != null && $year != null) {
        $model = \common\models\Job::find()->select(['job_value_amount'])->where(['team_id' => $team_id, 'month(trans_date)' => $month, 'year(trans_date)' => $year])->all();
        if ($model) {
            foreach ($model as $value) {
                $total += $value->job_value_amount;
            }
        }
    }
    return $total;
}

function getTotalProfit($team_id, $month, $year)
{
    $total = 0;
    if ($team_id != null && $month != null && $year != null) {
        $model = \common\models\Job::find()->select(['job_benefit_amount'])->where(['team_id' => $team_id, 'month(trans_date)' => $month, 'year(trans_date)' => $year])->all();
        if ($model) {
            foreach ($model as $value) {
                $total += $value->job_benefit_amount;
            }
        }
    }
    return $total;
}

function getTotaljob($team_id, $month, $year)
{
    $total = 0;
    if ($team_id != null && $month != null && $year != null) {
        $total = \common\models\Job::find()->where(['team_id' => $team_id, 'month(trans_date)' => $month, 'year(trans_date)' => $year])->count();
    }
    return $total;
}

function getKpiperform($team_id, $month, $year, $kpi_title_id)
{
    $data = [];
    if ($team_id && $month && $year && $kpi_title_id) {
        $model = \common\models\KpiPerformance::find()->where(['team_id' => $team_id, 'perform_year' => $year, 'perform_month' => $month, 'kpi_title_id' => $kpi_title_id])->one();
        if ($model) {
            array_push($data, ['rating' => $model->rating_per, 'personal_goal' => $model->personal_goal_per, 'high_performance' => $model->high_performance_per, 'minimum' => $model->minimum_per, 'low_performance' => $model->low_performance_per]);
        }
    }
    return $data;
}

?>

<?php
$js = <<<JS
$(function(){});
function calkpi(e){
    var line_kpi_rating = e.closest("tr").find(".line-kpi-rating").val();
    var line_kpi_personal_goal = e.closest("tr").find(".line-kpi-personal-goal").val();
    //var line_kpi_high_performance = e.closest("tr").find(".line-kpi-high-performance").val();
    var line_kpi_minimum = e.closest("tr").find(".line-kpi-minimum").val();
    //var line_kpi_low_performance = e.closest("tr").find(".line-kpi-low-performance").val();
    
    var line_kpi_high_cal = (parseFloat(line_kpi_rating)*parseFloat(line_kpi_personal_goal))/100;
    var line_low_performance_cal = (parseFloat(line_kpi_minimum)*parseFloat(line_kpi_rating))/100;
    
    
    e.closest("tr").find(".line-kpi-rating").val(parseFloat(line_kpi_rating).toFixed(1));
    e.closest("tr").find(".line-kpi-personal-goal").val(parseFloat(line_kpi_personal_goal).toFixed(1));
    e.closest("tr").find(".line-kpi-minimum").val(parseFloat(line_kpi_minimum).toFixed(1));
    e.closest("tr").find(".line-kpi-high-performance").val(line_kpi_high_cal.toFixed(1));
    e.closest("tr").find(".line-kpi-low-performance").val(line_low_performance_cal.toFixed(1));
    
    calKpiTotal();
}

function calKpiTotal(){
    var total_kpi_rating = 0;
    var total_kpi_high_performance = 0;
    var total_kpi_low_performance = 0;
    
    $(".line-kpi-rating").each(function(){
        total_kpi_rating += parseFloat($(this).val());
    });
    
    $(".line-kpi-high-performance").each(function(){
        total_kpi_high_performance += parseFloat($(this).val());
    });
 
    $(".line-kpi-low-performance").each(function(){
        total_kpi_low_performance += parseFloat($(this).val());
    });
    
    $(".line-kpi-rating-total").val(parseFloat(total_kpi_rating).toFixed(1));
    $(".line-kpi-high-total").val(parseFloat(total_kpi_high_performance).toFixed(1));
    $(".line-kpi-low-total").val(parseFloat(total_kpi_low_performance).toFixed(1));
    
    $(".line-job-high-per").each(function(){
       $(this).val(parseFloat(total_kpi_high_performance).toFixed(1)); 
    });
    $(".line-job-low-per").each(function(){
       $(this).val(parseFloat(total_kpi_low_performance).toFixed(1)); 
    });
    
}

function calPersonalPerformance(){
    var profit_per = 0;
    var sale_amount_per = 0;
    var atten_per = 0;
    var job_count_per = 0; 
    
    var kpi_profit_per = 0;
    var kpi_sale_per = 0;
    var kpi_atten_per = 0;
    var kpi_job_count_per = 0;
    
    //alert();
    
    $("table#table-list tbody tr").each(function(){
       profit_per = $(this).closest("tr").find(".line-profit-per").val(); 
       sale_amount_per = $(this).closest("tr").find(".line-sale-total-per").val();
       atten_per = $(this).closest("tr").find(".line-attendance-per").val();
       job_count_per = $(this).closest("tr").find(".line-job-count-per").val();
       
        var loop_no = 0;
        $("table#table-kpi-list tbody tr").each(function(){
                if(loop_no === 0){
                    kpi_profit_per = $(this).closest("tr").find(".line-kpi-rating").val();
                }else if(loop_no === 1){
                    kpi_sale_per = $(this).closest("tr").find(".line-kpi-rating").val();
                }else if(loop_no === 2){
                    kpi_atten_per = $(this).closest("tr").find(".line-kpi-rating").val();
                }else if(loop_no === 3){
                    kpi_job_count_per = $(this).closest("tr").find(".line-kpi-rating").val();
                }
                loop_no+=1;
      });
    
        var sum_1 =0;
        var sum_2 =0;
        var sum_3 = 0;
        var sum_4 = 0;
        
        sum_1 = parseFloat(profit_per) * parseFloat(kpi_profit_per) /100;
        sum_2 = parseFloat(sale_amount_per) * parseFloat(kpi_sale_per) /100;
        sum_3 = parseFloat(atten_per) * parseFloat(kpi_atten_per) /100;
        sum_4 = parseFloat(job_count_per) * parseFloat(kpi_job_count_per) /100;
        
        $(this).closest("tr").find(".line-kpi-personal-perform").val(parseFloat(sum_1 + sum_2 + sum_3 + sum_4).toFixed(1));
        $(this).closest("tr").find(".line-attendance-per").val(parseFloat(atten_per).toFixed(1));
        
    });
    
    var total_personal_perform = 0;
    $("table#table-list tbody tr").each(function(){
        total_personal_perform = total_personal_perform + (parseFloat($(this).closest("tr").find(".line-kpi-personal-perform").val()));
    });
    $(".total-personal-performance").html(parseFloat(total_personal_perform).toFixed(1));
    
}

function addTargetLine(){
     var tr = $("#table-target-list tbody tr:last");
     if(tr.closest("tr").find(".line-milestone").val() != ""){
         var clone = tr.clone();
       //  clone.closest("tr").find(".line-rec-id").val(0);
         clone.closest("tr").find(".line-monthly-target").val(0);
         clone.closest("tr").find(".line-tele-sell-target").val(0);
         clone.closest("tr").find(".line-install-target").val(0);
         clone.closest("tr").find(".line-ttar").val(0);
         clone.closest("tr").find(".line-personal-target").val(0);
         clone.closest("tr").find(".line-ptar").val(0);
         tr.after(clone);
     }
}
function calTeamtarget(){
    $("table#table-target-list tbody tr").each(function(){
        var line_monthly_target = $(this).closest("tr").find(".line-monthly-target").val().replace(",","");
        var line_tele_sell_target = $(this).closest("tr").find(".line-tele-sell-target").val();
        var line_install_target = $(this).closest("tr").find(".line-install-target").val();
        var line_ttar = $(this).closest("tr").find(".line-ttar").val();
        var line_personal_taget = $(this).closest("tr").find(".line-personal-taget").val();
        var line_ptar = $(this).closest("tr").find(".line-ptar").val();
        
        var sum_1 =0;
        var sum_2 =0;
        
        sum_1 = parseFloat(line_monthly_target) /2;
        sum_2 = (parseFloat(sum_1) * 70) /100;
        
        $(this).closest("tr").find(".line-tele-sell-target").val(parseFloat(sum_1).toFixed(2));
        $(this).closest("tr").find(".line-install-target").val(parseFloat(sum_1).toFixed(2));
        $(this).closest("tr").find(".line-personal-target").val(parseFloat(sum_2).toFixed(2)).change();
        //$(this).closest("tr").find(".line-ttar").val(parseFloat(sum_2).toFixed(1));
    });
}
function removeTeamtarget(e){
    if($("table#table-target-list tbody tr").length > 1){
        e.parent().parent().remove();
    }
}

JS;
$this->registerJs($js, static::POS_END);
?>

