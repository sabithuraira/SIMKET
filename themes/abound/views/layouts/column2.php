<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>

  <div class="row-fluid">
	<div class="span3">
	
  <!--login-->
<?php if(Yii::app()->user->isGuest){ ?>
<div class="page-header">
  <h1>Login <small>ke akun anda</small></h1>
</div>
<div class="row-fluid">
  
    <div>
<?php
  $this->beginWidget('zii.widgets.CPortlet', array(
    'title'=>"Private access",
  ));
  
    $model_log=new LoginForm;
?>

    
    <div class="form">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'login-form',
        'action'=>Yii::app()->createUrl('/site/login'),
        'enableClientValidation'=>true,
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
        ),
    )); ?>
    
        <div class="row">
            <?php echo $form->labelEx($model_log,'username'); ?>
            <?php echo $form->textField($model_log,'username'); ?>
            <?php echo $form->error($model_log,'username'); ?>
        </div>
    
        <div class="row">
            <?php echo $form->labelEx($model_log,'password'); ?>
            <?php echo $form->passwordField($model_log,'password'); ?>
            <?php echo $form->error($model_log,'password'); ?>
        </div>
    
        <div class="row rememberMe">
            <?php echo $form->checkBox($model_log,'rememberMe'); ?>
            <?php echo $form->label($model_log,'rememberMe'); ?>
            <?php echo $form->error($model_log,'rememberMe'); ?>
        </div>
    
        <div class="row buttons">
            <?php echo CHtml::submitButton('Login',array('class'=>'btn btn btn-primary')); ?>
        </div>
    
    <?php $this->endWidget(); ?>
    </div><!-- form -->

<?php $this->endWidget();?>


    </div>

</div>
<?php }else{ ?>

<div class="page-header">
  <h1>Sistem Monitoring Kegiatan <small>BPS Provinsi Sumatera Selatan</small></h1>
</div>
<div class="row-fluid">
  <img src="<?php echo Yii::app()->theme->baseUrl ;?>/img/logo_bps.png"  width="200" height="200" >
</div>

<?php } ?>

  <!-- end login -->	
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
