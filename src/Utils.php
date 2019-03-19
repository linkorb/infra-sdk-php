<?php

namespace Infra\Sdk;

use Infra\Sdk\Exception;
use Docopt;

class Utils
{
    static public function query(string $query)
    {
        // Setup the stdin/stdout pipes
        $descriptorspec = [
            0 => array("pipe", "r"),  // stdin is a pipe that the child will read from
            1 => array("pipe", "w"),  // stdout is a pipe that the child will write to
            2 => array("pipe", "w"),  // stderr is a pipe that the child will write to
        ];

        // Execute the console command
        $cmd = 'infra query';
        $process = proc_open($cmd, $descriptorspec, $pipes);
        if (!is_resource($process)) {
            echo "Error executing $cmd";
            exit(-1);
        }

        // Write query to stdin and close it
        fwrite($pipes[0], $query);
        fclose($pipes[0]);

        // Read stdout and close it
        $json = trim(stream_get_contents($pipes[1]));
        fclose($pipes[1]);

        $return_value = proc_close($process);

        $data = json_decode($json, true);
        if (!$data) {
            throw new Exception\QueryException("Failed to decode json: " . json_last_error_msg());
        }
        return $data;
    }

    public static function getArguments(string $filename)
    {
        $arguments = [];
        if (file_exists($filename . '.md')) {
            $arguments = Docopt::handle(file_get_contents($filename . '.md'));
        }
        return $arguments;
    }
}