<script>
$(function(){

	$('#patRequired').change(function(){
		if($('#patRequired').prop('checked')){
			$('#patOptions').slideDown();
		} else {
			$('#patOptions').slideUp();
		}
	});
	$('#patDate').change(function(){
		var patDate = document.getElementById('patDate').valueAsDate;
		patDate.setFullYear(patDate.getFullYear() + 2);
		document.getElementById('patExpiry').valueAsDate = patDate;
	});

});
</script>
<style>

@media only screen and (max-width: 768px){
div.navbar, div.sidebar-nav { display:none; }
}

input[type="text"], input[type="number"], input[type="date"], select { display:block; width:100%; -moz-box-sizing: border-box; -webkit-box-sizing: border-box; box-sizing: border-box; height:auto; }

</style>
<h2>Add Equipment</h2>

<?php

if(isset($_POST['model'])){

	$item = new Item;

	/*$item->setParentItem($_POST['parentItem']);
	$item->setManufacturer($_POST['manufacturer']);
	$item->setModel($_POST['model']);
	$item->setRefernceId($_POST['referenceId']);
	$item->setSerial($_POST['serial']);
	$item->setDescription($_POST['description']);
	$item->setFriendlyName($_POST['description']);
	$item->setQuantity($_POST['manufacturer']);
	$item->setPatRequired(($_POST['patRequired']=='TRUE'?TRUE:FALSE));
	$item->setPatDate(DateTime::createFromFormat("Y-m-d",$_POST['patDate']));
	$item->setPatExpiry(DateTime::createFromFormat("Y-m-d",$_POST['patExpiry']));
	$item->setBookable($_POST['bookable']);
	$item->setAllowChildren(($_POST['allowChildren']=='TRUE'?TRUE:FALSE));

	$item->save();*/


	echo("<div class=\"alert alert-success\"><strong>Item Added</strong> You can continue adding more below.</div>");

}

?>
<form action="#" method="POST">

<!-- Location -->

<select name="parentItem">
	<option value="">Location</option>
	<?php $locations = Item::getItems(NULL, NULL, TRUE);
		foreach ($locations as $location){
			echo("<option value=\"".$location->getId()."\">".$location->getFriendlyName()."</option>");
		}
	?>
</select>

<!-- Manufacturer -->

<select name="manufacturer">
	<option value="">Manufacturer</option>
	<?php $manufacturers = Manufacturer::getAll();
		foreach ($manufacturers as $manufacturer){
			echo("<option value=\"".$manufacturer->getId()."\">".$manufacturer->getName()."</option>");
		}
	?>
</select>

<!-- Model -->

<input type="text" name="model" placeholder="Model" />

<!-- Reference ID -->

<input type="text" name="referenceId" placeholder="Reference ID" />

<!-- Serial -->

<input type="text" name="serial" placeholder="Serial Number" />

<!-- Description / Friendly Name -->

<input type="text" name="description" placeholder="Description" />

<!-- Quantity -->

<input type="number" name="quantity" placeholder="Quantity" />

<!-- Pat Required -->

<label class="checkbox"><input type="checkbox" name="patRequired" value="TRUE" id="patRequired" /> PAT Required</label>

<div id="patOptions" style="display:none">
<!-- Pat Date -->
<label for="patDate">PAT Date</label>
<input type="date" name="patDate" id="patDate" />

<!-- Auto Pat Expiry -->
<label for="patExpiry">Re-test Date</label>
<input type="date" readonly="readonly" name="patExpiry" id="patExpiry" />

</div>

<!-- Bookable -->

<label class="checkbox"><input type="checkbox" name="bookable" value="TRUE" id="bookable" /> Bookable Item</label>

<!-- Children -->

<label class="checkbox"><input type="checkbox" name="allowChildren" value="TRUE" id="allowChildren" /> Allow item to contain other items</label>

<!-- Photos -->
<hr />
<input type="file" name="image1" />
<input type="file" name="image2" />
<input type="file" name="image3" />
<input type="file" name="image4" />
<input type="file" name="image5" />
<!-- Save -->
<hr />
<button type="submit" class="btn">Save</button>
</form>