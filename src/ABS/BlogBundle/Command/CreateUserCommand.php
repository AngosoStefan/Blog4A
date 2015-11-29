<?php

namespace ABS\BlogBundle\Command;
 
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use FOS\UserBundle\Model\User;
use FOS\UserBundle\Command\CreateUserCommand as BaseCommand;
 
class CreateUserCommand 
{
    /**
     * @see Command
     */
    protected function configure()
    {
        parent::configure();
        $this
            ->setName('abs:user:create')
            ->getDefinition()->addArguments(array(
                new InputArgument('path', InputArgument::REQUIRED, 'The path')
            ))
        ;
        $this->setHelp(<<<EOT
// L'aide qui va bien
EOT
            );
    }
 
    /**
     * @see Command
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $username   = $input->getArgument('username');
        $email      = $input->getArgument('email');
        $password   = $input->getArgument('password');
        $path   	= $input->getArgument('path');
        $inactive   = $input->getOption('inactive');
        $superadmin = $input->getOption('super-admin');
 
        /** @var \FOS\UserBundle\Model\UserManager $user_manager */
        $user_manager = $this->getContainer()->get('fos_user.user_manager');
 
        /** @var \Acme\AcmeUserBundle\Entity\User $user */
        $user = $user_manager->createUser();
        $user->setUsername($username);
        $user->setEmail($email);
        $user->setPlainPassword($password);
        $user->setEnabled((Boolean) !$inactive);
        $user->setSuperAdmin((Boolean) $superadmin);
        $user->setPath($path);
 
        $user_manager->updateUser($user);
 
        $output->writeln(sprintf('Created user <comment>%s</comment>', $username));
    }
 
    /**
     * @see Command
     */
    protected function interact(InputInterface $input, OutputInterface $output)
    {
        parent::interact($input, $output);
        if (!$input->getArgument('path')) {
            $path = $this->getHelper('dialog')->askAndValidate(
                $output,
                'Please choose a path:',
                function($path) {
                    if (empty($path)) {
                        throw new \Exception('Path can not be empty');
                    }
 
                    return $path;
                }
            );
            $input->setArgument('path', $path);
        }
       
    }
}
