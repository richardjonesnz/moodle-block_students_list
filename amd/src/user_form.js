export const init = name => {
    document.addEventListener('click', e => {
        const someNode = e.target.closest('.block_es6_header');
        if (someNode) {
            alert('Hello ' + name + ' you clicked');
        }
    });
};