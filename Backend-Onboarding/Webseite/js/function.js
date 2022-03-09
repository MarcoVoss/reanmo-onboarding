function test(id) {
    var image = document.getElementById('faq_img_' + id);
    var container = document.getElementById('faq_container_' + id);
    var content = document.getElementById('faq_content_' + id);
    if (image.src.includes('plus')) {
        image.src = 'img/minus.png';
        container.style.backgroundColor = 'white';
        content.style.display = 'block';
        container.style.boxShadow = '0 0 6px #F2F2F7';
    } else {
        image.src = 'img/plus.png';
        container.style.backgroundColor = '#F2F2F7';
        content.style.display = 'none';
        container.style.boxShadow = 'none';
    }
}