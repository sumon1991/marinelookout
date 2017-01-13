    <div class="page-content">
<div id="form-layouts" class="row">
<div class="col-lg-12">
    <div style="background: transparent; border: 0; box-shadow: none !important" class="tab-content pan mtl mbn responsive">
            <div id="tab-form-actions" class="tab-pane fade active in">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-blue">
                            <div class="panel-heading">Student Details</div>
                            <div class="panel-body pan">
                               
                                <form action="#" class="form-horizontal">
                                <?php if(isset($paymentViewDetails) && count($paymentViewDetails))
                                 {                   
                                   
                                ?>
                                    <div class="form-body pal">
                                         <div class="form-group"><label for="inputUsername" class="col-md-3 control-label">Student Name</label>

                                            <div class="col-md-9">
                                                <div class="input-icon"><i class="fa fa-user"></i><input id="inputUsername" type="text"  class="form-control" value="<?php echo $paymentViewDetails[0]['firstname'].' '.$paymentViewDetails[0]['lastname'];?>" readonly/></div>
                                                 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-body pal">
                                         <div class="form-group"><label for="inputUsername" class="col-md-3 control-label">Email</label>

                                            <div class="col-md-9">
                                                <div><input id="inputUsername" type="text" class="form-control" value="<?php echo $paymentViewDetails[0]['email'];?>" readonly/></div>
                                                 
                                            </div>
                                        </div>
                                    </div>
                                                                        <div class="form-body pal">
                                         <div class="form-group"><label for="inputUsername" class="col-md-3 control-label">Mobile No</label>

                                            <div class="col-md-9">
                                                <div><input id="inputUsername" type="text"  class="form-control" value="<?php echo $paymentViewDetails[0]['mobile'];?>" readonly/></div>
                                                 
                                            </div>
                                        </div>
                                    </div>


                                    
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="panel panel-pink">
                            <div class="panel-heading">Payment details</div>
                            <div class="panel-body pan">
                                <form action="#" class="form-horizontal">
                                    <div class="form-actions top none-bg">
                                    </div>
                                    <div class="form-body pal">
                                        <div class="form-group"><label for="inputUsername" class="col-md-3 control-label">Oder No</label>

                                            <div class="col-md-9">
                                                <div><input id="inputUsername" type="text" class="form-control" value="<?php echo $paymentViewDetails[0]['order_no'];?>" readonly/></div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-body pal">
                                        <div class="form-group"><label for="inputUsername" class="col-md-3 control-label">Amount</label>

                                            <div class="col-md-9">
                                                <div><input id="inputUsername" type="text"  class="form-control" value="<?php echo $paymentViewDetails[0]['amount'];?>" readonly/></div>
                                            </div>
                                        </div>

                                    </div>
                                     <div class="form-body pal">
                                        <div class="form-group"><label for="inputUsername" class="col-md-3 control-label">Order Status</label>

                                            <div class="col-md-9">
                                                <div><input id="inputUsername" type="text"  class="form-control" value="<?php
			     if($paymentViewDetails[0]['order_status'] == 'success')
				 echo 'Success';
			     elseif($paymentViewDetails[0]['order_status'] == 'initiated')
				 echo 'Failed';
			     else
				 echo ucfirst($paymentViewDetails[0]['order_status']);
			     ?>" readonly/></div>
                                            </div>
                                        </div>

                                    </div>
                                     <div class="form-body pal">
                                        <div class="form-group"><label for="inputUsername" class="col-md-3 control-label">Payment Mode</label>

                                            <div class="col-md-9">
                                                <div><input id="inputUsername" type="text" class="form-control" value="<?php echo $paymentViewDetails[0]['payment_mode'];?>" readonly/></div>
                                            </div>
                                        </div>

                                    </div>
                                     <div class="form-body pal">
                                        <div class="form-group"><label for="inputUsername" class="col-md-3 control-label">Card Type</label>

                                            <div class="col-md-9">
                                                <div><input id="inputUsername" type="text"  class="form-control" value="<?php echo $paymentViewDetails[0]['card_type'];?>" readonly/></div>
                                            </div>
                                    </div>

                                    </div>

                                    <div class="form-body pal">
                                        <div class="form-group"><label for="inputUsername" class="col-md-3 control-label">Message</label>

                                            <div class="col-md-9">
                                                <div><input id="inputUsername" type="text"  class="form-control" value="<?php echo $paymentViewDetails[0]['message'];?>" readonly/></div>
                                            </div>
                                    </div>

                                    </div>


                                </form>
                            </div>
                        </div>
                    </div>
                                            <div class="col-lg-12">
                        <div class="panel panel-pink">
                            <div class="panel-heading">Billing details</div>
                            <div class="panel-body pan">
                                <form action="#" class="form-horizontal">
                                    <div class="form-actions top none-bg">
                                    </div>
                                    <div class="form-body pal">
                                        <div class="form-group"><label for="inputUsername" class="col-md-3 control-label">Billing Name </label>

                                            <div class="col-md-9">
                                                <div><input id="inputUsername" type="text"  class="form-control" value="<?php echo $paymentViewDetails[0]['billing_name'];?>" readonly/></div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-body pal">
                                        <div class="form-group"><label for="inputUsername" class="col-md-3 control-label">Billing Address</label>

                                            <div class="col-md-9">
                                                <div><input id="inputUsername" type="text"  class="form-control" value="<?php echo $paymentViewDetails[0]['billing_address'];?>" readonly/></div>
                                            </div>
                                        </div>

                                    </div>
                                     <div class="form-body pal">
                                        <div class="form-group"><label for="inputUsername" class="col-md-3 control-label">Billing City</label>

                                            <div class="col-md-9">
                                                <div><input id="inputUsername" type="text" class="form-control" value="<?php echo $paymentViewDetails[0]['billing_city'];?>" readonly/></div>
                                            </div>
                                        </div>

                                    </div>
                                      <div class="form-body pal">
                                        <div class="form-group"><label for="inputUsername" class="col-md-3 control-label">Billing State</label>

                                            <div class="col-md-9">
                                                <div></i><input id="inputUsername" type="text"class="form-control" value="<?php echo $paymentViewDetails[0]['billing_state'];?>" readonly/></div>
                                            </div>
                                        </div>

                                    </div>
                                                                           <div class="form-body pal">
                                        <div class="form-group"><label for="inputUsername" class="col-md-3 control-label">Billing Zip</label>

                                            <div class="col-md-9">
                                                <div><input id="inputUsername" type="text" class="form-control" value="<?php echo $paymentViewDetails[0]['billing_zip'];?>" readonly/></div>
                                            </div>
                                        </div>

                                    </div>


                                     <div class="form-body pal">
                                        <div class="form-group"><label for="inputUsername" class="col-md-3 control-label">Billing Country</label>

                                            <div class="col-md-9">
                                                <div><input id="inputUsername" type="text" class="form-control" value="<?php echo $paymentViewDetails[0]['billing_country'];?>" readonly/></div>
                                            </div>
                                        </div>

                                    </div>
                                     <div class="form-body pal">
                                        <div class="form-group"><label for="inputUsername" class="col-md-3 control-label">Billing Tel</label>

                                            <div class="col-md-9">
                                                <div><input id="inputUsername" type="text" class="form-control" value="<?php echo $paymentViewDetails[0]['billing_tel'];?>" readonly/></div>
                                            </div>
                                        </div>

                                    </div>
                                     <div class="form-body pal">
                                        <div class="form-group"><label for="inputUsername" class="col-md-3 control-label">Billing Email</label>

                                            <div class="col-md-9">
                                                <div><input id="inputUsername" type="text"  class="form-control" value="<?php echo $paymentViewDetails[0]['billing_email'];?>" readonly/></div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-body pal">
                                        <div class="form-group"><label for="inputUsername" class="col-md-3 control-label">paid On</label>

                                            <div class="col-md-9">
                                                <div><input id="inputUsername" type="text" class="form-control" value="<?php echo $paymentViewDetails[0]['paid_on'];?>" readonly/></div>
                                            </div>
                                        </div>

                                    </div>


                                    <div class="form-actions none-bg">
                                        <div class="col-md-offset-3 col-md-9">
                                           <a href="<?php echo BACKEND_URL;?>payment/index/" style="padding-right: 33px;padding-bottom: 10px;" class="btn btn-success"><i class="fa fa-arrow-circle-o-left mrx"></i>Back to List</a>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        </div>
    </div>
