<?php $this->load->view('include/header')?>
<?php $this->load->view('include/sidebar')?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Change Password</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Change Password</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
 
    <section class="content">
      <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">
        <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Change Password</h3>
</div>
              <form method="post" action="<?php echo base_url('admin/dashboard/changepassword');?>">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputPassword1">Current Password</label>
                    <input type="password" class="form-control" name="currentPassword" id="exampleInputPassword1" placeholder="Enter Current Password">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">New Password</label>
                    <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="New Password">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Confirm New Password</label>
                    <input type="password" class="form-control" name="cpassword" id="exampleInputPassword1" placeholder="confirm New Password">
                  </div>
                  <div class="form-check">
                  <?php if($this->session->userdata('error')){?>
                <p class="text-danger"><?=$this->session->userdata('error')?></p>
              <?php } ?>
              <p class="text-danger"><?php echo validation_errors();?></p>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
        </div>
        </div>
    
      </div>
    </section>

  </div>

<?php $this->load->view('include/footer')?>