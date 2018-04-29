# <img src="resources/icon.svg" width="35" alt="Instafeed logo">&nbsp;Instafeed

A simple Craft CMS plugin wrapper to pull Instagram data via the v1 API

## Installation

To install Instafeed, follow these steps:

1. Download & unzip the file and place the `instafeed` directory into your `craft/plugins` directory
2. Install plugin in the Craft Control Panel under Settings > Plugins
3. The plugin folder should be named `instafeed` for Craft to see it.  GitHub recently started appending `-master` (the branch name) to the name of the folder for zip file downloads.

## Configuring Instafeed

Once the plugin is installed you'll need to sign up for an OAuth token on the [Instagram developer website](https://www.instagram.com/developer/). After obtaining your OAuth token, you'll also need to add it into the plugin settings in your control panel.

## Using Instafeed

### Using Twig
To pull the 20 most recent photos from your account simply loop through them using `.posts()`:
```twig
{% for post in craft.instafeed.posts %}
  <img src="{{post.images.thumbnail.url}}" alt="{{post.caption.text}}">
{% endfor %}
```

### JSON Endpoint
Or you can make a request to /actions/instafeed if you'd like a JSON endpoint of the same data.

## Cache

To avoid spamming the Instagram API your data will be cached for 1 hour after an uncached request is made. You may adjust this amount if you'd like in the plugin settings for a shorter or longer cache lifetime.

## Deprecation Info
**⚠️ NOTE!** Instagram is deprecating the basic API in early 2020 (see [the developer site for more info](https://www.instagram.com/developer/)). This plugin depends on that API. The new Graph API is the approach Instagram/Facebook recommends moving forward. However, it appears you cannot access a user's photos through the Graph API at the moment.

## Attribution
Icon design from Mood Design Studio — [Instagram Like](https://thenounproject.com/search/?q=instagram&i=1683936)
