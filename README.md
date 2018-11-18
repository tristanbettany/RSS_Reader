# RSS Reader

## Demo

There is a live demo at http://reader.tristanbettany.com

## Installation

- Make sure you have a mysql database created for this project, it can be called anything
- You will also need to make sure you have a user that can access that database setup
- Clone this repo to your server inside ```/var/www``` (Assuming thats where you keep your vhost files)
- Change to inside the ```RSS_Reader``` directory
- Run ```composer install```
- Copy the file ```env.php.dist``` to ```env.php```
- Change the values in the file to reflect your database configuration
- Run ```php ./cli migrate``` to setup the tables in the database
- Run ```php ./cli seed``` to seed the database with test data
- Create a vhost in your preferred server software
- Make sure to point your vhost at the public directory for this project
- When setting up mod rewrite Make sure you set the index document as the ```index.php``` file found in the public directory
- Restart your servicer software and visit the domain or subdomain you gave to the vhost
- Voila!

Heres an example apache vhost for setting this up on a subdomain of ```domain.com```:

```
<VirtualHost *:80>
  ServerAdmin webmaster@domain.com
  DocumentRoot /var/www/RSS_Reader/public
  ServerName reader.domain.com
  <Directory "/var/www/RSS_Reader/public">
        Options -Indexes +FollowSymLinks
        AllowOverride all
        Order allow,deny
        allow from all
        DirectoryIndex index.php

        <IfModule mod_rewrite.c>
                <IfModule mod_negotiation.c>
                        Options -MultiViews
                </IfModule>
                RewriteEngine On
                RewriteRule ^(.*)/$ /$1 [L,R=301]
                RewriteCond %{REQUEST_FILENAME} !-d
                RewriteCond %{REQUEST_FILENAME} !-f
                RewriteRule ^ index.php [L]
        </IfModule>
  </Directory>
  ErrorLog ${APACHE_LOG_DIR}/error.log
  CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>
```

## Usage

The frontend of this project is fully responsive and can be easily used on your mobile, tablet, or desktop.
THE UX is fairly intuitive and shouldnt really need any directions on use.

## Project MVP

The project simply needs to be able to allow a user to 
manage a list of rss feeds (CREATE, READ, UPDATE, DELETE). 
Feeds should be parsed and rendered for the user to scroll through.

## Restrictions

The project must be written in PHP and contain NO open source
libraries to speed up development.

## Assumptions

I assumed it was still possible to use composer for auto loading. I also assumed that using 
open source frontend technologies would be of no concern as PHP is the focus here. Therefore 
for the frontend I used VueJS and Bulma CSS. =P

## Structure

With the restrictions in place I had to roll my own:

- Routing system
- Request / Response system
- Database access layer
- CLI Command system
- Migration system
- Database seeding system
- Env specific vars system
- Config system
- Rendering system (JSON/HTML)

I decided to use ADR (Action Domain Responder), for the main structure of 
a request. This allows me more code seperation over MVC (Model View Controller).

I decided to setup gateways wrapping PDO to create a database access layer.
I needed to setup a migration and seeding system to allow the database to be setup
on installation of the app. This also required a CLI command system to be made. 

I needed to have database connection information environment specific so I designed
a simple system to use an env.php file with those settings in.

## Alternative soltions without restrictions

If the restrictions were not in place I would have chose to set this up 
with the following open source packages:

- Symfony HTTP Foundation Component
- Symfony CLI Command Component
- Flip Whoops Error Handling
- League Routing
- League Container
- Vlucas DOT Env
- Any ORM (Propel ORM maybe)
- Symfony Twig
- PHP Unit

## Given more time

From start to finish this project has taken about 24 hours in total. If i had more time I would look into
writing a custom testing solution to comply with the restrictions of this project, however that is pretty epic.

With more time I would improve the routing to allow uri paramaters enabling a fully restful version of the API
I made. As it stands the routing accepts query strings as paramaters only.

I would also look at securing the API from access to the public. Currently the API has no authentication. To
do such a thing would require generation and validation of JWT's which would exceed the scope of the project.

With more time I would also improve the error handling providing better HTTP error pages like custom 404's
I would also look into seting up a debug mode so exceptions and stack traces could be presented better while
in development mode.

I would also use extra time to enable auto refreshing of the feed on the frontend based on 
ttl's given in the rss feed. 

If the project was expanded to include a user account system I would recommend setting 
up certbot to enable HTTPS on the vhost.