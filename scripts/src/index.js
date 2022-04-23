import jQuery from 'jquery'

import Router from './util/Router'
// Naming in camelCase is important for the router to match the route
import common from './routes/common'

// Load styles
import '../../_sass/main.scss'
/**
 * Populate Router instance with DOM routes
 * @type {Router} routes - An instance of our router
 */
const routes = new Router({
  /** All pages */
  common,
  /** About Us page, note the change from about-us to aboutUs. */
})

/** Load Events */
jQuery(document).ready(() => routes.loadEvents())
