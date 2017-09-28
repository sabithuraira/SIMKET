<?php
/* @var $this KegiatanController */
/* @var $model Kegiatan */

$this->breadcrumbs=array(
    'Kabupaten'=>array('index'),
    $model->name,
);

?>

<h1><?php echo $model->name; ?></h1>


<a href="#myModal" role="button" class="btn" data-toggle="modal">Tambah Pengiriman</a>
<table class="table table-hover table-striped table-bordered table-condensed">
    <tr>
        <th rowspan="2">No. </th>
        <th rowspan="2">Kegiatan</th>
        <th rowspan="2">Target </th>
        <th colspan="2">Pengiriman</th>
        <th colspan="2">Penerimaan</th>
    </tr>
    <tr>
            <th>In</th>
            <th>%</th>
            <th>In</th>
            <th>%</th>
    </tr>
    <?php
        foreach (Participant::model()->findAllByAttributes(array('unitkerja'=>$model->id)) as $key => $value)
        {
            echo '<tr>';

            echo '<td>'.($key+1).'</td>';
            echo '<td>'.$value->kegiatan0->kegiatan.'</td>';
            echo '<td>'.$value->target.'</td>';
          
            echo '<td>'.$value->getListProgressDelivery().'</td>';
            echo '<td>'.$value->getPercentageProgress(2).' % </td>';

            echo '<td>'.$value->getListProgressAcceptance().'</td>';
            echo '<td>'.$value->getPercentageProgress(1).' % </td>';
            echo '</tr>';
            
        }
    ?>
</table>



<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Tambah Progress</h3>
    </div>
    
    <div class="modal-body">
        <form id="InfroText" method="POST">
  
            <input name="InfroText" value="1" type="hidden">
      
            <table>
                <tbody>
                   
                    <tr>
                        <td>Kegiatan</td>
                        <td>
                            <?php 
                                echo CHtml::dropDownList('kegiatan','',
                                        CHtml::listData(Participant::model()->findAllByAttributes(array('unitkerja'=>$model->id)),
                                            'kegiatan','kegiatan0.kegiatan'),
                                        array('empty'=>'- Pilih Kegiatan-')); 
                            ?>
                        </td>
                    </tr>

                     <tr>
                        <td>Tanggal Pengiriman</td>
                        <td>
                            <?php 
                                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                    'name'=>'tanggal',
                                    'options' => array(
                                        'dateFormat'=>'yy-mm-dd',
                                        //'changeYear'=>true,
                                        //'changeMonth'=>true,
                                    ),
                                ));
                            ?>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>Jumlah</td>
                        <td>
                            <?php echo CHtml::textField('jumlah',''); ?>
                        </td>
                    </tr>


                    <tr>
                        <td>Dikirim melalui</td>
                        <td>
                            <?php echo CHtml::textField('via',''); ?>
                        </td>
                    </tr>

                    <input id="idnya" type="hidden" value="<?php  echo $model->id; ?>">
                
                </tbody>
            </table>
      </form>
    </div>
    
    <div class="modal-footer">
      <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
      <button class="btn btn-primary" data-dismiss="modal" id="InfroTextSubmit">Save changes</button>
    </div>
</div>

<script>
    $('#InfroTextSubmit').click(function(){

        var kegiatan=$('#kegiatan').val();
        var tanggal=$('#tanggal').val();
        var jumlah=$('#jumlah').val();
        var via=$('#via').val();
        var idnya=$('#idnya').val();
         $.ajax({
            url: "<?php echo Yii::app()->createUrl('kegiatan/insert_pengiriman'); ?>",
            type:"post",
            dataType :"json",
            data:{"kegiatan":kegiatan,
                    "tanggal":tanggal,
                    "jumlah":jumlah,
                    "via":via,
                    "idnya":idnya,
                },
                success : function(data)
                {
                    if(data.satu.length >0)
                    {
                        window.location.href=data.satu;
                    }
                    else
                    {
                        alert('Data gagal disimpan, refresh halaman anda dan ulangi lagi');
                    }
                }
            }
        );

    });
</script>
