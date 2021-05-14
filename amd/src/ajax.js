import $ from 'jquery';
import Ajax from 'core/ajax';
import log from 'core/log';
import Notification from 'core/notification';

export const ajax_example = () => {
    log.debug("Block ES6 AJAX Example");
    $(document).ready(function() {
        log.debug('Block ES6 AJAX Example AMD document ready');
        $('#ajaxbtn').click(function() {
            var thetext = $('#ajaxthetext').val();
            Ajax.call([{
                methodname: 'block_es6_ajax_example',
                args: {
                    'text': thetext
                },
            }])[0].done(function(response) {
                log.debug(response.markup);
                // We have the data now update the UI.
                $('#ajaxresult').html(response.markup);
            }).fail(function() {
                Notification.exception(new Error('Failed to get markup'));
                return;
            });
        });
    });
};
