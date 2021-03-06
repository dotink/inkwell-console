<?php namespace Inkwell\Console
{
	use Psy\Command\Command;
	use Symfony\Component\Console\Input\InputArgument;
	use Symfony\Component\Console\Input\InputInterface;
	use Symfony\Component\Console\Input\InputOption;
	use Symfony\Component\Console\Output\OutputInterface;

	/**
	 * A simple ls command for the inKWell console
	 *
	 * @copyright Copyright (c) 2015, Matthew J. Sahagian
	 * @author Matthew J. Sahagian [mjs] <msahagian@dotink.org>
	 *
	 * @license Please reference the LICENSE.md file at the root of this distribution
	 */
	class LsCommand extends Command
	{
		/**
		 * {@inheritdoc}
		 */
		protected function configure()
		{
			$this
				->setName('ls')
				->setDefinition(array(
					new InputArgument('directory', InputArgument::OPTIONAL, 'The directory to list')
				))
				->setDescription('List the contents of a directory')
				->setHelp(
<<<HELP
List the contents of a directory

ls [<directory>]
HELP
				);
		}

		/**
		 * {@inheritdoc}
		 */
		protected function execute(InputInterface $input, OutputInterface $output)
		{
			$directory   = $input->getArgument('directory') ?: getcwd();
			$directories = array();
			$files       = array();

			foreach (glob($directory . DIRECTORY_SEPARATOR . '/*') as $entity) {
				if (is_dir($entity)) {
					$directories[] = pathinfo($entity, PATHINFO_BASENAME);

				} elseif (is_file($entity)) {
					$files[] = pathinfo($entity, PATHINFO_BASENAME);
				}
			}

			sort($directories);
			sort($files);

			if (count($directories) || count($files)) {
				echo PHP_EOL;
			}

			if (count($directories)) {
				foreach ($directories as $directory) {
					echo '    ' . $directory . DIRECTORY_SEPARATOR . PHP_EOL;
				}

				echo PHP_EOL;
			}

			if (count($files)) {
				foreach ($files as $file) {
					echo '    ' . $file . PHP_EOL;
				}

				echo PHP_EOL;
			}
		}
	}
}
