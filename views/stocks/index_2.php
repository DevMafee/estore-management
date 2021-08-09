<section class="content">
	<div class="container-fluid">
	    <div class="row clearfix">
            <div class="col-12 col-lg-12 col-xl-12">
              <div class="card">
              	<div class="header">
              		<span class="h4 mt-2"><?php echo $_SESSION['STOCK_REPORT']; ?></span>
              	</div>
                <div class="body">
                  <table class="table datatable table-hover">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col"><?php echo $_SESSION['PRODUCTS']; ?></th>
                        <th scope="col"><?php echo $_SESSION['OPENING']; ?></th>
                        <th scope="col"><?php echo $_SESSION['STOCK_IN']; ?></th>
                        <th scope="col"><?php echo $_SESSION['STOCK_OUT']; ?></th>
                        <th scope="col"><?php echo $_SESSION['IN_STOCK']; ?></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                      $i=0;
                      foreach($data as $head){
                    ?>
                      <tr>
                      	<td><?php echo ++$i; ?></td>
                      	<td><?php echo $head['name']; ?></td>
                        <td><?php echo $head['opening']; ?></td>
                        <td><?php echo $head['in']; ?></td>
                        <td><?php echo $head['out']; ?></td>
                        <td><?php echo $head['closing']; ?></td>
                      </tr>
                    <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
        </div>
    </div>
</section>