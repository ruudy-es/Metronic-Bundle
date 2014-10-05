# METRONIC BUNDLE

Instalation
===========

Installation is a quick (I promise!) 7 step process:

1. Download over composer
2. Enable the bundle
3. 

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
    
This command will generate and skeleton bundle on src/Application/Ruudy/

Step 4. Download or Buy Metronic Theme and copy some assets folders
-------------------------------------------------------------------

This project is 

Usage
=====

