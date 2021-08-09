<div class="row no-gutters bg-light">
  <div class="col-lg-6 text-white showcase-img" style="background-image: url('<?php echo base_url('site_link'); ?>assets/frontend/img/bg-showcase-2.jpg');"></div>
  <div class="col-lg-6 my-auto showcase-text">
    <h2>Updated For Bootstrap 4</h2>
    <p class="lead mb-0" id="userDetails">

    </p>
  </div>
</div>
<script>
  getUser();
  async function getUser() {
    var site_link = "<?php echo url(''); ?>";
    var html = '<ul>';
    try {
      const response = await axios.get(site_link+'users/user_api');
      const users = response.data;
      Object.keys(users).forEach(key => {
        html = html+'<li>'+users[key].full_name+'=>'+users[key].username+'</li>';
      });
      html = html+'</ul>';
      document.getElementById('userDetails').innerHTML = html;
    } catch (error) {
      console.error(error);
    }
  }
</script>