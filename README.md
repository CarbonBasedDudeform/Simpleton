Simpleton
=========

A simple, minimalistic RSS reader built in PHP with jQuery.
Allows a user to add RSS feeds and then select them from the left hand side menu. Doesn't keep track of read entries ir how many new entries there are, 
doesn't suggest items etc. simply displays the rss feeds.

Future Plans
============

Some simple ideas for future:
-proper accounts
-better handling of errors
-ensuring it's not vulnerable to XSS and other exploits
-better handling of RSS feeds (a few don't work such as the facebook engineers one)

Perhaps adding capabilities to keep track of when a feed was last checked and storing all the entries for it since then.
Or in other words, storing the unread entries so they can be read later even after they RSS feed has been updated and no longer has them.
