# METRONIC BUNDLE

I apologize for the inconvenience that my english can produce.

Latest pages & templates adapated (UPDATES)
===========================================

* Admin basic layout
* Advanced datatables
* Bootstramp forms based

Instalation
===========

Installation is a quick 4 step process:

1. Download over composer
2. Enable the bundle
3. Generate the required files for the bundle
4. Download or Buy Metronic Theme and copy some assets folders

Thanks to Sonata Project, me han servido de inspiracion para algunas cosas y gracias a los creadores de Metronic.
    
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

This project is based on the [**Metronic - Responsive Admin Dashboard Template**][1], so you need to buy it to get your licente and all the assets and examples.

After you have your license, you only have to copy some folders in Bundle generated:

\metronic_3.0.1\metronic\assets\admin -> INTO -> src\Application\Ruudy\MetronicBundle\Resources\public\admin

\metronic_3.0.1\metronic\assets\global -> INTO -> src\Application\Ruudy\MetronicBundle\Resources\public\global

**This bundle is stable with Metronic 3.0.1 version, buy i´m working on keep it up to date with the latest metronic releases**

After copying the files you just have to install assets:

    $ php app/console assets:install web --symlink

Usage
=====

As you can see, this bundle is basically composed by a lot of twigs files.

You only have to take that blocks, zones or pieces and extend it by your own. If you have the metronic package examples it will be faster and easier to you.

The Basic idea is that you have the Metronic Theme separated on Zones and you can fill this Zones with Pieces, buy that Pieces can have some Zones to fill with another pieces. Is simple as think about container inherance.

[1]:  http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?WT.ac=search_item&WT.oss_phrase=metronic&WT.oss_rank=1&WT.z_author=keenthemes