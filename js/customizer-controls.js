/**
 * Scripts within the customizer controls window.
 *
 * Adds a warning to the Theme Layout Settings section.
 */

 (function() {
	wp.customize.bind( 'ready', function() {
		// Only show the navbar type setting when running Bootstrap 5.
		wp.customize.section( 'digitalclusteruri_theme_layout_options').notifications.add( 'example-warning', new wp.customize.Notification(
			'example-warning',
			{
				type: 'warning',
				message: 'You are currently using an digitalclusteruri child theme, which may override some of these settings.'
			}
		) );
	});
})();
