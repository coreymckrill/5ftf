<article class="5ftf">
	<section class="about">
		<h3>
			<?php _e( 'Five for the Future', 'wordpressdotorg' ); ?>
		</h3>

		<p>
			<?php _e( 'Many freelancers and companies in the WordPress ecosystem choose to contribute 5% of their time back towards sustaining and improving the WordPress project. This helps to ensure that WordPress remains a vibrant platform to build a business on, and prevents a <a href="">tragedy of the commons</a>.', 'wordpressdotorg' ); ?>
		</p>
	</section>

	<section class="people">
		<h3>
			<?php _e( "Here's just a few of the many people giving back.", 'wordpressdotorg' ); ?>
		</h3>

		<?php foreach ( $contributors as $contributor ) : ?>
			<div class="contributor">
				<img src="<?php echo esc_url( $contributor['avatar'] ); ?>" />

				<div>
					<?php echo esc_html( $contributor['biography'] ); ?>
				</div>
			</div>
		<?php endforeach; ?>
	</section>

	<section class="join">
		<h3>Take the Next Step</h3>

		<p>Have a question? Ready to get started? Get in touch and we'll help you find where you're needed the most.</p>

		<form action="" method="POST">
			inputs for name
			hours per month
			wporg username
			bio
			company - pull form tax
			Skills - pull from tax
			or maybe just name & w.org username, then we contact them manually to discuss, and then they fill out backend form if approved?
		</form>
	</section>
</article>