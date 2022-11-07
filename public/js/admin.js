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
  $('.title-hover').hover(
    function () {
      $(this).find('.item-hover').animate({
        opacity: 1,
      })
    },
    function () {
      $(this).find('.item-hover').animate({
        opacity: 0,
      })
    },
  )
  $('#alert').each(function () {
    $(this)
      .find('button')
      .on('click', function () {
        $(this).parent().remove()
      })
  })
})
