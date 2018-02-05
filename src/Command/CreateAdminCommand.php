<?php

namespace App\Command;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateAdminCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('app:create-admin')
            ->setDescription('create user with role admin from console')
            ->addArgument('surname', InputArgument::REQUIRED)
            ->addArgument('name', InputArgument::REQUIRED)
            ->addArgument('patronymic', InputArgument::REQUIRED)
            ->addArgument('birthDate', InputArgument::REQUIRED)
            ->addArgument('username', InputArgument::REQUIRED)
            ->addArgument('password', InputArgument::REQUIRED)
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine')->getManager();

        $user = new User();

        $user
            ->setName($input->getArgument('name'))
            ->setSurname($input->getArgument('surname'))
            ->setPatronymic($input->getArgument('patronymic'))
            ->setBirthDate(new \DateTime($input->getArgument('birthDate')))
            ->setUsername($input->getArgument('username'))
            ->setPassword(
                $this
                    ->getContainer()
                    ->get('security.password_encoder')
                    ->encodePassword($user, $input->getArgument('password'))
            )
            ->setRoles(['ROLE_ADMIN'])
        ;

        $em->persist($user);
        $em->flush();

        $output->writeln('User (' . $user->getUsername() . ') created.');
    }
}