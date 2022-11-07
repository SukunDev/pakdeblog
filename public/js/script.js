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
  if (
    typeof inline_related_post !== 'undefined' &&
    inline_related_post.length > 0
  ) {
    addInlineRelatedPost(inline_related_post)
  }
})
function addInlineRelatedPost(post) {
  var paragraph = $('.article p')
  $.each(paragraph, function (idx, item) {
    if (idx == paragraph.length - 3) {
      $(
        '<div id="inline-related-post" class="not-prose"><p>Baca Juga : <a class="hover:text-blue-500 font-normal transition duration-300" href="/' +
          post[0].slug +
          '">' +
          post[0].title +
          '</a></p></div>',
      ).insertAfter(item)
    }
    if (post.length > 1) {
      if (paragraph.length > 6) {
        if (idx == 1) {
          $(
            '<div id="inline-related-post" class="not-prose"><p>Baca Juga : <a class="hover:text-blue-500 font-normal transition duration-300" href="/' +
              post[1].slug +
              '">' +
              post[1].title +
              '</a></p></div>',
          ).insertAfter(item)
        }
      }
    }
  })
}
