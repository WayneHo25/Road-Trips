( function( api ) {

	// Extends our custom "customizable-blogily" section.
	api.sectionConstructor['customizable-blogily'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );
