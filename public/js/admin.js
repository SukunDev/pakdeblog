$(document).ready(function () {
  $('.dropdown-button').on('click', function () {
    var dropdownItem = $(this).parent().find('.dropdown-item')
    if (dropdownItem.css('display') == 'none') {
      $(this).find('#dropdownArrow').addClass('flip')
    } else {
      $(this).find('#dropdownArrow').removeClass('flip')
    }
    dropdownItem.animate(
      {
        height: 'toggle',
      },
      300,
    )
  })
})
