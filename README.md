# METRONIC BUNDLE

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/7d4a6623-709e-41f6-ae3e-b7c0613f5c12/mini.png)](https://insight.sensiolabs.com/projects/7d4a6623-709e-41f6-ae3e-b7c0613f5c12)

I apologize for the inconvenience that my english can produce.

Thanks to Sonata Project, their code inspire me on how to do some things.

Thanks to Metronic - Responsive Admin Dashboard Template creators for the good treatment received.

Latest pages & templates adapted (UPDATES)
===========================================

* Admin basic layout
* Advanced datatables
* Bootstramp forms based

License
=======

This bundle is under the MIT license. See the complete license in the bundle:

    Resources/meta/LICENSE

Instalation
===========

Installation is a quick 4 step process:

1. Download over composer
2. Enable the bundle
3. Generate the required files for the bundle
4. Download or Buy Metronic Theme and copy some assets folders
    
Step 1. Download over composer
------------------------------

Add RuudyMetronicBundle the require line to your composer.json:

    "require": {
        "ruudy/metronic-bundle": "@dev"
    }
    
    $ php composer.phar install
    
or just add it by running the command:
    
    $ php composer.phar require ruudy/metronic-bundle '@dev'
    
Composer will install the bundle to your project's ruudy/metronic-bundle directory.

Step 2. Enable the bundle
-------------------------
        
Enable the bundle in the kernel:
        
    <?php
    // app/AppKernel.php
    
    public function registerBundles()
    {
        $bundles = array(
            // ...
            new Ruudy\MetronicBundle\RuudyMetronicBundle(),,
        );
    }
    
Step 3. Generate the required files for the bundle
--------------------------------------------------

At this point, the bundle is not yet ready. You need to generate the correct files and folders for the twig inherance:

    $ php app/console ruudy:metronic:generate
    
This command will generate and skeleton bundle on src/Application/Ruudy/, and some folders to populate with the Metronic Template Assets



Step 4. Download or Buy Metronic Theme and copy some assets folders
-------------------------------------------------------------------

This project is based on the [**Metronic - Responsive Admin Dashboard Template**][1], so you need to buy it to get your license and all the assets and examples.

After you have your license, you only have to copy some folders in Bundle generated:

    /metronic_3.0.1/metronic/assets/admin

    INTO

    /src/Application/Ruudy/MetronicBundle/Resources/public/admin

and

    /metronic_3.0.1/metronic/assets/global

    INTO

    /src/Application/Ruudy/MetronicBundle/Resources/public/global

**This bundle is stable with Metronic 3.0.1 version, buy i´m working on keep it up to date with the latest metronic releases**

After copying the files you just have to install assets:

    $ php app/console assets:install web --symlink

Usage
=====

As you can see, this bundle is basically composed by a lot of twigs files.

You only have to take that blocks, zones or pieces and extend it by your own. If you have the metronic package examples it will be faster and easier to you.

The Basic idea is that you have the Metronic Theme separated on Zones and you can fill this Zones with Pieces, buy that Pieces can have some Zones to fill with another pieces. Is simple as think about container inherance.

As you can see i tried to maintain the metronic structure, so if metronic have an zone of code commented by:

    <!-- BEGIN RESPONSIVE MENU TOGGLER -->
    ...// some html
    <!-- END RESPONSIVE MENU TOGGLER -->

In this bundle you will have a zone defined as:

    {% block responsive_menu_toggler %}{% endblock %}

And one twig called:

    responsive_menu_toggler.html.twig

This file have the basic html of the block for create the html container, and you just need to decide what to do:

1. Extend it and fill with the html directly copied from the html example in Metronic Package.
2. Extend it and create your own html from scratch.
3. Create your own responsive_menu_toggler and include it in the block.

Examples
========

You have some basic examples how this bundle works on the Resources\views\metronic\examples folder.

It will be growing.


[1]:  http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?WT.ac=search_item&WT.oss_phrase=metronic&WT.oss_rank=1&WT.z_author=keenthemes
