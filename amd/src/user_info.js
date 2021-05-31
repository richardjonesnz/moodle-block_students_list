import Log from 'core/log';
export const get_info = () => {

    const buttons = document.querySelectorAll('.block_students_button');
    //const additional = document.getElementsByClassName('block_students_additional');

    buttons.forEach(button => {
        button.addEventListener('click', () => {
            Log.info(button);
            button.parentNode.classList.toggle('active');
        });
    });
};