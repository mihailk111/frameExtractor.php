<?php

require 'vendor/autoload.php';

class imageExtractor
{

    private $videoFile;
    private $fps;
    private $outDir;
    private $imageType;
    private $maxFrames;

    public function __construct(
        string $videoFile,
        string $outDir = __DIR__,
        int $fps = 10,
        string $imageType = "jpg",
        int $maxFrames = null
    ) {
        if (!file_exists($videoFile))
            throw new Exception("File $videoFile does not exist \n");
        if ($outDir !== __DIR__ && !file_exists($outDir))
            throw new Exception("Directory $outDir does not exist \n");

        $this->videoFile    = $videoFile;
        $this->fps          = $fps;
        $this->outDir       = $outDir;
        $this->imageType    = $imageType;
        $this->maxFrames    = $maxFrames;
    }

    public function run()
    {
        $framesLimit = $this->maxFrames ? " -vframes {$this->maxFrames} " : "";
        $outDir = $this->outDir;
        $command = "ffmpeg -i " . $this->videoFile . " -r " . $this->fps . "/1 $framesLimit  $outDir/out%d.{$this->imageType} 2>&1";

        exec($command, $output, );
        print_r($output);

        // $process = popen($command, 'r');
        // $file = fread($process, 999999);
        // $file = explode("\n", $file);
        // print_r($file);
        // var_dump($result);

    }
}

($o = new imageExtractor("./video.mp4", maxFrames: 15))->run();
