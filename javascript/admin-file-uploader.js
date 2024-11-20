/**
 * File uploader for WP admin interface.
 *
 * @package WordPress
 * @subpackage Random Theme
 * @since Random Theme 1.0.0
 */

jQuery( function($) {

	// On upload button click
	$( 'body' ).on( 'click', '.file-upload', function( event ) {

		// Prevent default link click and page refresh
		event.preventDefault();

		const button = $(this);
		const imageId = button.next().next().val();
		const customUploader = wp.media({
			// Modal window title
			title: 'Save image',
			library : {
				type : 'image'
			},
			button: {
				// Button label text
				text: 'Use this image'
			},
			multiple: false
		}).on( 'select', function() {
			// It also has "open" and "close" events
			const attachment = customUploader.state().get( 'selection' ).first().toJSON();
			// Add image instead of "Nahrať obrázok"
			button.removeClass( 'button' ).html( '<img style="height: 3rem;" src="' + attachment.url + '">' );
			// Show "Vymazať obrázok" link
			button.next().show();
			// Populate the hidden field with image ID
			button.next().next().val( attachment.id );
			// Populate the hidden field with image name
			button.next().next().next().val( /[^/]*$/.exec( attachment.url )[0] );
		})

		// Already selected images
		customUploader.on( 'open', function() {

			if ( imageId ) {
			  const selection = customUploader.state().get( 'selection' )
			  attachment = wp.media.attachment( imageId );
			  attachment.fetch();
			  selection.add( attachment ? [attachment] : [] );
			}

		})

		customUploader.open()

	});

	// on remove button click
	$( 'body' ).on( 'click', '.file-remove', function( event ) {

		event.preventDefault();
		const button = $(this);
		// Emptying the hidden fields
		button.next().val( '' );
		button.next().next().val( '' );
		// Replace the image with text
		button.hide().prev().addClass( 'button' ).html( 'Save image' );

	});

});