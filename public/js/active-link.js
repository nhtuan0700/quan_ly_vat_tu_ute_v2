$(function () {
  var url = url = new URL(window.location.href);
  var path = url.pathname;
  var menu_name = path.split('/')[1];
  var list_vattu = ['van-phong-pham', 'thiet-bi'];

  if (!menu_name) {
    $('#link-home').addClass('active');
    return;
  }
  item_menu_active = '#link-' + menu_name;
  $(item_menu_active).addClass('active');

  if (list_vattu.includes(menu_name)) {
    $('#link-vat-tu').addClass('active');
    $('#link-vat-tu').closest('li.nav-item').addClass('menu-open');
  }
})