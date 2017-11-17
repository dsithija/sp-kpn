jQuery( window ).load(function() {
    jQuery( '#td-header-search' ).unbind('keydown');
    jQuery('#td-header-search-mob').unbind('keydown');
    // keydown on the text box
    jQuery( '#td-header-search' ).keydown(function(event) {
        if (
            ( event.which && 39 === event.which ) ||
            ( event.keyCode && 39 === event.keyCode ) ||
            ( event.which && 37 === event.which ) ||
            ( event.keyCode && 37 === event.keyCode ) )
        {
            //do nothing on left and right arrows
            tdAjaxSearch.td_aj_search_input_focus();
            return;
        }

        if ( ( event.which && 13 === event.which ) || ( event.keyCode && 13 === event.keyCode ) ) {
            // on enter
            var td_aj_cur_element = jQuery('.td-aj-cur-element');
            if (td_aj_cur_element.length > 0) {
                //alert('ra');
                var td_go_to_url = td_aj_cur_element.find('.entry-title a').attr('href');
                window.location = td_go_to_url;
            } else {
                jQuery(this).parent().parent().submit();
            }
            return false; //redirect for search on enter

        } else if ( ( event.which && 40 === event.which ) || ( event.keyCode && 40 === event.keyCode ) ) {
            // down
            tdAjaxSearch.move_prompt_down();
            return false; //disable the envent

        } else if ( ( event.which && 38 === event.which ) || ( event.keyCode && 38 === event.keyCode ) ) {
            //up
            tdAjaxSearch.move_prompt_up();
            return false; //disable the envent

        } else {
            //for backspace we have to check if the search query is empty and if so, clear the list
            if ( ( event.which && 8 === event.which ) || ( event.keyCode && 8 === event.keyCode ) ) {
                //if we have just one character left, that means it will be deleted now and we also have to clear the search results list
                var search_query = jQuery(this).val();
                if ( 1 === search_query.length ) {
                    jQuery('#td-aj-search').empty();
                }
            }

            //various keys
            tdAjaxSearch.td_aj_search_input_focus();

            if(jQuery( '#td-header-search' ).val().length > 3){
                setTimeout(function(){
                    tdAjaxSearch.do_ajax_call();
                }, 100);
            }
        }
        event.stopPropagation();
        return;
    });

    // keydown on the text box
    jQuery('#td-header-search-mob').keydown(function(event) {

        if ( ( event.which && 13 === event.which ) || ( event.keyCode && 13 === event.keyCode ) ) {
            // on enter
            var td_aj_cur_element = jQuery('.td-aj-cur-element');
            if (td_aj_cur_element.length > 0) {
                //alert('ra');
                var td_go_to_url = td_aj_cur_element.find( '.entry-title a' ).attr( 'href' );
                window.location = td_go_to_url;
            } else {
                jQuery(this).parent().parent().submit();
            }
            return false; //redirect for search on enter
        } else {

            //for backspace we have to check if the search query is empty and if so, clear the list
            if ( ( event.which && 8 === event.which ) || ( event.keyCode && 8 === event.keyCode ) ) {
                //if we have just one character left, that means it will be deleted now and we also have to clear the search results list
                var search_query = jQuery(this).val();
                if ( 1 === search_query.length ) {
                    jQuery('#td-aj-search-mob').empty();
                }
            }
            if(jQuery( '#td-header-search' ).val().length > 3) {
                setTimeout(function () {
                    tdAjaxSearch.do_ajax_call_mob();
                }, 100);
            }

            return true;
        }
    });
});

