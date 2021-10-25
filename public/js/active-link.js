$(function () {
  var url = url = new URL(window.location.href);
  var path = url.pathname;
  var menu_name = path.split('/')[2];
  if (!menu_name) {
    $('#link-home').addClass('active');
  }
  item_menu_active = '#link-' + menu_name;
  $(item_menu_active).addClass('active');

  if (item_menu_active == '#link-order') {
    sub_menu = item_menu_active + '_' + path.split('/')[3]
    $(sub_menu).addClass('active')
    $(item_menu_active).closest('li.nav-item').addClass('menu-open')
  }

  if (item_menu_active == '#link-config') {
    sub_menu = item_menu_active + '_' + path.split('/')[3]
    $(sub_menu).addClass('active')
    $(item_menu_active).closest('li.nav-item').addClass('menu-open')
  }
})