import $ from 'jquery'

export default {
  init () {
    // JavaScript to be fired on all pages
    // All modal management has been moved to footer.php using vanilla JS
    // Only keep special functionality for scrolling and other features

    // Store a reference to this for use in callbacks
    const self = this

    // Initialize story content scrolling when modal opens - hook into vanilla JS modal system
    document.addEventListener('DOMContentLoaded', function () {
      if (document.querySelector('.ts-story-trigger')) {
        document.querySelector('.ts-story-trigger').addEventListener('click', function () {
          // Initialize story content scrolling when modal opens
          setTimeout(() => {
            self.initStoryScroll()
          }, 300)
        })
      }
    })

    // Initialize custom scroll functionality
    this.initCustomScroll()

    // Initialize scrolling for story modal
    this.initStoryScroll()
  },

  // Custom scroll functionality specifically for story modal with oval-shaped masking
  initStoryScroll () {
    const $content = $('#story-scroll-content')
    const $container = $content.closest('.scrollable-content')

    if (!$content.length) return

    console.log('Initializing story scroll for:', $content)

    // Variables to track scroll state
    let isScrolling = false
    let startY = 0
    let startScrollY = 0
    let scrollTop = 0
    let maxScroll = 0

    // Calculate dimensions and max scroll
    function updateScrollDimensions () {
      // Get content and container dimensions
      const contentHeight = $content.outerHeight()
      const containerHeight = 250 // Fixed container height to match CSS

      console.log('Scroll dimensions - Content height:', contentHeight, 'Container height:', containerHeight)

      // Only enable scrolling if content is taller than container
      if (contentHeight > containerHeight) {
        maxScroll = contentHeight - containerHeight
        $content.addClass('can-scroll')
        console.log('Content can scroll, maxScroll:', maxScroll)
        return true
      } else {
        maxScroll = 0
        $content.removeClass('can-scroll')
        console.log('Content does not need scrolling')
        return false
      }
    }

    // Initialize scroll dimensions
    if (!updateScrollDimensions()) return

    // Reset scroll position on initialization
    scrollTop = 0
    $content.css('transform', 'translateY(0)')

    // Mouse wheel scroll handler
    $container.on('wheel', function (e) {
      e.preventDefault()

      // Calculate new scroll position based on wheel delta
      const delta = e.originalEvent.deltaY || 0
      scrollTop = Math.max(0, Math.min(maxScroll, scrollTop + delta))

      // Apply the transformation
      $content.css('transform', `translateY(-${scrollTop}px)`)
      console.log('Wheel scroll - new position:', scrollTop)
    })

    // Touch/Mouse down handlers
    $container.on('mousedown touchstart', function (e) {
      isScrolling = true
      startY = e.type === 'touchstart' ? e.originalEvent.touches[0].clientY : e.clientY
      startScrollY = scrollTop

      e.preventDefault()
      console.log('Started scrolling at position:', startScrollY)
    })

    // Touch/Mouse move handlers
    $(document).on('mousemove touchmove', function (e) {
      if (!isScrolling) return

      const currentY = e.type === 'touchmove' ? e.originalEvent.touches[0].clientY : e.clientY
      const deltaY = startY - currentY

      // Calculate new scroll position
      scrollTop = Math.max(0, Math.min(maxScroll, startScrollY + deltaY))

      // Apply the transformation
      $content.css('transform', `translateY(-${scrollTop}px)`)

      // Prevent default only for touch to avoid scroll blocking
      if (e.type === 'touchmove') {
        e.preventDefault()
      }
    })

    // Touch/Mouse up handlers
    $(document).on('mouseup touchend', function () {
      if (isScrolling) {
        console.log('Ended scrolling at position:', scrollTop)
        isScrolling = false
      }
    })

    // Update dimensions on window resize
    $(window).on('resize', function () {
      scrollTop = 0
      $content.css('transform', 'translateY(0)')
      updateScrollDimensions()
    })

    // Add specific event when the Story modal opens
    $('.ts-story-trigger').off('click.storyScroll').on('click.storyScroll', function () {
      setTimeout(() => {
        console.log('Story modal opened, resetting scroll')
        scrollTop = 0
        $content.css('transform', 'translateY(0)')
        updateScrollDimensions()
      }, 500) // Slightly longer timeout to ensure modal is fully open
    })
  },

  initCustomScroll () {
    // Process all scrollable areas
    $('.scrollable').each(function () {
      const $scrollable = $(this)
      const $content = $scrollable.find('.scroll-content')
      const $indicator = $scrollable.find('.scroll-indicator')
      const $handle = $scrollable.find('.scroll-indicator-handle')

      // Function to initialize scrolling - we'll call this on modal open too
      function initScroll () {
        // Get actual content height (need to clone to get accurate measurement)
        const $clone = $content.clone()
          .css({
            position: 'absolute',
            visibility: 'hidden',
            height: 'auto',
            width: $content.width() + 'px',
            display: 'block'
          })
          .appendTo('body')

        const contentHeight = $clone.outerHeight()
        $clone.remove()

        const containerHeight = $scrollable.height()

        // Mark whether content actually needs scrolling
        if (contentHeight > containerHeight) {
          $content.addClass('overflowing')

          // Show scrollbar when there's content to scroll
          $indicator.addClass('active')

          // Set the height of the scrollbar handle proportional to the visible area
          const handleHeight = Math.max(30, (containerHeight / contentHeight) * containerHeight)
          $handle.css('height', handleHeight + 'px')

          // Variables for tracking scroll position
          let maxScroll = contentHeight - containerHeight
          let maxHandleScroll = containerHeight - handleHeight

          // Enable mouse wheel scrolling
          $scrollable.off('wheel').on('wheel', function (e) {
            e.preventDefault()

            // Calculate the new scroll position based on wheel delta
            const delta = e.originalEvent ? e.originalEvent.deltaY : e.deltaY || 0
            const currentTranslateY = getTranslateY($content[0])

            // Update scroll position (negative because we're moving content upward)
            let newTranslateY = currentTranslateY - delta
            newTranslateY = Math.max(-maxScroll, Math.min(0, newTranslateY))

            // Update content position
            $content.css('transform', `translateY(${newTranslateY}px)`)

            // Update handle position
            const handlePos = (-newTranslateY / maxScroll) * maxHandleScroll
            $handle.css('top', handlePos + 'px')
          })

          return {
            contentHeight,
            containerHeight,
            maxScroll,
            maxHandleScroll
          }
        } else {
          // Not enough content to scroll
          $content.removeClass('overflowing')
          $indicator.removeClass('active')
          $content.css('transform', 'translateY(0)')
          return null
        }
      }

      // Initialize scrolling
      const scrollData = initScroll()
      if (!scrollData) return // Exit if no scrolling needed

      // Variables for drag scrolling
      let isScrolling = false
      let startY = 0
      let startTranslateY = 0

      // Handle drag scrolling
      $handle.on('mousedown', function (e) {
        isScrolling = true
        startY = e.clientY
        startTranslateY = parseFloat($handle.css('top')) || 0

        // Prevent text selection during drag
        e.preventDefault()
      })

      // Add touch support for mobile devices
      $handle.on('touchstart', function (e) {
        isScrolling = true
        startY = e.originalEvent.touches[0].clientY
        startTranslateY = parseFloat($handle.css('top')) || 0

        // Prevent screen from scrolling
        e.preventDefault()
      })

      // Handle mouse movement while dragging
      $(document).on('mousemove', function (e) {
        if (!isScrolling) return

        const deltaY = e.clientY - startY
        let newHandlePos = startTranslateY + deltaY

        // Constrain handle position
        newHandlePos = Math.max(0, Math.min(scrollData.maxHandleScroll, newHandlePos))

        // Update handle position
        $handle.css('top', newHandlePos + 'px')

        // Update content position based on handle position
        const contentPos = -(newHandlePos / scrollData.maxHandleScroll) * scrollData.maxScroll
        $content.css('transform', `translateY(${contentPos}px)`)
      })

      // Add touch move handler for mobile
      $(document).on('touchmove', function (e) {
        if (!isScrolling) return

        const deltaY = e.originalEvent.touches[0].clientY - startY
        let newHandlePos = startTranslateY + deltaY

        // Constrain handle position
        newHandlePos = Math.max(0, Math.min(scrollData.maxHandleScroll, newHandlePos))

        // Update handle position
        $handle.css('top', newHandlePos + 'px')

        // Update content position based on handle position
        const contentPos = -(newHandlePos / scrollData.maxHandleScroll) * scrollData.maxScroll
        $content.css('transform', `translateY(${contentPos}px)`)

        // Prevent default touch behavior
        e.preventDefault()
      })

      // Stop scrolling when mouse is released
      $(document).on('mouseup touchend', function () {
        isScrolling = false
      })

      // Also reinitialize scrolling when modal is opened - using vanilla JS
      document.addEventListener('DOMContentLoaded', function () {
        if (document.querySelector('.ts-story-trigger')) {
          document.querySelector('.ts-story-trigger').addEventListener('click', function () {
            // Reset scroll position
            $content.css('transform', 'translateY(0)')
            $handle.css('top', '0')

            // Short delay to let modal animation complete
            setTimeout(() => {
              // Re-init scroll after modal is fully visible
              initScroll()
            }, 300)
          })
        }
      })

      // Reset scroll on window resize
      $(window).on('resize', function () {
        $content.css('transform', 'translateY(0)')
        $handle.css('top', '0')
        initScroll()
      })
    })
  },

  finalize () {
    // JavaScript to be fired on all pages, after page specific JS is fired

  }
}

// Helper function to get translateY value
function getTranslateY (element) {
  if (!element || !element.style || !element.style.transform) {
    return 0
  }
  const transform = element.style.transform || window.getComputedStyle(element).transform
  if (!transform || transform === 'none') {
    return 0
  }

  const matrix = transform.match(/matrix.*\((.+)\)/)
  if (matrix && matrix[1]) {
    const values = matrix[1].split(', ')
    // The 6th value (index 5) in the matrix is the translateY value
    return parseFloat(values[5] || 0)
  }
  return 0
}
