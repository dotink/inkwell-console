<?php namespace Inkwell\Console
{
	use Psy\Shell;
	use Psy\Command;
	use Psy\Configuration;

	class Quill extends Shell
	{
		private $config = NULL;

	    /**
	     * Create a new Psy Shell.
	     *
	     * @param Configuration $config (default: null)
	     */
	    public function __construct(Configuration $config = null)
	    {
			$this->config = $config ?: new Configuration();

			parent::__construct($this->config);
	    }


		/**
		 * Gets the default commands that should always be available.
		 *
		 * @return array An array of default Command instances
		 */
		protected function getDefaultCommands()
		{
			$hist = new Command\HistoryCommand();

			$hist->setReadline($this->config->getReadline());

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
