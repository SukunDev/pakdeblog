$(document).ready(function () {
  $('#primary-nav-button').on('click', function () {
    $('#primary-nav').animate(
      {
        height: 'toggle',
      },
      300,
    )
  })
  $('.article img').on('click', function () {
    var image = $(this).clone()
    $('#preview-image-show').append(image)
    $('#preview-image').show()
  })
  $('#back-image').on('click', function () {
    $('#preview-image-show').empty()
    $('#preview-image').hide()
  })
})
