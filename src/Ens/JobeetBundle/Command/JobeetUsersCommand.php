<?php

namespace Ens\JobeetBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Ens\JobeetBundle\Entity\User;

class JobeetUsersCommand extends ContainerAwareCommand {
	/**
	*@ApiDoc(
	*	resource=true,
	*	description="Configure add of new users"
	*)
	*
	*/
	protected function configure() {
		$this->setName('ens:jobeet:users')
			->setDescription('Add Jobeet users')
			->addArgument('username', InputArgument::REQUIRED, 'The username')
			->addArgument('password', InputArgument::REQUIRED, 'The password');
	}
	
	/**
	*@ApiDoc(
	*	resource=true,
	*	description="Adds new user"
	*)
	*
	*/
	protected function execute(InputInterface $input, OutputInterface $output) {
		$username = $input->getArgument('username');
		$password = $input->getArgument('password');
		
		$em = $this->getContainer()->get('doctrine')->getManager();
		
		$user = new User();
		$user->setUsername($username);
		
		$factory = $this->getContainer()->get('security.encoder_factory');
		$encoder = $factory->getEncoder($user);
		$encodePassword = $encoder->encodePassword($password, $user->getSalt());
		$user->setPassword($encodePassword);
		$em->persist($user);
		$em->flush();
		
		$output->writeln(sprintf('Added %s user with password %s', $username, $password));
		
	}
	
	
}