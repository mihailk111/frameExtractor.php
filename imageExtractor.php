<?php


class imageExtractor
{
    private $fps;
    private $outDir;
    private $imageType;
    private $maxFrames;

    public function __construct(string $outDir = __DIR__, int $fps = 24, string $imageType = "jpg", int $maxFrames = null)
    {
        if ($outDir !== __DIR__ && !file_exists($outDir)) {
            if (!mkdir($outDir)) {
                echo "Cannot create \"$outDir\" directory\n";
                die;
            }
        }

        $this->fps = $fps;
        $this->outDir = $outDir;
        $this->imageType = $imageType;
        $this->maxFrames = $maxFrames;
    }

    public function run(string $videoFile)
    {
        if (!file_exists($videoFile))
            throw new Exception(sprintf("File %s does not exist \n", $videoFile));

        $framesLimit = $this->maxFrames ? " -vframes {$this->maxFrames} " : "";

        $outDir = $this->outDir;

        $command = "ffmpeg -i " . $videoFile . " -r " . $this->fps . "/1 $framesLimit  $outDir/out%d.{$this->imageType} 2>&1";

        exec($command, $output);

        return $output;
    }
}

//($o = new imageExtractor("./new_images_2", 24, "jpg"))->run("someFile.mp4");
