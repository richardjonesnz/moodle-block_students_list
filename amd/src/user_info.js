import templates from 'core/templates';
import log from 'core/log';

export const get_info = () => {
    const lis = document.getElementsByClassName('block_modals_unmarked');
    const modal = document.getElementById('block_modals_myModal');
    const span = document.getElementsByClassName('block_modals_close')[0];

    span.onclick = function() {
        modal.style.display = "none";
    };

    for (let li of lis) {
        li.onclick = function() {
            var context = {student: '>' + li.innerHTML};
            log.info('>' + li.innerHTML);
            templates.render('block_modals/course_users', context);
            modal.style.display = "block";
        };
    }
};