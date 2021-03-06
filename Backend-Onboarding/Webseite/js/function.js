function test(id) {
    var image = document.getElementById(id);
    var container = document.getElementById('faq_container_' + id);
    var content = document.getElementById('faq_content_' + id);
    if (image.src.includes('plus')) {
        image.src = 'img/minus.png';
        container.style.backgroundColor = 'white';
        container.style.boxShadow = '0 0 6px #F2F2F7';
        this.growDiv(id);
    } else {
        image.src = 'img/plus.png';
        container.style.backgroundColor = '#F2F2F7';
        container.style.boxShadow = 'none';
        growDiv(id);
    }
}

function menuClick() {
    var logo = document.getElementById('main-logo');
    var image = document.getElementById('menu-img');
    var content = document.getElementById('content');
    var navigation = document.getElementById('app-navigation');

    if (content.style.display != 'none') {
        content.style.display = 'none';
        navigation.style.display = 'flex';
        image.src = 'img/black-menu.png';
        logo.src = 'img/logo-reanmo-dark.png';
        document.body.style.backgroundImage = 'linear-gradient(to bottom, white, white)';
        document.querySelector('footer').style = 'display: none';
        navigation.classList.toggle('menuAnimation');
    } else {
        content.style.display = 'inline-block';
        navigation.style.display = 'none';
        image.src = 'img/white-menu.png';
        logo.src = 'img/logo-reanmo.png';
        document.body.style.backgroundImage = 'linear-gradient(to bottom, #001427, #001427), linear-gradient(to bottom, white, white)';
        document.querySelector('footer').style = 'display: block';
    }
}

function growDiv(id) {
    var growDiv = document.getElementById('faq_content_' + id);
    if (growDiv.clientHeight) {
        growDiv.style.height = 0;
    } else {
        var wrapper = document.querySelector('#measuringWrapper_' + id);
        growDiv.style.height = wrapper.clientHeight + "px";
    }
}