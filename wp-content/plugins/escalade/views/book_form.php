<?php
$location = get_terms( array(
    'taxonomy' => 'location_category',
    'hide_empty' => false,
));
$arr_guest = array(1,2,3,4,5,6,7,8,9,10);

$id_location = isset($_GET['id_location']) ? $_GET['id_location'] : '';
$arrival = isset($_GET['arrival']) ? $_GET['arrival'] : '';
$departure = isset($_GET['departure']) ? $_GET['departure'] : '';
$guest = isset($_GET['guest']) ? $_GET['guest'] : '';
?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
    $(function () {
        $('.datepicker').datepicker();
    });
</script>
<form action="/check" method="GET">
<div class="row form-group" id="booking-form">
	<div class="col-md-4">
		<select name="id_location" id="id_location" class="form-control">
			<option value="">Location</option>
			<?php
			if($location){
				foreach($location as $local){
					echo '<option value="'.$local->term_id.'"'.($id_location == $local->term_id ? ' selected' : '').'>'.$local->name.'</option>';
				}
			}
			?>
		</select>
	</div>
	<div class="col-md-2">
		<input type="text" name="arrival" id="arrival" value="<?php echo $arrival; ?>" placeholder="Arrival" required class="form-control datepicker" data-date-format="mm/dd/yyyy">
	</div>
	<div class="col-md-2">
		<input type="text" placeholder="Departure" value="<?php echo $departure; ?>" required name="departure" id="departure" class="form-control datepicker">
	</div>
	<div class="col-md-2">
		<select name="guest" id="guest" class="form-control">
			<option value="">Guest</option>
			<?php
			if($arr_guest){
				foreach($arr_guest as $g){
					echo '<option value="'.$g.'"'.($g==$guest ? ' selected' : '').'>'.$g.'</option>';
				}
			}
			?>
		</select>
	</div>
	<div class="col-md-2">
		<button type="submit" name="checkAccommodation" id="checkAccommodation">Check Avaibility</button>
	</div>
</div>
</form>