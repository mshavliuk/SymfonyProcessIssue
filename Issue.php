#!/usr/bin/env php
<?php

use Symfony\Component\Process\Process;

require __DIR__.'/vendor/autoload.php';

const MAX_ATTEMPTS = 100;
$attemptCounter = 0;
do {
    try {
        echo 'attempt #'.++$attemptCounter.PHP_EOL;
        $process = new Process(['php', 'zombie.php']);
        $process->start();
        $process->setTimeout(.5);
        $process->waitUntil(
            static function ($type, $data) {
                return $type === 'out' && trim($data) === 'ready';
            }
        );
        $process->signal(SIGSTOP);
        $process->wait();
    } catch (Throwable $e) {}
} while ($attemptCounter < MAX_ATTEMPTS);