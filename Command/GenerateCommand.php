<?php
/**
 * Created by PhpStorm.
 * User: ruudy
 * Date: 18/09/14
 * Time: 23:51
 */

namespace Ruudy\MetronicBundle\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Ruudy\MetronicBundle\Bundle\BundleMetadata;

class GenerateCommand extends ContainerAwareCommand
{
    protected $bundleSkeletonDir;

    /**
     * {@inheritDoc}
     */
    protected function configure()
    {
        $this->bundleSkeletonDir = __DIR__ . '/../Resources/skeleton/bundle/';

        $this
            ->setName('ruudy:metronic:generate')
            ->setHelp(<<<EOT
The <info>ruudy:metronic:generate</info> command generating a valid bundle structure from a Vendor Bundle.

  <info>ie: ./app/console sruudy:metronic:generate RuudyMetronicBundle</info>
EOT
            );

        $this->setDescription('Create necessary folders to copy Metronic assets for the twig templates');
    }

    /**
     * {@inheritDoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $dest = $this->getContainer()->get('kernel')->getRootDir() . '/../src';

        $configuration = array(
            'application_dir' =>  sprintf("%s/Application", $dest)
        );

        $bundleName = 'RuudyMetronicBundle';

        $processed = $this->generate($bundleName, $configuration, $output);

        if (!$processed) {
            $output->writeln(sprintf('<error>The bundle \'%s\' does not exist or not defined in the kernel file!</error>', $bundleName));

            return -1;
        }

        $output->writeln('done!');
    }

    protected function generate($bundleName, array $configuration, $output)
    {
        $processed = false;

        foreach ($this->getContainer()->get('kernel')->getBundles() as $bundle) {
            if ($bundle->getName() != $bundleName) {
                continue;
            }

            $processed = true;
            $bundleMetadata = new BundleMetadata($bundle, $configuration);

            $output->writeln(sprintf('Processing bundle : "<info>%s</info>"', $bundleMetadata->getName()));

            $this->generateBundleDirectory($output, $bundleMetadata);
            $this->generateBundleFile($output, $bundleMetadata);

            $output->writeln('');
        }

        return $processed;
    }

    protected function generateBundleDirectory(OutputInterface $output, BundleMetadata $bundleMetadata)
    {
        $directories = array(
            '',
            'Resources/public',
        );

        foreach ($directories as $directory) {
            $dir = sprintf('%s/%s', $bundleMetadata->getExtendedDirectory(), $directory);
            if (!is_dir($dir)) {
                $output->writeln(sprintf('  > generating bundle directory <comment>%s</comment>', $dir));
                mkdir($dir, 0755, true);
            }

            // Search similar folder structure in the skeleton/bundle to copy to extended bundle
            if ($directory != '') {
                $origin = realpath($this->bundleSkeletonDir . $directory);
                if (false !== $origin) {
                    // TODO copy it recursive
                    $this->recurse_copy($origin, $dir);
                }
            }
        }
    }

    protected function generateBundleFile(OutputInterface$output, BundleMetadata $bundleMetadata)
    {
        $file = sprintf('%s/Application%s.php', $bundleMetadata->getExtendedDirectory(), $bundleMetadata->getExtendedName());

        if (is_file($file)) {
            return;
        }

        $output->writeln(sprintf('  > generating bundle file <comment>%s</comment>', $file));

        $bundleTemplate = file_get_contents($this->bundleSkeletonDir . 'bundle.mustache');

        $string = $this->mustache($bundleTemplate, array(
            'bundle'        => $bundleMetadata->getExtendedName(),
            'extended_from' => $bundleMetadata->getName(),
            'namespace'     => $bundleMetadata->getExtendedNamespace(),
        ));

        file_put_contents($file, $string);
    }

    protected function mustache($string, array $parameters)
    {
        $replacer = function ($match) use ($parameters) {
            return isset($parameters[$match[1]]) ? $parameters[$match[1]] : $match[0];
        };

        return preg_replace_callback('/{{\s*(.+?)\s*}}/', $replacer, $string);
    }

    protected function recurse_copy($src, $dst)
    {
        $dir = opendir($src);

        @mkdir($dst);
        while(false !== ( $file = readdir($dir)) ) {
            if (( $file != '.' ) && ( $file != '..' )) {
                if ( is_dir($src . '/' . $file) ) {
                    $this->recurse_copy($src . '/' . $file,$dst . '/' . $file);
                }
                else {
                    copy($src . '/' . $file,$dst . '/' . $file);
                }
            }
        }

        closedir($dir);
    }
}