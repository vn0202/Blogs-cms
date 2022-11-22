$(document).ready(function () {

    //handle hide main menu when click outer
    document.addEventListener('click', function handleClickOutsideBox(event) {
        // 👇️ the element the user clicked
        const box = document.getElementById('main-menu');
        const choose_btn = document.getElementById('choose-list');
        if (!box.contains(event.target) && !choose_btn.contains(event.target)) {
            box.style.display = 'none';
        }
    });
    $('#choose-list').click(function () {
        $('.main-menu').css('display','inline-block');
    })

    $('.menu-item').mousemove(function () {
        let id = $(this).attr('data-id');
        $(`.sub-menu-${id}`).css('display', 'block')
    })
    $('.menu-item').mouseout(function () {
        let id = $(this).attr('data-id');
        $(`.sub-menu-${id}`).css('display', 'none')
    })
    $('.menu-item').click(function (e){
        e.stopPropagation();
        let title = $(this).attr('data-value');
        let id = $(this).attr('data-id');
        $('#choose-list').text(title);
        $('#category').val(id);
        console.log($('#category').val())
        $('.main-menu').css('display','none');
    })


})
