<?php

?>

<form action="" method="post">
	<fieldset>
		<legend><?php _e( 'Company Details', 'wporg' ); ?></legend>

		<div>
			<label for="5ftf-company-name">
				<?php _e( 'Company Name', 'wporg' ); ?>
				<input type="text" id="5ftf-company-name" name="company-name" required />
			</label>
		</div>

		<div>
			<label for="5ftf-company-url">
				<?php _e( 'Company URL', 'wporg' ); ?>
				<input type="url" id="5ftf-company-url" name="company-url" required />
			</label>
		</div>

		<div>
			<label for="5ftf-company-email">
				<?php _e( 'Company Email', 'wporg' ); ?>
				<input type="email" id="5ftf-company-email" name="company-email" required />
			</label>
		</div>

		<div>
			<label for="5ftf-company-phone">
				<?php _e( 'Company Phone Number', 'wporg' ); ?>
				<input type="text" id="5ftf-company-phone" name="company-phone" />
			</label>
		</div>

		<div>
			<label for="5ftf-company-total-employees">
				<?php _e( 'Total Employees', 'wporg' ); ?>
				<input type="number" id="5ftf-company-total-employees" name="company-total-employees" required />
			</label>
		</div>
	</fieldset>

	<fieldset>
		<legend><?php _e( 'Pledge Manager', 'wporg' ); ?></legend>

		<div>
			<label for="5ftf-contact-name">
				<?php _e( 'Name', 'wporg' ); ?>
				<input type="text" id="5ftf-contact-name" name="contact-name" required />
			</label>
		</div>

		<div>
			<label for="5ftf-contact-wporg-username">
				<?php _e( 'WordPress.org User Name', 'wporg' ); ?>
				<input type="text" id="5ftf-contact-wporg-username" name="contact-wporg-username" required />
			</label>
		</div>
	</fieldset>

	<fieldset>
		<legend><?php _e( 'Pledge', 'wporg' ); ?></legend>

		<div>
			<label for="5ftf-pledge-hours">
				<?php _e( 'Pledged Hours Per Week', 'wporg' ); ?>
				<input type="number" id="5ftf-pledge-hours" name="pledge-hours" required />
			</label>
		</div>

		<div>
			<?php
			printf(
				__( 'The company pledges that it meets the <a href="%s">expectations</a> of the Five For The Future program and that it will dedicate this amount of employee time per week to the WordPress project', 'wporg' ),
				esc_url( '#' )
			);
			?>
			<label>
				<input type="checkbox" id="5ftf-pledge-agreement" name="pledge-agreement" required />
				<?php _e( 'Yes', 'wporg' ); ?>
			</label>
		</div>
	</fieldset>

	<div>
		<input type="submit" id="5ftf-pledge-submit" name="pledge-submit" class="button button-primary" value="<?php esc_attr_e( 'Submit', 'wporg' ); ?>" />
	</div>
</form>
