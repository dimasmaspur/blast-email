<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container mt-5">
    <div class="row">
        <div class="col">
                      <!-- DataTales Example -->
        <h3 class="my-3">Data Miner</h3>
        <p class="result"></p>
        <?php
            if(!empty(session()->getFlashdata('success'))){ ?>
            <div class="alert alert-success">
                <?php echo session()->getFlashdata('success');?>
            </div>     
            <?php } 
 
            if(!empty(session()->getFlashdata('error'))){ ?>
            <div class="alert alert-danger">
                <?php echo session()->getFlashdata('error');?>
            </div>
            <?php } ?>
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#blastModal">Blast Email</a>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>UserID</th>
                      <th>Nama</th>
                      <th>Email</th>
                      <th>Barcode</th>
                      <th>No Undian</th>
                      <th>Terkirim</th>
                      <th>Status</th>

                    </tr>
                  </thead>
                 
                  <tbody id="tbody">
                  <?php $i=1; foreach($result as $value =>$v){ ?>

                      <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $v["user_id"];?></td>
                        <td><?php echo $v["nama"];?></td>
                        <td><?php echo $v["email"] ?></td>
                        <td><?php echo $v["barcode"] ?></td>
                        <td><?php echo $v["no_undian"] ?></td>
                        <td><?php echo $v["terkirim"] ?></td>
                        <td><?php echo $v["status"] ?></td>
                      </tr>

                  <?php } ?> 
                   
                   
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
    </div>
</div>
 <!-- blast Modal-->
 <div class="modal fade" id="blastModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Apakah anda yakin ingin blast email?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="/blast">Blast</a>
        </div>
      </div>
    </div>
  </div>

<script></script>


<?= $this->endSection(); ?>


