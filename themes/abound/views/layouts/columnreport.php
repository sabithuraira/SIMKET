<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>

  <div class="row-fluid">
    <div class="span3">
        <div class="sidebar-nav">
        
          <?php $this->widget('zii.widgets.CMenu', array(
            /*'type'=>'list',*/
            'encodeLabel'=>false,
            'items'=>array(
                array('label'=>'Laporan Total', 'url'=>array('report/index')),
                array('label'=>'Laporan Kabupaten', 'url'=>array('report/index')),
                array('label'=>'Laporan Bidang', 'url'=>array('report/index')),
                // Include the operations menu
                //array('label'=>'OPERATIONS','items'=>$this->menu),
            ),
            ));?>
        </div>
        <br>
        
    </div><!--/span-->
    <div class="span9">
    
    <?php if(isset($this->breadcrumbs)):?>
        <?php $this->widget('zii.widgets.CBreadcrumbs', array(
            'links'=>$this->breadcrumbs,
            'homeLink'=>CHtml::link('Dashboard'),
            'htmlOptions'=>array('class'=>'breadcrumb')
        )); ?><!-- breadcrumbs -->
    <?php endif?>

    <?php if(count($this->menu)>0){ ?>
    
      <div class="row-fluid">
        <?php foreach ($this->menu as $key => $value) { ?>
              <span class="btn btn-info">
                <?php echo CHtml::link($value['label'],$value['url'],array('style'=>'color:#fff')) ?>
              </span>
        <?php } ?>
      </div>

    <?php } ?>
    <!-- Include content pages -->
    <?php echo $content; ?>

    </div><!--/span-->
  </div><!--/row-->


<?php $this->endContent(); ?>
