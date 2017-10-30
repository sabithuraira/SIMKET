<div id="mfd_tag">
    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-12">

          <div class="info-box bg-aqua">
            <span class="info-box-icon"><i class="fa fa-bookmark-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Billing on {{ hello }}</span>
              
            </div>
          </div>
        </div>
      </div>
      <!-- /.row -->

      <div class="row">
        <div class="col-md-12">

          <div id="flash-message"></div>
          <div class="loader"></div>

          <div class="box box-info">
              <div class="mailbox-controls">
                <!-- Check all button -->
                <div class="btn-group">
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-reply"></i></button>
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-share"></i></button>
                </div>
                <!-- /.btn-group -->
                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                <a id="add" class="btn btn-default btn-sm toggle-event" href="#" data-id="adddata"><i class="fa fa-plus"></i> Add Bill</a>
                <div class="pull-right">
                  1-50/200
                  <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                  </div>
                  <!-- /.btn-group -->
                </div>
                <!-- /.pull-right -->
              </div>

              <div class="table-responsive mailbox-messages">
                <table class="table table-border table-hover table-striped">
                  <thead>
                    <tr>
                      <th>
                        <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
                        </button>
                      </th>
                      <td></td>
                      <td>Title</td>
                      <td>Category</td>
                      <td>Billing</td>
                      <td>Paying</td>
                      <td>Residual Bill</td>
                      <td>Action</td>
                    </tr>
                  </thead>
                   <tbody v-for="row in data">
                    <tr>
                      <td><input type="checkbox"></td>
                      <td>{{ row.date }}</td>
                      <td>{{ row.note }}</td>
                      <td>{{ row.category_label }}</td>
                      <td>{{ row.currency }} {{ row.amount }}</td>
                      <td>{{ row.currency }} {{ row.paying }}</td>
                      <td>
                        <span v-if="row.residual<=0" class="description-percentage text-green"><i class="fa fa-caret-up"></i> {{ row.currency }} {{ row.residual }}</span>
                        <span v-if="row.residual>0" class="description-percentage text-red"><i class="fa fa-caret-down"></i> {{ row.currency }} {{ row.residual }}</span>   
                      <td>
                        <a :id="'update'+row.id" class="btn btn-default btn-sm toggle-event" href="#" data-id="adddata"><i class="fa fa-plus-square-o"></i> Update</a>
                        <a :id="'paying'+row.id" class="btn btn-default btn-sm toggle-event" href="#" data-id="addtransaction"><i class="fa fa-plus-square-o"></i> Add Paying</a>
                        <a :id="'detail'+row.id" class="btn btn-default btn-sm toggle-event" href="#" data-id="detail"><i class="fa fa-search"></i> Detail</a>
                      </td>
                      
                    </tr>
                  </tbody>
                    
                </table>
              </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
</div>



<?php $baseUrl = Yii::app()->theme->baseUrl; ?>
<script src="<?php echo $baseUrl;?>/dist/js/vue_page/mfd.js"></script>
