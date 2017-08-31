<div class="navbar navbar-inverse navbar-fixed-top">
	<div class="navbar-inner">
    <div class="container">
        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
     
          <!-- Be sure to leave the brand out there if you want it shown -->
          
          <div class="nav-collapse">
			<?php 

                $this->widget('zii.widgets.CMenu',array(
                    'htmlOptions'=>array('class'=>'pull-right nav'),
                    'submenuHtmlOptions'=>array('class'=>'dropdown-menu'),
					'itemCssClass'=>'item-test',
                    'encodeLabel'=>false,
                    'items'=>array(
                        array('label'=>'Dashboard', 'url'=>array('/site/index')),
                        //array('label'=>'Summary', 'url'=>array('/site/summary')),
                        array('label'=>'Peringkat <span class="caret"></span>', 'url'=>'#','itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"), 
                            'items'=>array(
                                array('label'=>'Kabupaten/Kota', 'url'=>array('site/peringkat')),
                                array('label'=>'Kabupaten/Kota Bulanan', 'url'=>array('site/peringkat_month')),
                            ),
                        ),
                        /*
                        array('label'=>'Kabupaten/Kota <span class="caret"></span>', 'url'=>'#','itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"), 
                            'items'=>HelpMe::getListKabupaten()
                        ),
                        */
                        array('label'=>'Unit Kerja <span class="caret"></span>', 'url'=>'#','itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"), 
                            'visible'=>!Yii::app()->user->isGuest,
                            'items'=>HelpMe::getListProvinsi()
                        ),
                        array('label'=>'Kab/Kota <span class="caret"></span>', 'url'=>'#','itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"), 
                            'visible'=>!Yii::app()->user->isGuest,
                            'items'=>HelpMe::getListKabupaten()
                        ),


                        array('label'=>'Anggaran <span class="caret"></span>', 'url'=>'#','itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"), 
                            'items'=>array(
                                array('label'=>'Report', 'url'=>array('anggaran/index')),
                                array('label'=>'Kelola Data PAGU', 'url'=>array('pagu/index')),
                                array('label'=>'Kelola Rencana Penarikan', 'url'=>array('psatker/index')),
                                array('label'=>'Kelola Anggaran', 'url'=>array('anggaran/admin')),
                                array('label'=>'Import Data', 'url'=>array('anggaran/import','id'=>1)),
                            ),
                        ),

                        //array('label'=>'Graphs & Charts', 'url'=>array('/site/page', 'view'=>'graphs')),
                        /*
                        array('label'=>'Forms', 'url'=>array('/site/page', 'view'=>'forms')),
                        array('label'=>'Tables', 'url'=>array('/site/page', 'view'=>'tables')),
						array('label'=>'Interface', 'url'=>array('/site/page', 'view'=>'interface')),
                        array('label'=>'Typography', 'url'=>array('/site/page', 'view'=>'typography')),
                        */
                        /*array('label'=>'Gii generated', 'url'=>array('customer/index')),*/
                        //array('label'=>'Laporan', 'url'=>array('report/index')),
                        array('label'=>'Laporan <span class="caret"></span>', 'url'=>'#','itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"), 
                            'items'=>array(
                                array('label'=>'Per Kegiatan', 'url'=>array('report/index')),
                                array('label'=>'Bulanan', 'url'=>array('report/rekap')),
                            ),
                        ),

                        array('label'=>'Calendar', 'url'=>array('site/calendar')),

                        array('label'=>'Data Master <span class="caret"></span>', 'url'=>'#','itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"), 
                            'items'=>array(
                                array('label'=>'Kegiatan', 'url'=>array('/kegiatan'), 'visible'=>!Yii::app()->user->isGuest),
                                array('label'=>'Unit Kerja', 'url'=>array('/unitkerja'),'visible'=>Yii::app()->user->getUnitKerja()==1),
                                array('label'=>'User', 'url'=>array('/user'),'visible'=>Yii::app()->user->getUnitKerja()==1),
                                array('label'=>'Induk Anggaran', 'url'=>array('/induk'),'visible'=>Yii::app()->user->getUnitKerja()==1),
                            ),
                        ),
                        array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                        //array('label'=>'Change Password', 'url'=>array('/user/cp'), 'visible'=>!Yii::app()->user->isGuest),
                        array('label'=>'Account ('.Yii::app()->user->name.') <span class="caret"></span>', 'url'=>'#','itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"), 
                            'visible'=>!Yii::app()->user->isGuest,
                             'items'=>array(
                                array('label'=>'Logout', 'url'=>array('/site/logout')),
                                array('label'=>'Change Password', 'url'=>array('/user/cp')),
                            ),
                        ),
                        //array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
                    ),
                )); ?>
    	</div>
    </div>
	</div>
</div>

<div class="subnav navbar navbar-fixed-top">
    <div class="navbar-inner">
    	<div class="container">
            <!--
        	<div class="style-switcher pull-left">
                <a href="javascript:chooseStyle('none', 60)" checked="checked"><span class="style" style="background-color:#0088CC;"></span></a>
                <a href="javascript:chooseStyle('style2', 60)"><span class="style" style="background-color:#7c5706;"></span></a>
                <a href="javascript:chooseStyle('style3', 60)"><span class="style" style="background-color:#468847;"></span></a>
                <a href="javascript:chooseStyle('style4', 60)"><span class="style" style="background-color:#4e4e4e;"></span></a>
                <a href="javascript:chooseStyle('style5', 60)"><span class="style" style="background-color:#d85515;"></span></a>
                <a href="javascript:chooseStyle('style6', 60)"><span class="style" style="background-color:#a00a69;"></span></a>
                <a href="javascript:chooseStyle('style7', 60)"><span class="style" style="background-color:#a30c22;"></span></a>
          	</div>
          -->

           <form class="navbar-search pull-right" action="">
           	 
           <input type="text" class="search-query span2" placeholder="Search">
           
           </form>
    	</div>
    </div>
</div>