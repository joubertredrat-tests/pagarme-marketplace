<?php
/**
 * Pagar.me develop exam
 *
 * @author Joubert RedRat <me+github@redrat.com.br>
 * @copyright 2017, Pagar.me
 * @link https://pagar.me
 */

namespace AppBundle\Command;

use AppBundle\Builder\ManufacturerBuilder;
use AppBundle\Builder\ProductBuilder;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\LockHandler;

/**
 * Class SeedDataCommand
 *
 * @package AppBundle\Command
 */
class SeedDataCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('app:seed-data')
            ->setDescription('Create data for Develop Exam')
            ->setHelp('This command allows you to create a user...')
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $lock = new LockHandler('app:seed-data');

        if (!$lock->lock()) {
            $output->writeln('The command is already running in another process.');

            return 0;
        }

        $manufacturerRepository = $this->getContainer()->get('app.manufacturer.repository');
        $productRepository = $this->getContainer()->get('app.product.repository');

        $output->writeln('Starting seed data');
        $output->writeln('');

        $manufacturerBuilder1 = new ManufacturerBuilder();
        $manufacturer1 = $manufacturerBuilder1
            ->addName('João Thiago Samuel Cavalcanti')
            ->get()
        ;

        $manufacturerRepository->add($manufacturer1);
        $output->writeln('Manufacturer added: ' . $manufacturer1->getName());

        $manufacturerBuilder2 = new ManufacturerBuilder();
        $manufacturer2 = $manufacturerBuilder2
            ->addName('César Anthony João Martins')
            ->get()
        ;

        $manufacturerRepository->add($manufacturer2);
        $output->writeln('Manufacturer added: ' . $manufacturer2->getName());

        $output->writeln('');

        $productBuilder1 = new ProductBuilder();
        $product1 = $productBuilder1
            ->addName('Fantasia do Darth Vader')
            ->addPrice(125.00)
            ->get()
        ;

        $productRepository->add($product1);
        $output->writeln('Product added: ' . $product1->getName());

        $productBuilder2 = new ProductBuilder();
        $product2 = $productBuilder2
            ->addName('Fantasia do Cafú')
            ->addPrice(100.00)
            ->addManufacturer($manufacturer1)
            ->get()
        ;

        $productRepository->add($product2);
        $output->writeln('Product added: ' . $product2->getName());

        $productBuilder3 = new ProductBuilder();
        $product3 = $productBuilder3
            ->addName('Máscara de Cavalo')
            ->addPrice(150.00)
            ->addManufacturer($manufacturer2)
            ->get()
        ;

        $productRepository->add($product3);
        $output->writeln('Product added: ' . $product3->getName());

        $output->writeln('');
        $output->writeln('Finished seed data');
    }
}
