<?php
$location = get_terms( array(
    'taxonomy' => 'location_category',
    'hide_empty' => false,
));
//var_dump($location);
?>
<div class="booking-form">
<h2>SET UP YOUR HOLIDAYS</h2>
<form>
	<div class="row">
		<div class="location">
			<select name="id_location" id="id_location" class="form-control">
				<option value="">Location</option>
				<?php
				if($location){
					foreach($location as $local){
						echo '<option value="'.$local->term_id.'">'.$local->name.'</option>';
					}
				}
				?>
			</select>
		</div>
		<div class="date">
			<input type="text" name="arrival" id="arrival" placeholder="Arrival" required class="form-control">
		</div>
		<div class="date">
			<input type="text" placeholder="Departure" required name="departure" id="departure" class="form-control">
		</div>
		<div class="guest">
			<select name="guest" id="guest" class="form-control">
				<option value="">Guest</option>
			</select>
		</div>
		<div class="submit">
			<button type="submit" name="checkAvailibilty">Check Avaibility</button>
		</div>
	</div>
</form>
</div>