import $ from 'jquery';
export const get_info = () => {
    const lis = document.getElementsByClassName('block_es6_unmarked');
    function alertList() {
        let e = event.target;
        if (e.classList.contains('block_es6_unmarked')) {
            e.classList.remove('block_es6_unmarked');
            e.classList.add('block_es6_marked');
            $('#myModal').modal('show');
        } else {
            e.classList.remove('block_es6_marked');
            e.classList.add('block_es6_unmarked');
        }
    }

    for (var li of lis) {
        li.addEventListener("click", alertList, false);
    }
};