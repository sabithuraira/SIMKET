<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
$baseUrl = Yii::app()->theme->baseUrl; 
?>

<div class="row-fluid">
    <div class="span9">
      <?php
        $this->beginWidget('zii.widgets.CPortlet', array(
            'title'=>'<span class="icon-picture"></span>Progress Kegiatan Kabupaten',
            'titleCssClass'=>''
        ));
        ?>
        
        <div class="progress-kerja-chart" style="height: 250px;width:100%;margin-top:15px; margin-bottom:15px;"></div>

        
        <?php $this->endWidget(); ?>
        
    </div>
    <div class="span3">
        <div class="summary">
          <ul>
            <li>
                <span class="summary-icon">
                    <img src="<?php echo $baseUrl ;?>/img/credit.png" width="36" height="36" alt="Monthly Income">
                </span>
                <span class="summary-number"><?php echo $model->totalProgress; ?> %</span>
                <span class="summary-title"> Progress <?php echo date('Y'); ?></span>
            </li>
            <li>
                <span class="summary-icon">
                    <img src="<?php echo $baseUrl ;?>/img/page_white_edit.png" width="36" height="36" alt="Open Invoices">
                </span>
                <span class="summary-number"><?php echo $model->totalkegiatan; ?></span>
                <span class="summary-title"> Jumlah Kegiatan <?php echo date('Y'); ?></span>
            </li>
            <li>
                <span class="summary-icon">
                    <img src="<?php echo $baseUrl ;?>/img/page_white_excel.png" width="36" height="36" alt="Open Quotes<">
                </span>
                <span class="summary-number"><?php echo $model->totalKegiatanExpired; ?></span>
                <span class="summary-title"> Kegiatan Expired <?php echo date('Y'); ?></span>
            </li>
            <li>
                <span class="summary-icon">
                    <img src="<?php echo $baseUrl ;?>/img/group.png" width="36" height="36" alt="Active Members">
                </span>
                <span class="summary-number"><?php echo User::model()->count(); ?></span>
                <span class="summary-title"> Jumlah Anggota</span>
            </li>
            <li>
                <span class="summary-icon">
                    <img src="<?php echo $baseUrl ;?>/img/folder_page.png" width="36" height="36" alt="Recent Conversions">
                </span>
                <span class="summary-number"><?php echo UnitKerja::model()->count(); ?></span>
                <span class="summary-title">Jumlah Unit Kerja</span></li>
        
          </ul>
        </div>

    </div>
</div>


<div class="row-fluid">
    <div class="span12">
      <?php $this->widget('zii.widgets.grid.CGridView', array(
            /*'type'=>'striped bordered condensed',*/
            'htmlOptions'=>array('class'=>'table table-striped table-bordered table-condensed'),
            'dataProvider'=>$kegiatan,
            'template'=>"{items}",
            'columns'=>array(
                array('name'=>'kegiatan','header'=>'Kegiatan'),
                array('header'=>'Penanggung Jawab','value'=>'$data->unitKerja->name'),
                array('header'=>'Tanggal Selesai','value'=>'HelpMe::HrDate($data->end_date)'),
                array('header'=>'Progress','value'=>'$data->getProgressValue()'),
                array('header'=>'', 'value'=>'CHtml::link("Progress",array("kegiatan/progress","id"=>$data->id))', 'type'=>'raw'),
                
            ),
        )); ?>
    </div><!--/span-->
    
</div><!--/row-->


<script>
$(function() {

    var divElement = $('div'); //log all div elements
    //Stacked bars chart
    if (divElement.hasClass('progress-kerja-chart')) {
    $(function () {
        //some data
        var d1 = [];
        var ticks = [];
        
        <?php foreach (Kegiatan::model()->getProgressPerKabupaten() as $key => $value) { 
            $persen=$value['vtotal']/$value['vtarget']*100;
        ?>
            d1.push([<?php echo $key ?>, parseInt(<?php echo $persen; ?>)]);
            ticks.push([<?php echo $key ?>,"<?php echo $value['name'] ?>"]);
        <?php } ?>
     
      
        var ds = new Array();
     
         ds.push({
            data:d1
        });
       

        var stack = 0, bars = true, lines = false, steps = false;

        var options = {
                grid: {
                    show: true,
                    aboveData: false,
                    color: "#3f3f3f" ,
                    labelMargin: 5,
                    axisMargin: 0, 
                    borderWidth: 0,
                    borderColor:null,
                    minBorderMargin: 5 ,
                    clickable: true, 
                    hoverable: true,
                    autoHighlight: true,
                    mouseActiveRadius: 20
                },
                series: {
                    grow: {active:false},
                    stack: stack,
                    lines: { show: lines, fill: true, steps: steps },
                    bars: { show: bars, barWidth: 0.5, fill:1}
                },
                xaxis: {ticks:ticks, tickDecimals: 0},
                legend: { position: "se" },
                colors: chartColours,
                shadowSize:1,
                tooltip: true, //activate tooltip
                tooltipOpts: {
                    content: "%s : %y.0",
                    shifts: {
                        x: -30,
                        y: -50
                    }
                }
        };

        $.plot($(".progress-kerja-chart"), ds, options);
    });
    }//end if

    $(".knob").knob({
        draw : function () {

            // "tron" case
            if(this.$.data('skin') == 'tron') {

                var a = this.angle(this.cv)  // Angle
                    , sa = this.startAngle          // Previous start angle
                    , sat = this.startAngle         // Start angle
                    , ea                            // Previous end angle
                    , eat = sat + a                 // End angle
                    , r = 1;

                this.g.lineWidth = this.lineWidth;

                this.o.cursor
                    && (sat = eat - 0.3)
                    && (eat = eat + 0.3);

                if (this.o.displayPrevious) {
                    ea = this.startAngle + this.angle(this.v);
                    this.o.cursor
                        && (sa = ea - 0.3)
                        && (ea = ea + 0.3);
                    this.g.beginPath();
                    this.g.strokeStyle = this.pColor;
                    this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sa, ea, false);
                    this.g.stroke();
                }

                this.g.beginPath();
                this.g.strokeStyle = r ? this.o.fgColor : this.fgColor ;
                this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sat, eat, false);
                this.g.stroke();

                this.g.lineWidth = 2;
                this.g.beginPath();
                this.g.strokeStyle = this.o.fgColor;
                this.g.arc( this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false);
                this.g.stroke();

                return false;
            }
        }
    });

    // Example of infinite knob, iPod click wheel
    var v, up=0,down=0,i=0
        ,$idir = $("div.idir")
        ,$ival = $("div.ival")
        ,incr = function() { i++; $idir.show().html("+").fadeOut(); $ival.html(i); }
        ,decr = function() { i--; $idir.show().html("-").fadeOut(); $ival.html(i); };
    $("input.infinite").knob(
                        {
                        min : 0
                        , max : 20
                        , stopper : false
                        , change : function () {
                                        if(v > this.cv){
                                            if(up){
                                                decr();
                                                up=0;
                                            }else{up=1;down=0;}
                                        } else {
                                            if(v < this.cv){
                                                if(down){
                                                    incr();
                                                    down=0;
                                                }else{down=1;up=0;}
                                            }
                                        }
                                        v = this.cv;
                                    }
                        });
});
</script>