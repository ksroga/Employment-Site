    <div class="footer">
      
    
            <div class="row">
                <div class="col-lg-12" >
                    &copy;  2017 - 2018 Sektor-IT.pl
                </div>
            </div>
        </div>
          

     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
      <!-- BOOTSTRAP SCRIPTS -->
    <script src=<?php echo assets_url().'admin/js/bootstrap.min.js'; ?>></script>
      <!-- CUSTOM SCRIPTS -->
    <script src=<?php echo assets_url().'admin/js/custom.js'; ?>></script>

    <script src="https://maps.googleapis.com/maps/api/js?sensor=false&libraries=places&types=(geocode)&key=AIzaSyD7VF-AV_KA5tRzga6RLAdk1hCGsIkbDQE"></script>
    <script src="<?php echo assets_url().'js/jquery.geocomplete.js'; ?>"></script>
    <script src="<?php echo assets_url(); ?>public/js/bootstrap-notify.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            <?php if($this->session->flashdata('alert')){ ?>
            $.notify({
                message: "<?php echo $this->session->flashdata('alert')['message'] ?>"
            },{
                offset: {
                    x: 50,
                    y: 60
                },
                type: "<?php echo $this->session->flashdata('alert')['type'] ?>"
            });
            <?php } ?>
        });
    </script>
    
   
</body>
</html>