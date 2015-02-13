<?php namespace Weile\Services\Textmessage;

use Closure;
use Illuminate\Queue\QueueManager;
use Illuminate\View\Factory;
use Illuminate\Log\Writer;

class PhoneMessage {

	protected $views;

	protected $api;

	protected $pretending = false;

	protected $queue;
	protected $logger;


	public function __construct(Factory $views, MessageApi $api) {
		$this->views = $views;
		$this->api = $api;
	}

	public function send($view, array $data, $to) {
		$content = $this->getView($view, $data);
		
		$this->sendMessage($content, $to);

	}

	protected function getView($view, $data)
	{
		return $this->views->make($view, $data)->render();
	}	

	protected function sendMessage($message, $to) {
		if (!$this->pretending) {
			return $this->api->send($message, $to);
		}
		elseif (isset($this->logger))
		{
			$this->logMessage($message, $to);

			return 1;
		}
	}

	protected function logMessage($message, $to)
	{

		$this->logger->info("Pretending to message to: {$to}----{$message}");
	}

	public function pretend($value = true)
	{
		$this->pretending = $value;
	}	

	public function queue($view, array $data, $to)
	{
		$this->queue->push('mailer@handleQueuedMessage', compact('view', 'data', 'to'));
	}

	public function later($delay, $view, array $data, $to) {
		$this->queue->later($delay, 'phonemessage@handleQueuedMessage', compact('view', 'data', 'to'));
	}

	public function handleQueuedMessage($job, $data) {
		$this->send($data['view'], $data['data'], $data['to']);
		$job->delete();
	}

	public function setLogger(Writer $logger)
	{
		$this->logger = $logger;

		return $this;
	}

	public function setQueue(QueueManager $queue)
	{
		$this->queue = $queue;

		return $this;
	}
}