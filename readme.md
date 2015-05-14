A Dev build with Symfony
========================
Webapplication build with Symfony, as found on navappaiya.nl.

<a href="http://dploy.io"><img src="https://nav.dploy.io/badge/02267417960256/24316.png" alt="Deployment status from dploy.io"></a>

### CMSBundle:
Manage Users, Pages, Categories, and add newsfeed to display on 
the homepage. Uses FOSUserBundle for User management and turns
valid json feeds (or feedburners feeds) to news headlines.
Mainly this holds the most configuration and settings for my personal
website. I will decouple this from other dependencies soon so it
can be re-used by other projects. 

### ScraperBundle:
Used to scrape content from the web. Currently only contains 2
apis but will be updated soon.

### SendGridBundle:
Planned but not finished this one yet. Idea was using this bundle
to send, receive and monitor email traffic for your webapplication
with the SendGrid API. Work in progress.

### WooBundle:
A Bundle to talk with the WooCommerce REST API v2. Currently working
on this. Will add more info about this soon.


The theme used in this project is the Spacelab Theme from Bootswatch.com. 
https://bootswatch.com/spacelab/

Find the doc folder under every Bundle/Resource folder for more information
or instructions how to use it. These bundles are purely for developing and 
learning purposes. 

