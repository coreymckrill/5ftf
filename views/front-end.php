<?php // todo i18n ?>

<article class="5ftf">
	<section class="about">
		<h3>
			<?php _e( 'Five for the Future', 'wordpressdotorg' ); ?>
		</h3>

		<p>
			<?php _e( 'Many companies in the WordPress ecosystem choose to contribute 5% of their time back towards sustaining and improving the WordPress project. This helps to ensure that WordPress remains a vibrant platform to build a business on, and prevents a <a href="">tragedy of the commons</a>.', 'wordpressdotorg' ); ?>
			<?php // link to CTA page ?>
		</p>
	</section>

	<section class="people">
		<h3>
			<?php _e( "Thank you to all of the companies that participate in Five for the Future.", 'wordpressdotorg' ); ?>
		</h3>

		<?php /*
		// sort filter options
		// this should be js - backbone or react? react
		// in page or api? start in page, can iterate later to add infinite scroll or something
		*/ ?>

		<form>
			<label for="5ftf-search">
				<?php _e( 'Search:' ); ?>
			</label>

			<input type="text" id="5ftf-search" name="5ftf-search" />
		</form>

		<table>
			<thead>
				<tr>
					<td>
						Company
						<button class="5ftf-toggle-order">^</button>
					</td>
					<td>
						Total # Employees
						<span class="toggle-order"></span>
					</td>
					<td>
						# Employees Pledged
						<span class="toggle-order"></span>
					</td>
					<td>
						Hours Pledged per Week
						<span class="toggle-order"></span>
					</td>
					<td>
						Teams Contributing To
						<span class="toggle-order"></span>
					</td>
				</tr>
			</thead>

			<tbody id="5ftf-companies">
				<tr>
					<td colspan="5">
						<?php _e( 'Loading&hellip;' ); ?>
					</td>
				</tr>
			</tbody>

			<script id="tmpl-5ftf-companies" type="text/template">
				<# _.each( data, function( company ) { #>
					<tr class="company">
						<th>
							<a href="{{company.url}}">
								{{company.name}}
							</a>
						</th>

						<td>{{company.total_employees}}</td>
						<td>{{company.employees_pledged}}</td>
						<td>{{company.hours_per_week}}</td>
						<td>
							{{company.teams_contributing_to}}
							<!-- todo link to team p2 -->
						</td>
					</tr>
				<# } ) #>
			</script>
		</table>
	</section>

	<section class="join">
		<h3>Take the Next Step</h3>

		<p>Have a question? Ready to get started? Get in touch and we'll help you find where you're needed the most.</p>

		<?php // link to pledge form ?>
	</section>
</article>