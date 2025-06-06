$(document).ready(function(){
    $('.slick-slider').slick({
        dots: false,
        arrows: false,
        autoplay: true,
        autoplaySpeed: 3000
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const header = document.querySelector('.header_section');
    window.addEventListener('scroll', function () {
        if (window.scrollY > 10) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    });
    function animateOnScroll(selector) {
        const el = document.querySelector(selector);
        if (!el) return;
        function onScroll() {
            const rect = el.getBoundingClientRect();
            if (rect.top < window.innerHeight - 100) {
                el.classList.add('show');
                window.removeEventListener('scroll', onScroll);
            }
        }
        window.addEventListener('scroll', onScroll);
        onScroll();
    }
    animateOnScroll('.under-best');
    animateOnScroll('.brand');
    animateOnScroll('.home-decor');
});

if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
        var lat = position.coords.latitude;
        var lng = position.coords.longitude;
        var key = "AIzaSyA0s1a7phLN0iaD6-UE7m4qP-z21pH0eSc";
        var src = `https://www.google.com/maps/embed/v1/view?key=${key}&center=${lat},${lng}&zoom=15`;
        document.getElementById('mapFrame').src = src;
    });
}

function changeQty(btn, delta) {
    const input = btn.parentElement.querySelector('input[type="number"]');
    let val = parseInt(input.value) + delta;
    if (val < 1) val = 1;
    input.value = val;
}

function changeQty(btn, delta) {
    const input = btn.parentElement.querySelector('input[name="quantity"]');
    let val = parseInt(input.value) + delta;
    if (val < 1) val = 1;
    input.value = val;
    // Đồng bộ số lượng cho form "Mua ngay"
    document.getElementById('buy-now-qty').value = val;
}

function syncBuyNowQty() {
    // Lấy số lượng hiện tại từ input chính và gán cho input ẩn của form "Mua ngay"
    var qty = document.querySelector('.add-cart-form input[name="quantity"]').value;
    document.getElementById('buy-now-qty').value = qty;
}

function toggleSearchSidebar() {
    var sidebar = document.getElementById('searchSidebar');
    if (sidebar.classList.contains('hide')) {
        sidebar.classList.remove('hide');
        sidebar.classList.add('show');
        setTimeout(() => {
            sidebar.querySelector('input[name="search"]').focus();
        }, 300);
    } else {
        sidebar.classList.remove('show');
        sidebar.classList.add('hide');
    }
}

function toggleCartSidebar() {
    var sidebar = document.getElementById('cartSidebar');
    if (sidebar.classList.contains('hide')) {
        sidebar.classList.remove('hide');
        sidebar.classList.add('show');
    } else {
        sidebar.classList.remove('show');
        sidebar.classList.add('hide');
    }
}
// Đóng khi click ra ngoài vùng content
document.addEventListener('click', function(e) {
    var sidebar = document.getElementById('cartSidebar');
    if (sidebar && sidebar.classList.contains('show') && !sidebar.querySelector('.cart-sidebar-content').contains(e.target) && !e.target.closest('.cart .icon')) {
        toggleCartSidebar();
    }
});