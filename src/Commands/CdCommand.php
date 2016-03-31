<?php namespace Inkwell\Console
{
	use Psy\Command\Command;
	use Symfony\Component\Console\Input\InputArgument;
	use Symfony\Component\Console\Input\InputInterface;
	use Symfony\Component\Console\Input\InputOption;
	use Symfony\Component\Console\Output\OutputInterface;

	/**
	 * A simple change directory command for the inKWell console
	 *
	 * @copyright Copyright (c) 2015, Matthew J. Sahagian
	 * @author Matthew J. Sahagian [mjs] <msahagian@dotink.org>
	 *
	 * @license Please reference the LICENSE.md file at the root of this distribution
	 */
	class CdCommand extends Command
	{
		/**
		 * {@inheritdoc}
		 */
		protected function configure()
		{
			$this
				->setName('cd')
				->setDefinition(array(
					new InputArgument('directory', InputArgument::REQUIRED, 'The directory to change to')
				))
				->setDescription('Change the current working directory')
				->setHelp(
<<<HELP
Change the current working directory

cd <directory>
HELP
				);
		}

		/**
		 * {@inheritdoc}
		 */
		protected function execute(InputInterface $input, OutputInterface $output)
		{
			$directory = $input->getArgument('directory');

			if (!chdir($directory)) {

			}
		}
	}
}
