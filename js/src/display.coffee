do ($ = jQuery) ->
	"use strict"
	$ ->
		# Add your JS here!

		# Accordion JS
		$('a[data-accordion-group]').each ->
			$myself = $(this).css 'display', 'block'
			my_group = $myself.data 'accordion-group'
			$my_content = $myself.next '.accordion-content'

			# Fix slide jitter by giving width
			$my_content.width( $my_content.parent().width() ).hide()

			$myself.click ->
				$("a[data-accordion-group=#{my_group}]").not($myself).trigger 'compact'

				if $myself.hasClass 'down'
					$myself.trigger 'compact'
				else
					$myself.trigger 'expand'

				return false
			.bind 'expand', ->
				$my_content.slideDown()
				$myself.addClass 'down'
			.bind 'compact', ->
				$my_content.slideUp()
				$myself.removeClass 'down'
