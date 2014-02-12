          <div class="hero-unit">
            <h1><?php echo SITE_BRAND; ?> TrackIt <small>Inventory and faults management</small></h1>
            <p style="margin-top:20px">Have you discovered a fault with a piece of equipment in or belonging to <?php echo SITE_BRAND; ?>? We're very sorry about that. Let us know the details below and we'll take a look.</p>
          </div>
          <div class="row-fluid">
            <div class="span4">
              <h2>Report a Fault</h2>
              <form role="form" method="post" action="ajax/add-fault.php">
                <div style="height:210px">
              	  <label>Location of Item</label>
              	  <select class="input-block-level" id="location">
<?php $locations = Item::getItems(NULL, TRUE); ?>
<option></option><?php foreach($locations as $location){ echo("<option value=\"".$location->getId()."\">".$location->getFriendlyName()."</option>"); } ?></select>
              	  <label>Name of Item</label>
<?php $items = Item::getItems(NULL, FALSE); ?>
              	  <select class="input-block-level" id="itemname" name="item"><option></option><?php foreach($items as $item){ echo("<option value=\"".$item->getId()."\">".$item->getFriendlyName()." (".(is_null($item->getReferenceId())?'':$item->getReferenceId()." - ").($item->getManufacturer()?$item->getManufacturer()->getName():'')." ".$item->getModel().")</option>"); } ?></select>
              	  <label>Fault</label>
              	  <textarea class="input-block-level" name="content"></textarea>
                </div>
                <div class="form-actions">
                  <button type="submit" class="btn btn-primary btn-block">Report Fault <i class="icon-wrench icon-white"></i></button>
                </div>
              </form>
            </div><!--/span-->
            <div class="span4">
              <h2>Your Reports</h2>
              <div style="height:210px">
                <p class="muted">You haven't reported any faults before.</p>
                <p><?php $fault = Faults::get_by_id(4);
                echo $fault->get_id(); ?></p>
              </div>
              <div class="form-actions">
                <a class="btn btn-info btn-block" href="#">View All <i class="icon-chevron-right icon-white"></i></a>
              </div>
            </div><!--/span-->
            <div class="span4">
              <h2>Your Faults</h2>
              <div style="height:210px">
                <p class="muted">You haven't been assigned any current faults to investigate.</p>
              </div>
              <div class="form-actions">
                <a class="btn btn-info btn-block" href="#">View All <i class="icon-chevron-right icon-white"></i></a>
              </div>
            </div><!--/span-->
          </div><!--/row-->