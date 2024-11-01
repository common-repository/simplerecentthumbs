=== SimpleRecentThumbs ===
Contributors: brokenlibrarian
Donate link: http://brokenlibrarian.org/tinyplugins/
Tags: widget, thumbnails, images
Requires at least: 3.3.1
Tested up to: 4.0
Stable tag: 1.0
License: Apache v2

== Description ==

SimpleRecentThumbs is a widget plugin that shows a list of thumbnails from recent posts with featured images, optionally filtered by a category. Other than setting up the widget details, no configuration is required.

The thumbnails are in a widget-standard unordered list. The widget CSS class is _widget_recent_thumbs_ and the thumbnail links are class _post_thumb_.

Leaving the category field empty will have the widget use thumbnails from all posts; posts without featured images will not be listed. Without a category specified, the "more" button option will do nothing.

Thumbnail size is as specified in the Media settings for WordPress.

SimpleRecentThumbs has no extra requirements and has been tested with the twentyten through twentyfourteen themes.

Development on this plugin has halted. Other developers should feel free to use the Apache-licensed code for their own projects.

http://brokenlibrarian.org/tinyplugins/  
brokenlibrarian@gmail.com  
09/28/14

== Installation ==

1. Upload the SimpleRecentThumbs folder to your _/wp-content/plugins/_ folder and activate it.
2. Add the widget to your sidebar and configure it.
3. Add CSS properties to adjust the widget and thumbnail appearance.

== Frequently Asked Questions ==

= I've changed the thumbnail size in the settings but they're still too big/too small. =

You may need to rebuild your thumbnails. The easiest way to do this is probably using this plugin:
https://wordpress.org/extend/plugins/regenerate-thumbnails/

= How can I make these thumbnails list horizontally instead of vertically? =

CSS similar to this should work:

`
.widget_recent_thumbs ul { list-style: none; }
.widget_recent_thumbs ul li { display: inline; }
`

== Screenshots ==

1. The widget in use on a standard WordPress theme
2. The widget configuration options

== Changelog ==

= 1.0 =
* Final version with WordPress v4.0 testing

= 0.7.1 =
* update for WordPress 3.8 compatibility testing

= 0.7 =
* update for WordPress 3.5 compatibility testing

= 0.6 =
* category field bug fix

= 0.5 =
* fix readme issues

= 0.4 =
* initial release

== Upgrade Notice ==

= 1.0 =
* Final version with WordPress v4.0 testing

= 0.7.1 =
* update for WordPress 3.8 compatibility testing

= 0.7 =
* update for WordPress 3.5 compatibility testing

= 0.6 =
* category field bug fix, recommended upgrade

= 0.5 =
* fix readme issues, optional update

= 0.4 =
* initial release

==License==

   Copyright 2014 Christian Wagner

   Licensed under the Apache License, Version 2.0 (the "License");
   you may not use this file except in compliance with the License.
   You may obtain a copy of the License at

       http://www.apache.org/licenses/LICENSE-2.0

   Unless required by applicable law or agreed to in writing, software
   distributed under the License is distributed on an "AS IS" BASIS,
   WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
   See the License for the specific language governing permissions and
   limitations under the License.