<?php namespace Inkwell\Console
{
	use Psy\Shell;
	use Psy\Command;
	use Psy\Configuration;

	/**
	 * Quill provides some additional missing features on top of the classic Psy\Shell
	 */
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
		 * @access public
		 * @param Configuration $config (default: null)
		 * @return void
		 */
		public function __construct(Configuration $config = null)
		{
			$this->config = $config ?: new Configuration();

			parent::__construct($this->config);
		}


		/**
		 * Execute an arbitrary command in the context of the shell
		 *
		 * @access public
		 * @var string $command The command to execute
		 * @return mixed The result of the command execution
		 */
		public function exec($command)
		{
			return $this->runCommand($command);
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
		 * Gets the default commands that should always be available.
		 *
		 * @access protected
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
		 * Get the current prompt
		 *
		 * This will prepend the dynamic prompt to the traditional one.
		 *
		 * @access protected
		 * @return string The current prompt
		 */
		protected function getPrompt()
		{
			return $this->prompt
				? call_user_func($this->prompt) . parent::getPrompt()
				: parent::getPrompt();
		}
	}
}
