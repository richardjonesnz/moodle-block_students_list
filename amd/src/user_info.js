// import Log from 'core/log';
export const get_info = () => {
    const buttons = document.querySelectorAll('.block_students_button');
    buttons.forEach(button => {
        button.addEventListener('click', () => {
            button.parentNode.classList.toggle('active');
        });
    });
};