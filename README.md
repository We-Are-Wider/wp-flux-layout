# WP Flux Layout
Creatives don't like being dictated to or told how many columns their layout has to have or having a whole bunch of other junk CSS that you have to load and overload. Flux layout is a fully dynamic responsive layout system with extensive built-in media queries and logically named CSS classes.

This plugin adds the Flux Layout responsive CSS framework to your WordPress site - any columns, and setup - and tiny... under 6k gzipped!. Change on the fly on a per view basis by filtering values or create and minify your own static CSS file... it's the responsive layout system built to be as flexible as possible!

### How it works

2 files are included (enqueued in WordPress) once the plugin is activated:
* wf-css-flux-layout-core.css - basic rules and reset (static file)
* wf-css-flux-layout.php - dynamic generated CSS layout rules (dynamic file - generated from URL query string parameters)

Configure the options through the WordPress Customizer (View website -> Top Admin Bar -> Customize).

Stand-alone version (to be used with any non-Wonderflux theme) includes the following options:
* Number of verstical columns
* Main content width
* Main container position
* Sidebar poisition

If you are using [Wonderflux](http://wonderflux.com) and have created your own child theme you get A-LOT more options:
* Number of verstical columns
* Main content width
* Main container position
* Content width
* Sidebar width
* Sidebar position
* Sidebar/main content responsive breakpoint for full width
* Sidebar display
* Media content width
* Hide Wonderflux page templates
* Document type
* Document language

### Documentation/demo

Visit the [Flux Layout project on GitHub](https://github.com/Jonnyauk/flux-layout) for more information, or view the [standalone demo](http://fluxlayout.com).

Flux Layout is included in the [free, Open Source Wonderflux theme framework](https://github.com/Jonnyauk/Wonderflux) - Visit the Github project page for more information.

**WARNING - Working in progress!!** This is still in development and works to a certain extent. Not all Wonderflux options have been ported across yet, but it seems to be working pretty well at this point ;) When it is ready for release, it be made available through the wordpress.org plugin repo.