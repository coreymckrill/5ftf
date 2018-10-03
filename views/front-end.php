<article class="5ftf">
	<section class="about">
		<h3>
			<?php _e( 'Five for the Future', 'wordpressdotorg' ); ?>
		</h3>

		<p>
			<?php _e( 'Many companies in the WordPress ecosystem choose to contribute 5% of their time back towards sustaining and improving the WordPress project. This helps to ensure that WordPress remains a vibrant platform to build a business on, and prevents a <a href="">tragedy of the commons</a>.', 'wordpressdotorg' ); ?>
			// link to CTA page
		</p>
	</section>

	<section class="people">
		<h3>
			<?php _e( "Thank you to all of the companies that participate in Five for the Future.", 'wordpressdotorg' ); ?>
		</h3>

		// sort filter options
		// this should be js - backbone or react? react
		// in page or api? start in page, can iterate later to add infinite scroll or something

		<table>
			<thead>
				<tr>
					<td>Company</td>
					<td>Total # Employees</td>
					<td># Employees Pledged</td>
					<td>Hours Pledged per Week</td>
					<td>Teams Contributing To</td>
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
				<# _.each( data.companies, function( company ) { #>
					<tr class="company">
						<th>
							<a href="{{company.url}}">
								{{company.post_title}}
							</a>
						</th>

						<td>{{company.total_employees}}</td>
						<td>{{company.employees_pledged}}</td>
						<td>{{company.hours_per_week}}</td>
						<td>{{company.teams_contributing_to}}</td>
					</tr>
				<# } ) #>
			</script>
		</table>
	</section>

	<section class="join">
		<h3>Take the Next Step</h3>

		<p>Have a question? Ready to get started? Get in touch and we'll help you find where you're needed the most.</p>

		// link to pledge form
	</section>
</article>