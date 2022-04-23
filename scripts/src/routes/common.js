import $ from 'jquery'

export default {
  init () {
    // JavaScript to be fired on all pages
    // when the modal is opened autoplay it
    $('.contact-modal').click(function (e) {
      e.preventDefault()
      $('.contact-popup').addClass('is-active')
    })
    $('.close-modal, .modal-background').click(function () {
      $('.contact-popup').removeClass('is-active')
    })
  },
  finalize () {
    // JavaScript to be fired on all pages, after page specific JS is fired

  }
}
