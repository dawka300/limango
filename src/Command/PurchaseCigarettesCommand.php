<?php

namespace App\Command;

use App\Machine\CigaretteMachine;
use App\Machine\Dto\DtoInput;
use App\Machine\NotEnoughMoneyException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use function str_replace;


class PurchaseCigarettesCommand extends Command
{
    protected function configure(): void
    {
        $this->addArgument('packs', InputArgument::REQUIRED, "How many packs do you want to buy?");
        $this->addArgument('amount', InputArgument::REQUIRED, "The amount in euro.");
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $itemCount = (int)$input->getArgument('packs');
        $amount = (float)str_replace(',', '.', $input->getArgument('amount'));


        $cigaretteMachine = new CigaretteMachine();

        try {
            $result = $cigaretteMachine->execute(new DtoInput($itemCount, $amount));
        } catch (NotEnoughMoneyException $e) {
            $output->write('You have not enough money to buy so many packs!!!');

            return 1;
        }

        $output->writeln(
            'You bought <info>' . $itemCount . '</info> packs of cigarettes for <info>' . $result->getTotalPrice() .
            '</info>, each for <info>' . CigaretteMachine::ITEM_PRICE . '</info>. ');

        $output->writeln('Your change is:');

        $table = new Table($output);
        $table
            ->setHeaders(array('Coins', 'Count'))
            ->setRows(array(
                [$result->getChange(), $itemCount],
            ));
        $table->render();

        return 0;

    }
}