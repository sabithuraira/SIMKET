<?php $baseUrl = Yii::app()->theme->baseUrl; ?>
<style>
    @import url('<?php echo $baseUrl.'/dist/css/step.css';?>');
</style>

	<div class="box box-info">
		<div class="mailbox-controls">
			<b><?php echo $model->getNamaMitra(); ?></b>
			<!-- /.pull-right -->
		</div>

		<div class="box-body">
            
            <div class="stepwizard">
                <div class="stepwizard-row setup-panel">
                    <div class="stepwizard-step">
                        <?php 
					    	echo CHtml::link("1", array('update', 'id'=>$model->id), array('class'=>'btn btn-default btn-circle'));
                        ?>
                        <p>Data Kegiatan</p>
                    </div>
                    <div class="stepwizard-step">
                        <?php 
					    	echo CHtml::link("2", array('mitra', 'id'=>$model->id), array('class'=>'btn btn-default btn-circle'));
                        ?>
                        <p>Petugas Kegiatan</p>
                    </div>
                    <div class="stepwizard-step">
                        <a href="#step-3" type="button" class="btn btn-primary btn-circle">3</a>
                        <p>Skoring</p>
                    </div>
                </div>
            </div>

            <hr/>

            <div class="row setup-content" id="step-1">
                <div class="col-xs-12">
                    <div class="col-md-12">
                        

                        <div class="box box-widget widget-user">
                            <!-- Add the bg color to the header using any of the bg-* classes -->
                            <div class="widget-user-header bg-black" style="background: url('../dist/img/photo1.png') center center;">
                            <h3 class="widget-user-username"><?php echo $model->namamitra; ?></h3>
                            <h5 class="widget-user-desc"><?php echo $model->statusLabel; ?></h5>
                            </div>
                            <div class="widget-user-image">
                            <img class="img-circle" src="<?php echo Yii::app()->theme->baseUrl."/dist/img/user1-128x128.jpg" ?>" alt="User Avatar">
                            </div>
                            <div class="box-footer">
                            <div class="row">
                                <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">3,200</h5>
                                    <span class="description-text">SALES</span>
                                </div>
                                <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">13,000</h5>
                                    <span class="description-text">FOLLOWERS</span>
                                </div>
                                <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4">
                                <div class="description-block">
                                    <h5 class="description-header">35</h5>
                                    <span class="description-text">PRODUCTS</span>
                                </div>
                                <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                            </div>
                        </div>


                        <?php $form=$this->beginWidget('CActiveForm', array(
                            'id'=>'kegiatan-form',
                            'enableAjaxValidation'=>false,
                        )); ?>
                            <br/>
                            <table class="table table-hover table-bordered table-condensed">
                                <?php
                                    foreach ($questions as $key => $value)
                                    {
                                        echo '<tr>';
                                        echo '<td><b>'.$value['pertanyaan'].'</b></td>';
                                        echo '</tr>';

                                        echo '<tr>';
                                        echo '<td><div class="form-group">';
                                        
                                        foreach($value->options as $key2 => $value2){
                                            $opts_name = 'opts'.$value['id'];
                                            $opts_id = 'opts'.$value['id'].$value2['skala'];

                                            $is_disable = (strlen($value2['label']) == 0) ? 'disabled' : '';
                                            echo '<div class="radio"><label>';
                                            echo '<input type="radio" name="'.$opts_name.'" id="'.$opts_id.'" value="'.$value2['skala'].'" $is_disable>('.$value2['skala'].') '.$value2['label'].'</label>';
                                            echo '</div>';    
                                        }
                                        echo '</div></td>';
                                        echo '</tr>';
                                    }
                                ?>
                            </table>

                            <div class="box-footer">
                                <?php echo CHtml::submitButton('Simpan', array('class'=>'btn btn-primary btn-sm pull-right')); ?>
                            </div>
					    <?php $this->endWidget(); ?>
                    </div>
                </div>
            </div>

		</div>
	</div>
