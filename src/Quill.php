<?php namespace Inkwell\Console
{
	use Psy\Shell;
	use Psy\Command;

	class Quill extends Shell
	{
		/**
		 * Gets the default commands that should always be available.
		 *
		 * @return array An array of default Command instances
		 */
		protected function getDefaultCommands()
		{
			$hist = new Command\HistoryCommand();

			if ($this->readline) {
				$hist->setReadline($this->readline);
			}

			return array(
				new Command\HelpCommand(),
				new Command\ClearCommand(),
				new Command\BufferCommand(),
				$hist,
				new Command\DumpCommand(),
				new Command\ShowCommand(),
				new Command\ExitCommand(),
			);
		}
	}
}
