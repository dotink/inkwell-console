<?php namespace Inkwell\Console
{
	use Psy\Shell;
	use Psy\Command;
	use Psy\Configuration;

	class Quill extends Shell
	{
		/**
		 * The shell configuration
		 *
		 * @access private
		 * @var Configuration
		 */
		private $config = NULL;


		/**
		 * The dynamic prompt callback
		 *
		 * @access private
		 * @var callable
		 */
		private $prompt = NULL;


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


		/**
		 * Set a custom prompt string
		 *
		 * @access public
		 * @var string|callable $prompt A prompt or callable to generate a prompt
		 * @return void
		 */
		public function setPrompt($prompt)
		{
			if (!is_callable($prompt)) {
				$this->prompt = function() use ($prompt) {
					return (string) $prompt;
				};

			} else {
				$this->prompt = $prompt;
			}
		}


		/**
		 *
		 */
		protected function getPrompt()
		{
			return call_user_func($this->prompt) . parent::getPrompt();
		}
	}
}
