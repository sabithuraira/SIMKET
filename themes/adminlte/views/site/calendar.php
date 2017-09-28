<style>
    @import url('<?php echo Yii::app()->theme->baseUrl.'/css/baru/jadwal.css';?>');
</style>
<?php $this->pageTitle=Yii::app()->name; ?>
<div id="icontop-container">
<?php  
if(!Yii::app()->user->isGuest){
    if(Yii::app()->user->isKabupaten()==0){
        $this->menu=array(
            array('label'=>'<i class="icon-th-add"></i>  Tambah Kegiatan Baru', 'url'=>array('kegiatan/create')),
        );
    }
}
?>
<?php //echo CHtml::link("Tambah Kegiatan Baru",array('jadwal/create'));?>
</div>
<div style="clear: both;"></div>
<br />
<?php

$bb=array();
foreach($model as $i=>$ii)
{
    $bb[$i]=array('url'=>$this->createUrl('kegiatan/progress',
                array('id'=>$ii['id'])),$ii['id'],'title'=>$ii['kegiatan'],'start'=>date($ii['end_date']),
            'end'=>date($ii['end_date']),'allDay'=>false,'className'=>"eventColor".$ii->CalendarClass());
}
?>
<?php $this->widget('application.extensions.fullcalendar.FullcalendarGraphWidget',
    array(
        'data'=>$bb,
        'options'=>array(
            'editable'=>false,
            //'weekMode'=>'liquid',
            //'weekends'=>true,
            'firstDay'=>1,
            'header'=>array(
                'right'=>'',//'month,agendaWeek,agendaDay',
                'left'=>'today prev,next',
                'center'=>'      title',
            ),
            'timeFormat'=>'',
            'dayNames'=>array('Minggu', 'Senin', 'Selasa', 'Rabu',
                        'Kamis', 'Jumat', 'Sabtu'),
            'monthNames'=>array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli',
                        'Agustus', 'September', 'Oktober', 'November', 'Desember'),
            'columnFormat'=>array(
                    'day'=>'dddd M/d',
                    'month'=>'dddd',
                    'week'=>'dddd, MMM dS',
            ),
        ),
    )
);
?>