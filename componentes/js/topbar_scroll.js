window.addEventListener('scroll', function() {
const topbar = document.getElementById('topbar');
if (window.scrollY > 0) {
    topbar.classList.add('rdm-topbar--small-container-scrolled');
} else {
    topbar.classList.remove('rdm-topbar--small-container-scrolled');
}
});