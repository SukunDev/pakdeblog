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
  $('#tambahButtonKategori').on('click', function () {
    $('#kategoriPanel').animate(
      {
        height: 'toggle',
      },
      300,
    )
  })
  $('#sticky-header-menu-button').on('click', function () {
    var sidebar = $('#sidebar')
    $('#sidebar-background-black').animate({ opacity: 'toggle' }, 300)
    if (sidebar.hasClass('-translate-x-full')) {
      sidebar.removeClass('-translate-x-full')
      return
    }
  })
  $('#sidebar-background-black').on('click', function () {
    $(this).animate({ opacity: 'toggle' }, 300)
    var sidebar = $('#sidebar')
    if (!sidebar.hasClass('-translate-x-full')) {
      sidebar.addClass('-translate-x-full')
      return
    }
  })
  $('#profile-button').on('click', function () {
    $('#profile-panel').animate(
      {
        height: 'toggle',
      },
      300,
    )
  })
})
